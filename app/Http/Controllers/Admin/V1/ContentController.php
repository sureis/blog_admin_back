<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Transformers\ContentTransformer;
use App\Models\Content;
use App\Models\Relationship;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ContentController extends BaseController
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

    /**
     * @api contents/store 发布文章(create post)
     * @apiDescription 发布文章(create post)
     * @apiGroup content
     * @apiPermission jwt
     * @apiParam {String} title  post title
     * @apiParam {String} content  post content
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *   HTTP/1.1 201 Created
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->input(), [
            'title' => 'required|string|max:100',
            'text_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator->messages());
        }

        $_article_data = [
            'title'=>$request->input('title'),
            'text_url'=>$request->input('text_url'),
            'type'=>$request->input('type'),
            'allowComment'=>$request->input('comment'),
            'tag'=>json_encode($request->get('checkList'))
        ];

////        ['status' => $request->input('category')],
////            ['password' => $request->input('comment')],
////            ['text' => $request->input('checkList')],
////            ['tzmarl' => $request->input('1tzmarl')],
////
////        $categoryId = $request->input('category');
////        $comment = $request->input('comment');
////        $tag = $request->input('checkList');
////
////        $array2 = array('status' => "1"+$categoryId, 'password' => $comment+"", 'text' => ""+$tag);
//        array_push($attributes,['slug' => $request->get('checkList')]);

        $content = new Content($_article_data);

        $content->save();

        $relationship = new Relationship(['cid'=>$content->id,'mid'=>$request->input('category')]);
        $relationship->save();

        return $this->response->noContent();
    }


    /**
     * @api contents/{id} 删除文章(delete post comment)
     * @apiDescription 删除文章(delete post comment)
     * @apiGroup delete
     * @apiPermission jwt
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *   HTTP/1.1 204 NO CONTENT
     */
    public function destroy($id)
    {
        $content = Content::find($id);

        if (! $content) {
            return $this->response->errorNotFound();
        }

        $content->delete();

        return $this->response->noContent();
    }
}
