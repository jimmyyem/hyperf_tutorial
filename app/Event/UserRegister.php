<?php
/**
 *
 * @author yanhuaguo
 * @date 2022-05-24 10:11
 **/

namespace App\Event;

class UserRegister
{
    // 建议这里定义成 public 属性，以便监听器对该属性的直接使用，或者你提供该属性的 Getter
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}