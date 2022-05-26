<?php
/**
 * 路由有3种方式
 * @see https://hyperf.wiki/2.0/#/zh-cn/router
 * 1. route.php 里配置
 * 2. 注解路由- AutoController，完全生成class与public方法的组合
 * 3. 注解路由- Controller，需要每个方法写上Mapping信息
 */
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

use App\Annotation\Foo;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;

/**
 * @AutoController()
 */
class RouterController extends AbstractController
{
    /**
     * @return array
     * @GetMapping(path="")
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello Router {$user}.",
        ];
    }

    /**
     * 保存内容
     * @return array
     * @PostMapping(path="store")
     */
    public function store()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello, Store {$user}.",
        ];
    }
}
