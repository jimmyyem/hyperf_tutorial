<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-06-01 21:52
 **/


use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

if (! function_exists('container')) {

    /**
     * 获取容器实例
     *
     * @return \Psr\Container\ContainerInterface
     */
    function container(): \Psr\Container\ContainerInterface
    {
        return ApplicationContext::getContainer();
    }
}

if (! function_exists('redis')) {

    /**
     * 获取Redis实例
     *
     * @return \Hyperf\Redis\Redis
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function redis(): \Hyperf\Redis\Redis
    {
        return container()->get(\Hyperf\Redis\Redis::class);
    }
}

if (! function_exists('console')) {

    /**
     * 获取控制台输出实例
     *
     * @return StdoutLoggerInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function console(): StdoutLoggerInterface
    {
        return container()->get(StdoutLoggerInterface::class);
    }
}

if (! function_exists('logger')) {

    /**
     * 获取日志实例
     *
     * @param string $name
     * @return LoggerInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function logger(string $name = 'Log', $config = 'default'): LoggerInterface
    {
        return container()->get(LoggerFactory::class)->get($name, $config);
    }
}

if (! function_exists('context_set')) {
    /**
     * 设置上下文数据
     *
     * @param string $key
     * @param $data
     * @return bool
     */
    function context_set(string $key, $data): bool
    {
        return (bool) \Hyperf\Context\Context::set($key, $data);
    }
}

if (! function_exists('context_get')) {
    /**
     * 获取上下文数据
     *
     * @param string $key
     * @return mixed
     */
    function context_get(string $key)
    {
        return \Hyperf\Context\Context::get($key);
    }
}

if (! function_exists('snowflake_id')) {
    /**
     * 生成雪花ID
     *
     * @return String
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function snowflake_id(): string
    {
        return container()->get(Id::class)->getId();
    }
}

if (! function_exists('event')) {
    /**
     * 事件调度快捷方法
     *
     * @param object $dispatch
     * @return object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function event(object $dispatch): object
    {
        return container()->get(EventDispatcherInterface::class)->dispatch($dispatch);
    }
}

if (! function_exists('push_queue_message')) {
    /**
     * 推送消息到队列
     *
     * @param QueueMessageVo $message
     * @param array $receiveUsers
     * @return int 消息ID，若失败返回 -1
     * @throws Throwable
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function push_queue_message(QueueMessageVo $message, array $receiveUsers = []): int
    {
        return container()->get(\App\System\Service\SystemQueueLogService::class)->pushMessage($message, $receiveUsers);
    }
}

if (! function_exists('add_queue')) {
    /**
     * 添加任务到队列
     *
     * @param \App\System\Vo\AmqpQueueVo $amqpQueueVo
     * @return bool
     * @throws Throwable
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function add_queue(\App\System\Vo\AmqpQueueVo $amqpQueueVo): bool
    {
        return container()->get(\App\System\Service\SystemQueueLogService::class)->addQueue($amqpQueueVo);
    }
}

if (! function_exists('getAgeByIdCard')) {
    /**
     * 获取周岁年龄计算(生日当天既满一年)
     *
     * @param string $idcard 身份证号码
     * @param string $now 当前时间(空默认当前时间)
     * @return int|string
     * @throws \Exception
     */
    function getAgeByIdCard($idcard, $now = '')
    {
        if (empty($idcard)) {
            return '';
        }
        try {
            $birth = new \DateTime(substr($idcard, 6, 8));
            $now = new \DateTime($now);

            return $birth->diff($now)->format('%y');
        } catch (\Exception $e) {
            return 0;
        }
    }
}
