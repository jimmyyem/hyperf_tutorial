<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class BaseController
{
    /**
     * @Inject()
     * @var ResponseInterface
     */
    protected $response;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    /**
     * @return mixed
     */
    public function success(mixed $data = null) {
        return $this->response->json([
            'code' => 0,
            'msg' => '',
            'data' => $data,
        ]);
    }

    /**
     * @return mixed
     */
    public function fail(int $code, string $msg = '') {
        return $this->response->json([
            'code' => $code,
            'msg' => $msg,
            'data' => null,
        ]);
    }
}
