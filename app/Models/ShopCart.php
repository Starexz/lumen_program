<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12
 * Time: 18:16
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'shop_cart';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}