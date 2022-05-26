<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckHeader implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /**
         * 根据具体业务判断逻辑走向，这里假设用户携带的token有效
         * 这里是在 在 return $response 之前操作，实现了类似 前置 中间件的功能
         */
        $authorization = $request->getHeader('Authorization');
        $isValidToken = !empty($authorization);
        if ($isValidToken) {
            $response = $handler->handle($request);
            return $response;
        }

        return $this->response->json(
            [
                'code' => -1,
                'data' => [
                    'error' => '中间件验证 Header - Authorization  无效，阻止继续向下执行',
                ],
            ]
        );
    }
}
