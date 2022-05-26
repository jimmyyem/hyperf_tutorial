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
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * @Controller(prefix="user")
 */
class UserController extends AbstractController
{
    /**
     * @Inject(required=false)
     * @var \App\Service\UserService
     */
    protected $userService;

    /**
     * @Inject(required=false)
     * @var \App\Service\DataService
     */
    protected $dataService;

    /**
     * @GetMapping(path="index")
     */
    public function index()
    {
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        $id = $this->request->input('id', 1);

        return [
            'offset' => $offset,
            'limit' => $limit,
            'method' => 'index',
            'user' => $this->userService->getInfoById($id),
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

    /**
     * @RequestMapping(path="update", methods={"PUT"})
     */
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

    /**
     * @RequestMapping(path="delete", methods={"DELETE"})
     */
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

    /**
     * @RequestMapping(path="detail", methods={"get","post"})
     */
    public function detail()
    {
        $offset = $this->request->input('offset', 0);
        $limit = $this->request->input('limit', 10);

        return [
            'offset' => $offset,
            'limit' => $limit,
            'method' => 'detail',
        ];
    }
}
