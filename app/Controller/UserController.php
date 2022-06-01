<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Model\UserModel;
use App\Request\UserRequest;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller(prefix: 'user')]
class UserController extends AbstractController
{
    /**
     * @Inject
     * @var \App\Service\UserService
     */
    protected $userService;

    #[GetMapping(path: 'index')]
    public function index()
    {
        $list = UserModel::orderBy('id', 'desc')->get();
        $count = UserModel::count();

        return $this->success([
            'count' => $count,
            'list' => $list,
        ]);
    }

    /**
     * 这样可重写路由，变成 /store POST方式，不受Controller(prefix="user")的限制
     * # RequestMapping(path="/store", methods={"POST"})
     */
    #[PostMapping(path: "store")]
    public function store(UserRequest $request)
    {
        $params = $request->scene('store')->validated();
        $user = UserModel::create($params);

        return $this->success($user->toArray());
    }

    #[PutMapping(path: 'update')]
    public function update(UserRequest $request)
    {
        $params = $request->scene('update')->validated();

        $count = UserModel::where('id', '!=', $params['id'])->where('email', $params['email'])->count();
        if ($count > 0) {
            return $this->error(10020, 'Email重复');
        }
        //return $this->success($params);

        UserModel::where('id', $params['id'])->update($params);
        $user = UserModel::find($params['id']);

        return $this->success($user->toArray());
    }

    #[GetMapping(path: 'detail')]
    public function detail(RequestInterface $request)
    {
        $id = $this->request->input('id', 0);
        if (empty($id)) {
            return $this->error(500, '参数错误');
        }

        $user = UserModel::find($id);

        return $this->success([
            'user' => $user,
        ]);
    }

    #[GetMapping(path: 'incr')]
    public function incr(RequestInterface $request)
    {
        $id = $this->request->input('id', 0);
        if (empty($id)) {
            return $this->error(500, '参数错误');
        }

        $user = $this->userService->incr($id);

        return $this->success([
            'user' => $user,
            'id' => $id,
        ]);
    }
}
