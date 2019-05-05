<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:46 PM
 */

namespace pdd;

use app\common\tools\Request;
use function GuzzleHttp\Psr7\build_query;
use \pdd\request\PddRequest;
use think\Exception;
use think\facade\Cache;
use think\facade\Log;
use think\helper\Str;

/**
 * Class PopHttpClient
 * 请求类
 *
 * @package extend\pdd
 */
class PopHttpClient
{
    /**
     * @var string
     */
    public $client_id = '';

    public $client_secret = '';

    public $request_data = [];

    private $url = '';

    private $request_type = '';
    private $request_cache = true;

    private $cache_key = 'PopHttpClientShopInfo:';

    /**
     * @var int 缓存时间
     */
    private $cache_time = 36000;

    public function __construct(string $clientId = '', string $clientSecret = '')
    {

        $this->client_id     = $clientId;
        $this->client_secret = $clientSecret;
        if (empty($clientId)) {
            $this->client_id     = config('app.pdd_client_id');
            $this->client_secret = config('app.pdd_client_secret');
        }
    }

    public static function init()
    {
        return new self();
    }


    /**
     * 处理请求
     *
     * @param PddRequest $request
     *
     * @return array|mixed
     */
    public function syncInvoke(PddRequest $request)
    {
        // 反射机制去拿对象属性
        $this->handleData($request);

        $response = $this->send();

        return $this->handleResponse($response);
    }

    /**
     * 返回请求结果
     *
     * @param \Requests_Response $response
     *
     * @return mixed|array
     */
    private function handleResponse(\Requests_Response $response)
    {
        if ($response->status_code == 200) {
            $data_array = json_decode($response->body, true);
            foreach ($data_array as $key => $item) {
                return $item;
            }
            return $data_array;
        } else {
            throw new Exception('请求返回异常', 4000);
        }
    }

    /**
     * 利用反射机制拿接口类的属性
     *
     * @param PddRequest $request
     *
     * @return void
     */
    private function handleData(PddRequest $request)
    {
        $ref = new \ReflectionClass($request);

        $this->url           = $request->getUrlHttps();
        $this->request_type  = $request->getRequestType();
        $this->request_cache = $request->getRequestCache();

        $this->request_data['client_id'] = $this->client_id;;
        foreach ($ref->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PUBLIC) as $property) {
            if (!empty($property->getValue($request)) || $property->getValue($request) == '0') {
                $this->request_data[$property->getName()] = $property->getValue($request);
            }
        }

        $this->request_data['sign'] = $this->createSign();

    }

    /**
     * createSign创建sign串
     *
     * @return string
     */
    private function createSign()
    {
        $data = $this->request_data;
        ksort($data);
        $str = '';
        foreach ($data as $key => $datum) {
            if (is_array($datum)) {
                $datum = json_encode($datum);
            }
            if (is_bool($datum)) {
                $datum = $datum ? "true" : "false";
            }
            $str .= $key . $datum;
        }


        return Str::upper(md5($this->client_secret . $str . $this->client_secret));
    }

    /**
     * 发送请求
     *
     * @return \Requests_Response
     */
    private function send()
    {

        $data = $this->request_data;
        $key  = $this->request_data;

        $this->request_data = [];

        $url = $this->url . "?" . $this->build_query($data);


        unset($key['timestamp']);
        unset($key['sign']);
        $key = $this->build_query($key);

        $ret = $this->getCache($key);

        if ($ret && $this->request_cache) {
            return $ret;
        }
        switch ($this->request_type) {
            case "post":
                $ret = Request::xPost($url);

                if ($ret->status_code == 200) {
                    $this->setCache($key, $ret);
                }
                break;
            default:
                throw new Exception('未定义的请求方法');
        }
        return $ret;
    }

    /**
     * 设置缓存
     *
     * @param $key
     * @param $data
     *
     * @return void
     */
    private function setCache($key, $data)
    {
        $key = md5($this->cache_key . $key);
        Cache::store('file')->set($key, $data, $this->cache_time);
    }

    /**
     * 读取缓存
     *
     * @param $key
     *
     * @return mixed
     */
    private function getCache($key)
    {
        $key = md5($this->cache_key . $key);
        return Cache::store('file')->get($key);
    }

    private function build_query($data)
    {
        $post_url = '';
        foreach ($data AS $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }
            if (is_bool($value)) {
                $value = $value ? "true" : "false";
            }
            $post_url .= $key . '=' . $value . '&';

        }
        $post_url = rtrim($post_url, '&');
        return $post_url;
    }
}