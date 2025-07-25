<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MissionRequest;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::all();
        return response()->json($missions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MissionRequest $request)
    {
        $mission = Mission::create($request->validated());
        return response()->json($mission, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        return response()->json($mission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MissionRequest $request, Mission $mission)
    {
        $mission->update($request->validated());
        return response()->json($mission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return response()->json(null, 204);
    }
}
