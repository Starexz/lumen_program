<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12
 * Time: 18:18
 */

namespace App\Http\Controllers;


use App\Services\ShopCartService;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    protected $shopCartService;

    public function __construct(ShopCartService $shopCartService)
    {
        $this->shopCartService = $shopCartService;
    }

    public function getCartSumCount()
    {
        $result =  $this->shopCartService->getCartSumCount();
        return ['code' => 200, 'data' => $result];
    }

    public function addCartGoods(Request $request)
    {
        $goodsId = $request->input('goods_id');
        $result = $this->shopCartService->addCartGoods($goodsId);
        return ['code' => 200];
    }

    public function getCartList()
    {
        $data = $this->shopCartService->getCartList();
        return ['code' => 200, 'data' => $data];
    }
}