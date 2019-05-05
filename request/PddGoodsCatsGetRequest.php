<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddGoodsCatsGetRequest extends PddRequest
{

    /**
     * @var string 值=0时为顶点cat_id,通过树顶级节点获取cat树
     */
    public $parent_cat_id = '1';

    public $type = 'pdd.goods.cats.get';

    /**
     * @param string $parent_cat_id
     */
    public function setParentCatId(string $parent_cat_id)
    {
        $this->parent_cat_id = $parent_cat_id;
    }
}