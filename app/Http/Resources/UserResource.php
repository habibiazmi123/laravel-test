<?php

namespace App\Http\Resources;

use App\UserRole;
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
        $isCreate = $request->routeIs('users.store');

        return [
            'id'           => $this->id,
            'email'        => $this->email,
            'name'         => $this->name,
            'role'         => $this->when(! $isCreate, $this->role),
            'created_at'   => $this->created_at?->toIso8601String(),
            'orders_count' => $this->when(! $isCreate, $this->orders_count),
            'can_edit'     => $this->when(! $isCreate, $this->canEdit($request)),
        ];
    }

    private function canEdit(Request $request): bool
    {
        return $request->user()?->id === $this->id
            || $request->user()?->role === UserRole::ADMINISTRATOR;
    }
}
