<?php

namespace App\Http\Transformers;

use App\Models\Content;
use League\Fractal\TransformerAbstract;

class ContentTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        return [
            'id' => $content->id,
            'title' => $content->title,
            'text_url' => $content->text_url,
            'text' => $content->text,
            'authorId' => $content->authorId,
            'type' => $content->type,
            'allowComment' => $content->allowComment,
            'tag' => $content->tag
        ];

    }
}
