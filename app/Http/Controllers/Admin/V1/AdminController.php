<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Transformers\AdminTransformer;
use App\Models\Admin;
use App\Http\Controllers\BaseController;

class AdminController extends BaseController
{
    /**
     * @api {post} /admins 管理员列表(admin list)
     * @apiDescription 管理员列表(admin list)
     * @apiGroup admin
     * @apiPermission none
     * @apiVersion 0.1.0
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": [
     *         {
     *           "id": 2,
     *           "email": "490554191@qq.com",
     *           "name": "fff",
     *           "created_at": "2015-11-12 10:37:14",
     *           "updated_at": "2015-11-13 02:26:36",
     *           "deleted_at": null
     *         }
     *       ]
     *     }
     */
    public function index()
    {
        $admins = Admin::all();
        return $this->response->collection($admins, new AdminTransformer());
    }

}
