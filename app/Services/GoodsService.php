<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/27
 * Time: 16:33
 */

namespace App\Services;


use App\Models\Goods;

class GoodsService extends BaseService
{

    protected static $_instance;
    protected $_model;

    public function __construct(Goods $goods)
    {
        $this->_model = $goods;
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self(new Goods);
        }

        return self::$_instance;
    }

    public function getAllList()
    {
        return $this->_model->all();
    }
}