<?php

namespace App\Http\Controllers\Admin\Transformers;

use App\Models\Admin;
use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{
    public function transform(Admin $admin)
    {
        return [
            'id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'avatar' => $admin->avatar
        ];

    }
}
