<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            "identificador" => (int) $user->id,
            "nombre" => (string) $user->name,
            "correo" => (string) $user->email,
            "estaVerificado" => (bool) $user->verified,
            "esAdministrador" => (bool) $user->admin,
            "fechaCreacion" => (string) $user->created_at,
            "fechaActualizacion" => (string) $user->updated_at,
            "fechaEliminacion" => isset($user->deleted_at) ? (string) $user->deleted_at : null,
        ];
    }
}
