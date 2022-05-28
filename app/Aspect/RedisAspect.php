<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-28 18:15
 **/

namespace App\Aspect;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Redis\RedisProxy;
use Hyperf\Utils\Codec\Json;

#[Aspect]
class RedisAspect extends AbstractAspect
{
    /**
     * @var \Hyperf\Contract\StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    public $classes = [
        RedisProxy::class,
        //'RedisProxy::__call',
    ];

    public function __construct(StdoutLoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $this->logger->info(Json::encode($proceedingJoinPoint->getArguments()));

        return $proceedingJoinPoint->process();
    }
}