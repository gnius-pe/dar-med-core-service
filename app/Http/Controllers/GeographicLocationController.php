<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeographicLocationRequest;
use App\Models\GeographicLocation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeographicLocationController extends Controller
{
    public function store(GeographicLocationRequest $request): JsonResponse
    {
        $location = GeographicLocation::create($request->validated());

        return response()->json([
            'message' => 'Ubicación geográfica creada exitosamente.',
            'data' => $location,
        ], 201);
    }

    public function update(GeographicLocationRequest $request, GeographicLocation $geographicLocation): JsonResponse
    {
        $geographicLocation->update($request->validated());

        return response()->json([
            'message' => 'Ubicación geográfica actualizada exitosamente.',
            'data' => $geographicLocation,
        ]);
    }

    public function getByPatientId($patientId): JsonResponse
    {
        $location = GeographicLocation::where('patient_id', $patientId)->first();

        return response()->json([
            'message' => $location ? 'Ubicación geográfica encontrada.' : 'No se encontró ubicación geográfica para este paciente.',
            'data' => $location,
        ]);
    }

    public function getByPatientIds(Request $request): JsonResponse
    {
        $patientIds = $request->input('patient_ids', []);
        $locations = [];

        if (!empty($patientIds) && is_array($patientIds)) {
            $locations = GeographicLocation::whereIn('patient_id', $patientIds)->get()->toArray();
        }

        return response()->json([
            'message' => count($locations) > 0 ? 'Ubicaciones geográficas encontradas.' : 'No se encontraron ubicaciones geográficas.',
            'data' => $locations,
        ]);
    }
}
