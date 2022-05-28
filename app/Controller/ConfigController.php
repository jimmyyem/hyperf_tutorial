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

use Hyperf\Config\Annotation\Value;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller(prefix: 'config')]
class ConfigController
{
    /**
     * @Value("databases.default.driver")
     */
    protected $driver;

    /**
     * @Inject
     * @var \Hyperf\Contract\ConfigInterface
     */
    protected $config;

    /**
     * @return mixed
     */
    #[GetMapping('')]
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
