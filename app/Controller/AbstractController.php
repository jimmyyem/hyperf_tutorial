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
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

    /**
     * @param mixed $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function success($data) {
        return $this->response->json([
            'code' => 0,
            'msg' => '',
            'data' => $data,
            'ts' => microtime(true),
        ]);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param mixed $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function error(int $code, string $msg = '', $data = null) {
        return $this->response->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
            'ts' => microtime(true),
        ]);
    }
}
