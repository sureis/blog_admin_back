<?php

namespace App\Http\Transformers;
use App\Models\Meta;
use League\Fractal\TransformerAbstract;

class MetaTransformer extends TransformerAbstract
{
    public function transform(Meta $meta)
    {
        return [
            'id' => $meta->id,
            'name' => $meta->name,
            'type' => $meta->type,
            'description' => $meta->description,
            'parent' => $meta->parent
        ];

    }
}
