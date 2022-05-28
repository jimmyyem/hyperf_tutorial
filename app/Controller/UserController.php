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

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller(prefix: "user")]
class UserController extends AbstractController
{
    /**
     * @Inject()
     * @var \App\Service\UserService
     */
    protected $userService;

    #[GetMapping(path: "index")]
    public function index()
    {
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        $id = $this->request->input('id', 1);

        return [
            'offset' => $offset,
            'limit' => $limit,
            'method' => 'index',
            'user' => $this->userService->getUser($id),
        ];
    }

    /**
     * @RequestMapping(path="store", methods={"POST"})
     *
     * 这样可重写路由，变成 /store POST方式，不受Controller(prefix="user")的限制
     * # RequestMapping(path="/store", methods={"POST"})
     */
    public function store()
    {
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        return [
            'offset' => $offset,
            'limit' => $limit,
            'method' => 'store',
        ];
    }

    #[PutMapping(path: "update")]
    public function update()
    {
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        return [
            'offset' => $offset,
            'limit' => $limit,
            'method' => 'update',
        ];
    }

    #[DeleteMapping(path: "delete")]
    public function delete()
    {
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        return [
            'offset' => $offset,
            'limit' => $limit,
            'method' => 'delete',
        ];
    }

    #[GetMapping(path: "detail")]
    public function detail(RequestInterface $request)
    {
        $id = $this->request->input('id', 0);
        if (empty($id)) {
            return $this->error(500, '参数错误');
        }

        $user = $this->userService->getUser($id);
        if (empty($user)) {
            return $this->error(500, '不存在');
        }

        return $this->success([
            'user' => $user,
            'id' => $id,
        ]);
    }
}
