<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddDdkTopGoodsListQueryRequest extends PddRequest
{

    /**
     * @var string 1-实时热销榜；2-实时收益榜
     */
    public $sort_type = 1;

    /**
     * @var string 从多少位置开始请求；默认值 ： 0
     */
    public $offset = '0';

    /**
     * @var int 请求数量；默认值 ： 400
     */
    public $limit = 400;

    public $type = 'pdd.ddk.top.goods.list.query';



}