<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddDdkGoodsDetailRequest extends PddRequest
{

    /**
     * @var array 商品ID，仅支持单个查询。例如：[123456]
     */
    public $goods_id_list = [];

    public $type = 'pdd.ddk.goods.detail';


    /**
     * @param array $goods_id_list
     */
    public function setGoodsIdList(array $goods_id_list)
    {
        $this->goods_id_list = $goods_id_list;
    }



}