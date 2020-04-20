<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 15:06
 * Email: xubo1395015060@qq.com
 */

namespace App\Http\Controllers;

use App\Common\Auth\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class JwtLoginController extends BaseController
{
    use ResponseJson;

    /**
     * 用户登录
     * @param Request $request
     * @return false|string
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        //去数据库或缓存中验证该用户
        $res = User::where('email',$email)->first();
        if (!$res)
        {
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        }

        //
        $userPasswordHash = $res['password'];
        if (!password_verify($password,$userPasswordHash)) {
            throw new ApiException(ApiErrDesc::ERR_PASSWORD);
        }

        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid($res['id'])->encode()->getToken();

        return $this->jsonSuccessData([
           'token' => $token,
            'id' => $res['id']
        ]);

    }
}









