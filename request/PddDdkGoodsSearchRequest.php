<?php
/**
 * Created by PhpStorm.
 * User: Neko
 * Date: 2019/1/21
 * Time: 5:48 PM
 */

namespace pdd\request;

class PddDdkGoodsSearchRequest extends PddRequest
{
    public $keyword = '';

    public $opt_id = '';

    public $page = '1';

    public $page_size = '100';

    public $sort_type = '1';

    public $cat_id = '';

    public $goods_id_list = [];

    public $with_coupon = 'true';

    public $type = 'pdd.ddk.goods.search';

    /**
     * @param string $sort_type
     */
    public function setSortType(string $sort_type): void
    {
        $this->sort_type = $sort_type;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @param string $page_size
     */
    public function setPageSize(string $page_size): void
    {
        $this->page_size = $page_size;
    }

    /**
     * @param string $page
     */
    public function setPage(string $page): void
    {
        $this->page = $page;
    }

    /**
     * @param string $opt_id
     */
    public function setOptId(string $opt_id): void
    {
        $this->opt_id = $opt_id;
    }


}