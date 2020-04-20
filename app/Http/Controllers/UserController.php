<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 16:30
 * Email: xubo1395015060@qq.com
 */

namespace App\Http\Controllers;


use App\Common\Auth\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Redis;

class UserController extends UserBaseController
{
    use ResponseJson;

    /**
     *
     * @return false|string
     */
    public function info()
    {
        $jwt = JwtAuth::getInstance();
        $uid = $jwt->getUid();
        $user = User::where('id',$uid)->first();
        if (!$user)
        {
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        }

        return $this->jsonSuccessData([
            'name' => $user->name,
            'email' => $user->email,
            'sex' => $user->sex,
        ]);
    }

    public function infoWithCache()
    {
        $jwt = JwtAuth::getInstance();
        $uid = $jwt->getUid();
//        return $uid;
        $cacheUserInfo = Redis::get('uid:'.$uid);
        if (!$cacheUserInfo){
            $user = User::where('id',$uid)->first();
            if (!$user){
                throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
            }

            Redis::setex('uid'.$uid,3600,json_encode($user->toArray()));
        } else {
            $user = json_decode($cacheUserInfo);
        }

        return $this->jsonSuccessData([
            'name' => $user->name,
            'email' => $user->email,
            'sex' => $user->sex
        ]);
    }
}
