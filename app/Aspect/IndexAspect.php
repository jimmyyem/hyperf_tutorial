<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-15 15:38
 **/

namespace App\Aspect;

use App\Annotation\Foo;
use App\Controller\ConfigController;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

#[Aspect()]
class IndexAspect extends AbstractAspect
{
    public $classes = [
        //ConfigController::class,
        //IndexController::class,
        //'App\Controller\DataController::index',
    ];

    public $annotations = [
        Foo::class,
    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        /** @var Foo $foo */
        $foo = $proceedingJoinPoint->getAnnotationMetadata()->class[Foo::class];
        var_dump($foo->bar);
        $result = $proceedingJoinPoint->process();

        return "before::".json_encode($result)."::after";
    }
}