<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 16:59
 * Email: xubo1395015060@qq.com
 */

namespace App\Exceptions;


use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiErrConst, Throwable $previous = null)
    {
        $code = $apiErrConst[0];
        $message = $apiErrConst[1];

        parent::__construct($message, $code, $previous);
    }
}
