<?php
/**
 * hyperf配置的使用，3种方式
 * @see https://hyperf.wiki/2.0/#/zh-cn/config
 * 1. 注入 ConfigInterface，然后通过 get() 方法获取
 * 2. 注入 @Value("databases.default.driver") 获取
 * 3. config("databases.default.driver"); 获取
 * 
 * @author yanhuaguo
 * @date 2022-05-17 21:59
 **/

namespace App\Controller;

use Hyperf\Config\Annotation\Value;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller(prefix: "config")]
class ConfigController
{
    /**
     * @Value("databases.default.driver")
     */
    protected $driver;

    /**
     * @Inject()
     * @var \Hyperf\Contract\ConfigInterface
     */
    protected $config;

    /**
     * @return mixed
     */
    #[GetMapping("")]
    public function index(RequestInterface $request)
    {
        $key = $request->query('key', 'app_name');
        return [
            'config_class_value' => $this->config->get($key),
            'dirver' => $this->driver,
            'config_func_value' => config($key),
        ];
    }
}