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
    protected $request;

    public function __construct(
        Request $request,
        ShopCartService $shopCartService
    )
    {
        $this->shopCartService = $shopCartService;
        $this->request = $request;
    }

    public function getCartSumCount()
    {
        $uid = $this->request->header('uid');
        $result =  $this->shopCartService->getCartSumCount($uid);
        return ['code' => 200, 'data' => $result];
    }

    public function addCartGoods()
    {
        $goodsId = $this->request->input('goods_id');
        $uid = $this->request->header('uid');
        $result = $this->shopCartService->addCartGoods($goodsId, $uid);
        return ['code' => 200];
    }

    public function getCartList()
    {
        $data = $this->shopCartService->getCartList();
        return ['code' => 200, 'data' => $data];
    }
}