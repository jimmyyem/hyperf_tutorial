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

use App\Middleware\CheckHeader;
use App\Middleware\CheckLogin;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @Controller(prefix="check")
 */
class CheckController
{
    #[GetMapping('')]
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->json([
            'code' => 0,
            'data' => 'Hello Hyperf!',
        ]);
    }

    #[GetMapping('header'), Middleware(CheckHeader::class)]
    public function header(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('check header ok');
    }

    #[GetMapping('login'), Middleware(CheckLogin::class)]
    public function login(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('check login ok');
    }
}
