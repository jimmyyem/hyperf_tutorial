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
namespace App\Listener;

use App\Event\UserRegister;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

/**
 * @Listener
 */
#[Listener]
class UserRegisterListener implements ListenerInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container, LoggerFactory $loggerFactory)
    {
        $this->container = $container;
        $this->logger = $loggerFactory->get('log', 'default');
    }

    /**
     * 监听列表.
     * @return string[]
     */
    public function listen(): array
    {
        return [
            UserRegister::class,
        ];
    }

    /**
     * 处理事件.
     */
    public function process(object $event)
    {
        $user = $event->user;
        if (is_null($user)) {
            $this->logger->info('user is null');
        } else {
            $this->logger->info('event[UserRegister]...');
            $this->logger->info(json_encode($user->toArray(), 256));
        }
    }
}
