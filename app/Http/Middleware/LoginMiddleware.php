<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/26
 * Time: 22:23
 */

namespace App\Http\Middleware;

use App\Repositories\LoginRepository;
use App\Services\LoginTokenService;
use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        $uid = $request->header('uid');
        $loginTokenService = LoginTokenService::getInstance();
        $overTime = $loginTokenService->getOverTime($uid, $token);
        if($overTime < time() || empty($overTime)) {
            return response()->json(array('code' => 401,'msg'=>'登录信息过期！'));
        }
        return $next($request);
    }
}