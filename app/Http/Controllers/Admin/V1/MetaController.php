<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Transformers\MetaTransformer;
use App\Models\Meta;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class MetaController extends BaseController
{
    /**
     * @api {post} /metas 标签类别列表(meta list)
     * @apiDescription 标签类别列表(meta list)
     * @apiGroup meta
     * @apiPermission none
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": [
     *         {
     *           "id": 2,
     *           "name": "fff",
     *           "type": "1",
     *           "description": "fff",
     *         }
     *       ]
     *     }
     */
    public function index($type,$limit, Request $request)
    {
//        $metas = Meta::where('type', $type)->get();
//        return $this->response->collection($metas, new MetaTransformer());

        $metas = Meta::where('type', $type)->paginate($limit);

        return $this->response->paginator($metas, new MetaTransformer());
    }

    /**
     * @api {post} /metas 标签类别列表(meta list)
     * @apiDescription 标签类别列表(meta list)
     * @apiGroup meta
     * @apiPermission none
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": [
     *         {
     *           "id": 2,
     *           "name": "fff",
     *           "type": "1",
     *           "description": "fff",
     *         }
     *       ]
     *     }
     */

    public function parent($type,$parent, Request $request)
    {
        $metas = Meta::where(['parent'=>$parent,'type'=>$type])->get();
        return $this->response->collection($metas, new MetaTransformer());
    }
    /**
     * @api {post} /metas 标签类别列表(meta list)
     * @apiDescription 标签类别列表(meta list)
     * @apiGroup meta
     * @apiPermission none
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": [
     *         {
     *           "id": 2,
     *           "name": "fff",
     *           "type": "1",
     *           "description": "fff",
     *         }
     *       ]
     *     }
     */
    public function allCategory($type,Request $request)
    {
        $parentMetas = Meta::where(['parent'=>0,'type'=>$type])->get();
        $allMetas = Meta::where('parent','!=',0)->where('type',$type)->get();

        foreach ($parentMetas as $parent) {
            $collection = collect();
            foreach ($allMetas as $meta){
                if ($parent['id'] == $meta['parent']){
                    $collection = $collection->push($meta);
                 }
            }
            $parent['type'] = $collection->all();

        }

        return $this->response->collection($parentMetas, new MetaTransformer());
    }

    /**
     * @api {post} /posts 创建标签(create post)
     * @apiDescription 创建标签(create post)
     * @apiGroup Post
     * @apiPermission jwt
     * @apiParam {String} title  post title
     * @apiParam {String} content  post content
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *   HTTP/1.1 201 Created
     */
    public function store( Request $request)
    {
        $validator = \Validator::make($request->input(), [
            'name' => 'required|string|max:50',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator->messages());
        }

        $attributes = $request->only('name', 'type' ,'description','parent');

//        $post = $this->postRepository->create($attributes);

        $meta = new Meta($attributes);

        $meta->save();

        return $this->response->noContent();
    }

    /**
     * @api {put} /posts/{id} 修改标签(update post)
     * @apiDescription 修改标签(update post)
     * @apiGroup Post
     * @apiPermission jwt
     * @apiParam {String} title  post title
     * @apiParam {String} content  post content
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *   HTTP/1.1 204 NO CONTENT
     */
    public function update($id, Request $request)
    {
        $meta = Meta::find($id);

        if (! $meta) {
            return $this->response->errorNotFound();
        }

        $validator = \Validator::make($request->input(), [
            'name' => 'required|string|max:50',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorBadRequest($validator->messages());
        }

        $attributes = $request->only('name' ,'description');
        $meta->fill($attributes);
        $meta->save();

        return $this->response->noContent();
    }

    /**
     * @api {delete} /posts/{postId}/comments/{id} 删除标签(delete post comment)
     * @apiDescription 删除标签(delete post comment)
     * @apiGroup Post
     * @apiPermission jwt
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *   HTTP/1.1 204 NO CONTENT
     */
    public function destroy($id)
    {
        $meta = Meta::find($id);

        if (! $meta) {
            return $this->response->errorNotFound();
        }

        $meta->delete();

        return $this->response->noContent();
    }
}
