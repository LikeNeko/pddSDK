<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddDdkGoodsRecommendGetRequest extends PddRequest
{

    /**
     * @var string 从多少位置开始请求；默认值 ： 0
     */
    public $offset = '0';
    /**
     * @var string 请求数量；默认值 ： 400
     */
    public $limit = '400';
    /**
     * @var string 频道类型；0, "1.9包邮", 1, "今日爆款", 2, "品牌清仓", 3, "默认商城", 非必填 ,默认是1
     */
    public $channel_type = '1';

    public $type = 'pdd.ddk.goods.recommend.get';


    const TYPE_BK = '1';


}