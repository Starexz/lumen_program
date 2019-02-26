<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/27
 * Time: 14:39
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'goods';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

}