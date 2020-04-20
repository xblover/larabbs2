<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 16:48
 * Email: xubo1395015060@qq.com
 */

namespace App\Common\Err;


class ApiErrDesc
{
    /**
     * API 通用错误码
     *
     * error_code < 1000
     */
    const SUCCESS = [0, 'Success'];
    const UNKNOWN_ERR = [1,'未知错误'];
    const ERR_URL = [2,'访问的接口不存在'];

    const ERR_PARAMS = [100,'参数错误'];


    /**
     * err_code 1001-1100 用户登录相关的错误码
     */
    const ERR_PASSWORD = [1001,'密码错误'];
    const ERR_LOGIN_OVERDUE = [1002,'登录过期'];
    const ERR_USER_NOT_EXIST = [1003,'用户不存在'];


}
