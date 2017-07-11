<?php

namespace App;

class Api
{
    /**
     * 处理api请求返回
     *
     * @param $data
     * @param string $msg
     * @param int $code
     * @return mixed
     */
    static function result($data, $msg = '', $code = 200)
    {
        $result = [
            'status' => [
                'code' => $code,
                'msg' => $msg
            ],
            'data' => $data
        ];

        return response()->json($result);
    }
}