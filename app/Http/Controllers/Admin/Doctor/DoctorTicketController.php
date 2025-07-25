<?php

namespace App\Http\Controllers\Admin\Doctor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Doctor\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Doctor\DoctorTicket;
use App\Services\DoctorTicketService;
use App\Models\Doctor\Specialitie;

class DoctorTicketController extends Controller
{
    protected $doctorTicketService;

    public function __construct(DoctorTicketService $doctorTicketService)
    {
        $this->doctorTicketService = $doctorTicketService;
    }

    /**
     * Obtener lista de doctores para gestión de tickets
     */
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', DoctorTicket::class);

        $search = $request->search;
        $specialities_id = $request->specialitie_id;

        $query = Doctor::with(['specialitie'])
            ->where(function ($q) use ($search) {
                if ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('surname', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                }
            });

        if ($specialities_id) {
            $query->where('specialitie_id', $specialities_id);
        }

        $doctors = $query->orderBy('name')->get();

        return response()->json([
            'doctors' => $doctors->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'full_name' => $doctor->full_name,
                    'email' => $doctor->email,
                    'specialitie' => [
                        'id' => $doctor->specialitie->id,
                        'name' => $doctor->specialitie->name,
                    ],
                    'avatar_url' => $doctor->avatar_url,
                ];
            })
        ]);
    }

    /**
     * Configuración inicial para el frontend
     */
    public function config(): JsonResponse
    {
        $specialities = Specialitie::where('state', 1)->get();

        return response()->json([
            'specialities' => $specialities,
        ]);
    }

    /**
     * Obtener tickets de un doctor específico
     */
    public function show(Request $request, $doctorId): JsonResponse
    {
        $this->authorize('view', DoctorTicket::class);

        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->addDays(30);

        $doctor = Doctor::findOrFail($doctorId);

        $tickets = DoctorTicket::with(['doctor.specialitie'])
            ->where('doctor_id', $doctorId)
            ->whereBetween('available_date', [$startDate, $endDate])
            ->orderBy('available_date')
            ->get();

        $stats = $this->doctorTicketService->getDoctorTicketStats(
            $doctorId,
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d')
        );

        return response()->json([
            'doctor' => [
                'id' => $doctor->id,
                'full_name' => $doctor->full_name,
                'specialitie' => $doctor->specialitie,
            ],
            'tickets' => $tickets->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'available_date' => $ticket->available_date->format('Y-m-d'),
                    'available_date_formatted' => $ticket->available_date->format('d/m/Y'),
                    'day_name' => $ticket->available_date->locale('es')->dayName,
                    'total_tickets' => $ticket->total_tickets,
                    'used_tickets' => $ticket->used_tickets,
                    'available_tickets' => $ticket->available_tickets,
                    'utilization_percentage' => $ticket->utilization_percentage,
                    'is_active' => $ticket->is_active,
                ];
            }),
            'stats' => $stats,
            'date_range' => [
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
            ]
        ]);
    }

    /**
     * Crear tickets para un doctor en múltiples fechas
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', DoctorTicket::class);

        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'tickets' => 'required|array|min:1',
            'tickets.*.available_date' => 'required|date|after_or_equal:today',
            'tickets.*.total_tickets' => 'required|integer|min:1|max:200',
        ]);

        $createdTickets = [];
        $errors = [];

        foreach ($validated['tickets'] as $ticketData) {
            try {
                $ticket = $this->doctorTicketService->createOrUpdateTickets(
                    $validated['doctor_id'],
                    $ticketData['available_date'],
                    $ticketData['total_tickets']
                );

                $createdTickets[] = [
                    'id' => $ticket->id,
                    'available_date' => $ticket->available_date->format('Y-m-d'),
                    'total_tickets' => $ticket->total_tickets,
                    'available_tickets' => $ticket->available_tickets,
                ];

            } catch (\Exception $e) {
                $errors[] = [
                    'date' => $ticketData['available_date'],
                    'error' => $e->getMessage()
                ];
            }
        }

        if (count($errors) > 0) {
            return response()->json([
                'message' => 422,
                'message_text' => 'Algunos tickets no pudieron ser creados',
                'errors' => $errors,
                'created_tickets' => $createdTickets
            ], 422);
        }

        return response()->json([
            'message' => 200,
            'message_text' => 'Tickets creados exitosamente',
            'created_tickets' => $createdTickets
        ]);
    }

    /**
     * Actualizar ticket específico
     */
    public function update(Request $request, $ticketId): JsonResponse
    {
        $this->authorize('update', DoctorTicket::class);

        $validated = $request->validate([
            'total_tickets' => 'required|integer|min:1|max:200',
            'is_active' => 'boolean'
        ]);

        $ticket = DoctorTicket::findOrFail($ticketId);

        // Validar que no se reduzcan los tickets por debajo de los ya usados
        if ($validated['total_tickets'] < $ticket->used_tickets) {
            return response()->json([
                'message' => 422,
                'message_text' => "No se puede reducir a {$validated['total_tickets']} tickets. Ya hay {$ticket->used_tickets} tickets utilizados."
            ], 422);
        }

        $ticket->update($validated);

        return response()->json([
            'message' => 200,
            'message_text' => 'Ticket actualizado exitosamente',
            'ticket' => [
                'id' => $ticket->id,
                'available_date' => $ticket->available_date->format('Y-m-d'),
                'total_tickets' => $ticket->total_tickets,
                'used_tickets' => $ticket->used_tickets,
                'available_tickets' => $ticket->available_tickets,
                'is_active' => $ticket->is_active,
            ]
        ]);
    }

    /**
     * Crear tickets masivos por rango de fechas
     */
    public function bulkCreate(Request $request): JsonResponse
    {
        $this->authorize('create', DoctorTicket::class);

        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'total_tickets' => 'required|integer|min:1|max:200',
            'exclude_weekends' => 'boolean',
            'selected_days' => 'array', // [0,1,2,3,4,5,6] donde 0=domingo, 1=lunes, etc.
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $excludeWeekends = $validated['exclude_weekends'] ?? false;
        $selectedDays = $validated['selected_days'] ?? null;

        $createdTickets = [];
        $skippedDates = [];

        while ($startDate->lte($endDate)) {
            $shouldCreate = true;

            // Excluir fines de semana si está habilitado
            if ($excludeWeekends && in_array($startDate->dayOfWeek, [0, 6])) {
                $shouldCreate = false;
                $skippedDates[] = $startDate->format('Y-m-d') . ' (fin de semana)';
            }

            // Filtrar por días específicos si están seleccionados
            if ($selectedDays && !in_array($startDate->dayOfWeek, $selectedDays)) {
                $shouldCreate = false;
                $skippedDates[] = $startDate->format('Y-m-d') . ' (día no seleccionado)';
            }

            if ($shouldCreate) {
                try {
                    $ticket = $this->doctorTicketService->createOrUpdateTickets(
                        $validated['doctor_id'],
                        $startDate->format('Y-m-d'),
                        $validated['total_tickets']
                    );

                    $createdTickets[] = [
                        'date' => $startDate->format('Y-m-d'),
                        'total_tickets' => $ticket->total_tickets,
                    ];

                } catch (\Exception $e) {
                    $skippedDates[] = $startDate->format('Y-m-d') . ' (error: ' . $e->getMessage() . ')';
                }
            }

            $startDate->addDay();
        }

        return response()->json([
            'message' => 200,
            'message_text' => 'Proceso completado',
            'created_count' => count($createdTickets),
            'skipped_count' => count($skippedDates),
            'created_tickets' => $createdTickets,
            'skipped_dates' => $skippedDates
        ]);
    }

    /**
     * Eliminar ticket (soft delete)
     */
    public function destroy($ticketId): JsonResponse
    {
        $this->authorize('delete', DoctorTicket::class);

        $ticket = DoctorTicket::findOrFail($ticketId);

        if ($ticket->used_tickets > 0) {
            return response()->json([
                'message' => 422,
                'message_text' => 'No se puede eliminar un ticket que ya tiene citas asignadas'
            ], 422);
        }

        $ticket->delete();

        return response()->json([
            'message' => 200,
            'message_text' => 'Ticket eliminado exitosamente'
        ]);
    }
}
