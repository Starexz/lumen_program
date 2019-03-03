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

    public function getCartSumCount($uid)
    {
        if(empty($uid)) {
            return '0';
        }
        $result = $this->_model->where('uid', $uid)->sum('number');
        return $result ?: '0';
    }

    public function addCartGoods($goodsId, $uid)
    {
        if(empty($goodsId) || empty($uid)){
            return false;
        }
        $cart = $this->_model->where('goods_id', $goodsId)->where('uid', $uid)->first();
        if($cart){
            $shopCartModel = $this->_model->find($cart->id);
            $shopCartModel->number = $cart->number + 1;
        }else{
            $shopCartModel = $this->_model;
            $shopCartModel->number = 1;
            $shopCartModel->add_time = time();
        }
        $shopCartModel->goods_id = $goodsId;
        $shopCartModel->uid = $uid;
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