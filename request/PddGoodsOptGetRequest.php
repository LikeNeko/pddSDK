<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddGoodsOptGetRequest extends PddRequest
{

    /**
     * @var string 值=0时为顶点cat_id,通过树顶级节点获取cat树
     */
    public $parent_opt_id = '0';

    public $type = 'pdd.goods.opt.get';

    /**
     * @param string $parent_opt_id
     */
    public function setParentOptId($parent_opt_id)
    {
        $this->parent_opt_id = $parent_opt_id;
    }
}