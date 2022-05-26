<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\UserRegister;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Hyperf\Event\Contract\ListenerInterface;

/**
 * @Listener
 */
#[Listener]
class UserRegisterListener implements ListenerInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(ContainerInterface $container, LoggerFactory $loggerFactory)
    {
        $this->container = $container;
        $this->logger = $loggerFactory->get('log', 'default');
    }

    /**
     * 监听列表
     * @return string[]
     */
    public function listen(): array
    {
        return [
            UserRegister::class,
        ];
    }

    /**
     * 处理事件
     * @param object $event
     * @return void
     */
    public function process(object $event)
    {
        $user = $event->user;
        if(is_null($user)) {
            $this->logger->info('user is null');
        } else {
            $this->logger->info("event[UserRegister]...");
            $this->logger->info(json_encode($user->toArray(), 256));
        }
    }
}
