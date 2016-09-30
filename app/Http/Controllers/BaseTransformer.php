<?php

namespace Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    public function transform(Model $object)
    {
        return $object->attributesToArray();
    }
}
