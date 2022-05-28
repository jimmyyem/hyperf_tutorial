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
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AutoController
 */
class DataController extends BaseController
{
    /**
     * @Inject(required=true, lazy=true)
     * @var \App\Service\DataService
     */
    protected $service;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $this->success([
            'hi' => time(),
            'list' => $this->service->getNew(10),
        ]);
    }
}
