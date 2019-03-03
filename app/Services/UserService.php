<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/28
 * Time: 21:12
 */

namespace App\Services;


use App\Models\Users;

class UserService extends BaseService
{
    protected static $_instance;
    protected $_model;

    public function __construct(Users $users)
    {
        $this->_model = $users;
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self(new Users);
        }

        return self::$_instance;
    }

    public function getUserByPhoneAndPassword($phone, $password)
    {
        if(empty($phone) || empty($password)) {
            return [];
        }
        $result = $this->_model->where('phone', $phone)
            ->where('password', $password)
            ->first();
        return $result;
    }
}