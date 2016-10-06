<?php
namespace App\Http\Controllers\Client\V1;

use App\Http\Transformers\ContentTransformer;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ArticleController extends BaseController
{
    /**
     * @api {get} /contents/{limit} 文章列表(content list)
     * @apiDescription 文章列表(content list)
     * @apiGroup content
     * @apiPermission jwt
     * @apiParam {limit} limit  get limit
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": [
     *         {
     *           "id": 2,
     *           "email": "490554191@qq.com",
     *           "name": "fff",
     *         }
     *       ]
     *     }
     */
    public function index($limit,Request $request)
    {
        $contents = Content::paginate($limit);
        return $this->response->paginator($contents, new ContentTransformer());
    }


}
