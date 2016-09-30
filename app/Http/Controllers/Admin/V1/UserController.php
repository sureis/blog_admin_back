<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Admin\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * @api users/{limit} 管理员列表(admin list)
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
     *           "name": "fff"
     *         }
     *       ]
     *     }
     */

    public function index($limit, Request $request)
    {
        $users = User::paginate($limit);
        return $this->response->paginator($users, new UserTransformer());
    }

}
