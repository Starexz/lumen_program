<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/3
 * Time: 16:34
 */

namespace App\Http\Controllers;

use App\Repositories\LoginRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $request;
    protected $loginRepository;
    public function __construct(
        Request $request,
        LoginRepository $loginRepository
    )
    {
        $this->request = $request;
        $this->loginRepository = $loginRepository;
    }


    public function doLogin()
    {
        $phone = $this->request->input('phone');
        $password = $this->request->input('password');
        $result = $this->loginRepository->doLogin($phone, $password);
        if($result['code'] == 500) {
            return ['code' => 500, 'msg' => $result['msg']];
        }
        return ['code' => 200, 'msg' => '登录成功', 'data' => $result['data']];
    }

    public function logout()
    {
        $uid = $this->request->header('uid');
        $token = $this->request->header('token');
        $result = $this->loginRepository->logout($uid, $token);
        return $result;
    }
}