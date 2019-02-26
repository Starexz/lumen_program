<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/27
 * Time: 16:44
 */

namespace App\Http\Controllers;

use App\Services\GoodsService;
use App\Services\ShopCartService;
use Illuminate\Support\Facades\Config;

class GoodsController extends Controller
{
    protected $goodsService;
    protected $shopCartService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        GoodsService $goodsService,
        ShopCartService $shopCartService
    )
    {
        //
        $this->goodsService = $goodsService;
        $this->shopCartService = $shopCartService;
    }

    //

    public function index()
    {
        $data = $this->goodsService->getAllList();
        return ['code' => 200, 'data' => $data];
    }
}