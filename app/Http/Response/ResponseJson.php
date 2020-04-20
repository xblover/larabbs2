<?php
/**
 * Created by PhpStorm
 * User: xubo
 * Date: 2020/4/12
 * Time: 14:25
 * Email: xubo1395015060@qq.com
 */

namespace App\Http\Response;

/**
 * Trait ResponseJson
 * @package App\Http\Response
 */
trait ResponseJson
{

    /**
     * 当APP接口出现业务异常时的返回
     * @param $code
     * @param $message
     * @param array $data
     * @return false|string
     */
    public function jsonData($code,$message,$data = [])
    {
        return $this->jsonResponse($code,$message,$data);
    }

    /**
     * APP 接口请求成功时的返回
     * @param $data
     * @return false|string
     */
    public function jsonSuccessData($data)
    {
        return $this->jsonResponse(0, 'Success', $data);
    }

    /**
     * 返回一个json
     * @param $code
     * @param $message
     * @param $data
     * @return false|string
     */
    private function jsonResponse($code, $message, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data,
        ];

        return response()->json($content);
    }
}
