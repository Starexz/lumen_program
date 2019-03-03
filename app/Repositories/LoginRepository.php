<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/27
 * Time: 21:29
 */

namespace App\Repositories;


use App\Services\LoginTokenService;
use App\Services\UserService;

class LoginRepository
{

    protected $userService;
    protected $loginTokenService;

    public function __construct(
        UserService $userService,
        LoginTokenService $loginTokenService
    )
    {
        $this->userService = $userService;
        $this->loginTokenService = $loginTokenService;
    }

    public function doLogin($phone, $password)
    {
        if(empty($phone) || empty($password)) {
            return ['code' => 500, 'msg' => '请输入手机号或密码'];
        }
//        $password = md5(md5($password));
        $user = $this->userService->getUserByPhoneAndPassword($phone, $password);
        if ($user) {
            // 添加token
            $token = $this->loginTokenService->addToken($user->id);
            $returnData = [
                'uid' => $user->id,
                'token' => $token,
                'username' => $user->username
            ];
            return ['code' => 200, 'msg' => '用户存在', 'data' => $returnData];
        }
        return ['code' => 500, 'msg' => '帐号或密码不正确'];
    }


    public function logout($uid, $token)
    {
        $result = $this->loginTokenService->clearToken($uid, $token);
        if(!$result) {
            return ['code' => 500, '退出失败'];
        }
        return ['code' => 200, 'msg' => '退出成功'];
    }
}