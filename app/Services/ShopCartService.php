<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12
 * Time: 18:16
 */

namespace App\Services;

use App\Models\ShopCart;

class ShopCartService extends BaseService
{
    protected static $_instance;
    protected $_model;

    public function __construct(ShopCart $shopCart)
    {
        $this->_model = $shopCart;
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self(new ShopCart);
        }
        return self::$_instance;
    }

    public function getCartSumCount()
    {
        $result = $this->_model->sum('number');
        return $result ?: '0';
    }

    public function addCartGoods($goodsId)
    {
        if(empty($goodsId)){
            return false;
        }
        $cart = $this->_model->where('goods_id', $goodsId)->first();
        if($cart){
            $shopCartModel = $this->_model->find($cart->id);
            $shopCartModel->number = $cart->number + 1;
        }else{
            $shopCartModel = $this->_model;
            $shopCartModel->number = 1;
            $shopCartModel->add_time = time();
        }
        $shopCartModel->goods_id = $goodsId;
        $result = $shopCartModel->save();
        return $result;
    }

    public function getCartList()
    {
        $result = $this->_model->select('goods.*', 'shop_cart.number')
            ->join('goods', 'goods.id', '=', 'shop_cart.goods_id')
            ->get();
        return $result;
    }
}