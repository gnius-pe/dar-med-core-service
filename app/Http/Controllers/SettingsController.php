<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    private function getKey(): string
    {
        return 'selected_mission';
    }

    public function show(): JsonResponse
    {
        $value = DB::table('settings')
            ->where('key', $this->getKey())
            ->value('value');

        return response()->json([
            'selected_mission' => $value ? json_decode($value, true) : null,
        ]);
    }

    public function update(): JsonResponse
    {
        $validated = request()->validate([
            'selected_mission' => 'nullable|array',
        ]);

        $value = $validated['selected_mission'] ?? null;

        DB::table('settings')->updateOrInsert(
            ['key' => $this->getKey()],
            ['value' => $value ? json_encode($value) : null, 'updated_at' => now(), 'created_at' => now()]
        );

        return response()->json([
            'selected_mission' => $value,
        ]);
    }

    public function destroy(): JsonResponse
    {
        DB::table('settings')->where('key', $this->getKey())->delete();

        return response()->json(null, 204);
    }
}
