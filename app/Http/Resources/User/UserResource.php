<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "name" => $this->resource->name,
            "surname" => $this->resource->surname,
            "full_name" => $this->resource->name . ' ' . ($this->resource->surname ?? ''),
            "email" => $this->resource->email,
            "mobile" => $this->resource->mobile,
            "avatar" => $this->resource->avatar ? env("APP_URL") . "storage/" . $this->resource->avatar : null,
            "birth_date" => $this->resource->birth_date ? Carbon::parse($this->resource->birth_date)->format("Y-m-d") : null,
            "gender" => $this->resource->gender,
            "education" => $this->resource->education,
            "address" => $this->resource->address,
            "role" => $this->resource->roles->first() ? [
                "id" => $this->resource->roles->first()->id,
                "name" => $this->resource->roles->first()->name,
            ] : null,
            "roles" => $this->resource->roles->pluck('name')->toArray(),
            "permissions" => $this->resource->getAllPermissions()->pluck('name')->toArray(),
            "created_at" => $this->resource->created_at->format("Y-m-d H:i:s"),
        ];
    }
}
