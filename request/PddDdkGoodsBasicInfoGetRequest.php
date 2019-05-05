<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddDdkGoodsBasicInfoGetRequest extends PddRequest
{

    /**
     * @var string 商品id
     */
    public $goods_id_list = [];

    public $type = 'pdd.ddk.goods.basic.info.get';


}