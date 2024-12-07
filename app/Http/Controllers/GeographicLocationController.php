<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeographicLocationRequest;
use App\Models\GeographicLocation;
use Illuminate\Http\JsonResponse;

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

        if (!$location) {
            return response()->json(['message' => 'No se encontró ubicación geográfica para este paciente.'], 404);
        }

        return response()->json([
            'message' => 'Ubicación geográfica encontrada.',
            'data' => $location,
        ]);
    }
}
