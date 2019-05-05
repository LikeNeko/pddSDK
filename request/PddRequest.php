<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:51 PM
 */

namespace pdd\request;

abstract class PddRequest
{
    /*
     * 参数
     */
    public $type = '';
    public $access_token = '';
    public $timestamp = '';
    public $data_type = 'JSON';
    public $version = '';
    public $sign = '';

    public function __construct()
    {
        $this->timestamp = time();
    }



    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return 'post';
    }

    /**
     * @return bool
     */
    public function getRequestCache(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getUrlHttp(): string
    {
        return 'http://gw-api.pinduoduo.com/api/router';
    }

    /**
     * @return string
     */
    public function getUrlHttps(): string
    {
        return 'https://gw-api.pinduoduo.com/api/router';
    }




}