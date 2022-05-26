<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\HttpServer\Response;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckLogin implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request, LoggerFactory $loggerFactory)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
        $this->logger = $loggerFactory->get();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->logger->info('enter middleware CheckLogin');

        $authorization = $request->getHeader('Authorization');
        $isValidToken = !empty($authorization);
        if ($isValidToken) {
            $response = $handler->handle($request);

            //实现类似 后置中间件 功能
            $body = $response->getBody()->getContents();
            echo $body;
            var_dump($response->withBody(new SwooleStream($body)));

            return $response;
        }

        return $this->response->json(
            [
                'code' => -1,
                'data' => [
                    'error' => '中间件验证 Header - Authorization  无效，阻止继续向下执行',
                    'authorization' => $authorization,
                ],
            ]
        );
    }
}