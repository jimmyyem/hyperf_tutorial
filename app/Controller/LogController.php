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

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @Controller(prefix="log")
 */
class LogController
{
    #[GetMapping('')]
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        // 代表使用 config/autload/logger.php 里  order 配置写入，信息级别是 app.INFO
        logger('app','order')->error('订单信息处理异常');

        // 代表使用 config/autload/logger.php 里  default 配置写入，信息级别是 log.ERROR
        logger('log', 'default')->error('log default 信息打印');


        return $response->json([
            'code' => 0,
            'data' => 'Hello Hyperf!',
        ]);
    }
}
