<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-15 15:39
 **/

namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 */
class Foo extends AbstractAnnotation
{
    public $bar;
}