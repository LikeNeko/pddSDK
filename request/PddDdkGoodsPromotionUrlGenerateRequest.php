<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddDdkGoodsPromotionUrlGenerateRequest extends PddRequest
{

    /**
     * @var string 推广位ID
     */
    public $p_id = '';

    /**
     * @var array 商品ID，仅支持单个查询
     */
    public $goods_id_list = [];

    /**
     * @var bool 小程序推广
     */
    public $generate_we_app = true;
    /**
     * @var string 附带参数
     */
    public $custom_parameters = '';


    /**
     * @var bool 是否生成短连接
     */
    public $generate_short_url = true;

    public $type = 'pdd.ddk.goods.promotion.url.generate';


    /**
     * @param string $custom_parameters
     */
    public function  setCustomParameters(string $custom_parameters): void
    {
        $this->custom_parameters = $custom_parameters;
    }

    /**
     * @param string $p_id
     */
    public function setPId(string $p_id): void
    {
        $this->p_id = $p_id;
    }

    /**
     * @param array $goods_id_list
     */
    public function setGoodsIdList(array $goods_id_list): void
    {
        $this->goods_id_list = $goods_id_list;
    }
}