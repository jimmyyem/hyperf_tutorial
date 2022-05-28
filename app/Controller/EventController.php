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

use App\Event\UserRegister;
use App\Model\UserModel;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AutoController
 */
class EventController
{
    /**
     * @Inject
     * @var \Psr\EventDispatcher\EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function user(RequestInterface $request, ResponseInterface $response)
    {
        $user = UserModel::find(1);

        // 事件分发器
        $this->eventDispatcher->dispatch(new UserRegister($user));

        return $response->raw('Hello Hyperf!');
    }
}
