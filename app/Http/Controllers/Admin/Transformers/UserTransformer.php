<?php

namespace App\Http\Controllers\Admin\Transformers;

use App\Models\Admin;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'type' => $user->type,
            'avatar' => $user->avatar
        ];

    }
}
