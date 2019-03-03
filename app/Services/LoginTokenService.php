<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/28
 * Time: 21:33
 */

namespace App\Services;


use App\Models\LoginToken;

class LoginTokenService extends BaseService
{

    protected $overTime = 3600;

    protected static $_instance;
    protected $_model;

    public function __construct(LoginToken $loginToken)
    {
        $this->_model = $loginToken;
    }

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self(new LoginToken);
        }

        return self::$_instance;
    }

    public function addData($data)
    {
        if(empty($data)) {
            return 0;
        }
        $model = $this->_model;
        foreach ($data as $key => $value) {
            if($value == '') {
                continue;
            }
            $model->$key = $value;
        }
        $model->save();
        if($model->id) {
            return $model->id;
        }
        return 0;
    }

    public function addToken($uid)
    {
        if(empty($uid)) {
            return '';
        }
        $model = $this->_model->where('uid', $uid)->first();
        $token = md5(time());
        if(!$model) {
            $model = $this->_model;
            $model->uid = $uid;
            $model->over_time = time() + $this->overTime;
            $model->add_time = time();
        }
        $model->token = $token;
        $result = $model->save();
        if(!$result) {
            return '';
        }
        return $token;
    }

    public function getOverTime($uid, $token)
    {
        if (empty($uid) || empty($token)) {
            return false;
        }
        $result = $this->_model->where('uid', '=', $uid)
            ->where('token', '=', $token)
            ->first();
        return $result->over_time;
    }

    public function clearToken($uid, $token)
    {
        $model = $this->_model->where('uid', $uid)->where('token', $token)->first();
        if(!$model){
            return false;
        }
        $model->token = '';
        $model->save();
        return true;
    }
}