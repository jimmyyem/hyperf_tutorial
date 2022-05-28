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
namespace App\Aspect;

use App\Annotation\Foo;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

#[Aspect()]
class IndexAspect extends AbstractAspect
{
    /**
     * 对类、或者指定方法监听.
     * @var array
     */
    public $classes = [
        // ConfigController::class,
        // IndexController::class,
        // 'App\Controller\DataController::index',
    ];

    /**
     * 对注解进行监听.
     * @var string[]
     */
    public $annotations = [
        Foo::class,
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        /** @var Foo $foo */
        $foo = $proceedingJoinPoint->getAnnotationMetadata()->class[Foo::class];
        var_dump($foo->bar);
        $result = $proceedingJoinPoint->process();

        return 'before::' . json_encode($result) . '::after';
    }
}
