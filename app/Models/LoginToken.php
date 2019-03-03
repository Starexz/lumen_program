<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/27
 * Time: 20:01
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model
{
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'login_token';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}