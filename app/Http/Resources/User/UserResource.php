<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            "identificador" => (int) $this->getRouteKey(),
            "nombre" => (string) $this->name,
            "correo" => (string) $this->email,
            "estaVerificado" => (bool) $this->verified,
            "esAdministrador" => (bool) $this->admin,
            "fechaCreacion" => (string) $this->created_at,
            "fechaActualizacion" => (string) $this->updated_at,
            "fechaEliminacion" => isset($this->deleted_at) ? (string) $this->deleted_at : null,
            "links" => [
                "self" => url('/api/users/'.$this->resource->getRouteKey()),
            ]
        ];
    }
}
