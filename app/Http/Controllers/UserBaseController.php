<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 21:19
 * Email: xubo1395015060@qq.com
 */

namespace App\Http\Controllers;

use App\Common\Auth\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class UserBaseController extends BaseController
{
    use ResponseJson;

    public $uid;

    public function __construct()
    {
        $jwt = JwtAuth::getInstance();
        $this->uid = $jwt->getUid();
    }
}
