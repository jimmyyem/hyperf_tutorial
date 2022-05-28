<?php
/**
 * hyperf 协程及封装.
 * @see https://hyperf.wiki/2.0/#/zh-cn/coroutine
 * 1. go(function() {})
 * 2. co(function() {})
 * 3. Channel 通道
 * 4. Defer
 * 5. WaitGroup
 * 6. Parallel，封装的WaitGroup，使用更便利
 * 7.
 *
 * @date 2022-05-18 14:03:52
 */
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

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Parallel;
use Swoole\Coroutine\Channel;
use Swoole\Coroutine\WaitGroup;

#[AutoController()]
class CoController
{
    /**
     * @Inject
     * @var \Hyperf\Guzzle\ClientFactory
     */
    protected $clientFactory;

    /**
     * @return mixed
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        // return $response->raw('Hello Hyperf!');
        return 1;
    }

    public function sleep(RequestInterface $request)
    {
        $second = $request->query('second', 1);
        $second = (int) $second;
        sleep($second);
    }

    /**
     * 试用 hyperf/swoole 协程并发操作.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return mixed
     */
    public function chan(RequestInterface $request)
    {
        $client = $this->clientFactory->create();
        $start = microtime(true);
        $url = 'http://127.0.0.1:9505/co/sleep?second=2';
        var_dump(1);
        $channel = new Channel();
        co(function () use ($client, $url, $channel) {
            var_dump(2);
            $client->get($url);
            var_dump(3);
            $channel->push(1);
        });
        var_dump(4);
        co(function () use ($client, $url, $channel) {
            var_dump(5);
            $client->get($url);
            var_dump(6);
            $channel->push(2);
        });
        var_dump(7);

        $chan = [];
        $chan[] = $channel->pop();
        $chan[] = $channel->pop();

        $end = microtime(true);

        return [
            'cost_time' => $end - $start,
            'chan' => $chan,
        ];
    }

    /**
     * 使用 hyperf/swoole 协程并发操作.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return mixed
     */
    public function wait(RequestInterface $request)
    {
        $client = $this->clientFactory->create();
        $start = microtime(true);
        $url = 'http://127.0.0.1:9505/co/sleep?second=2';

        $wait = new WaitGroup();
        $wait->add(2);
        $data = [];
        co(function () use ($client, $url, $wait, &$data) {
            $client->get($url);
            $data[] = 123;
            $wait->done();
        });
        co(function () use ($client, $url, $wait, &$data) {
            $client->get($url);
            $data[] = 321;
            $wait->done();
        });

        $wait->wait();

        $end = microtime(true);

        return [
            'cost_time' => $end - $start,
            'data' => $data,
        ];
    }

    /**
     * @return mixed
     */
    public function parallel(RequestInterface $request)
    {
        $parallel = new Parallel();

        $client = $this->clientFactory->create();
        $start = microtime(true);
        $url = 'http://127.0.0.1:9505/co/sleep?second=2';

        $parallel->add(function () use ($client, $url) {
            $client->get($url);

            return 123;
        });

        $parallel->add(function () use ($client, $url) {
            $client->get($url);

            return 321;
        });
        $data = $parallel->wait();

        $end = microtime(true);

        return [
            'cost_time' => $end - $start,
            'data' => $data,
        ];
    }
}
