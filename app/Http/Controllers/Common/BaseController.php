<?php
/**
 * Created by LJL.
 * Date: 2022/3/14
 * Time: 15:41
 */

namespace App\Http\Controllers\Common;

use App\Exceptions\ErrorCode;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    /**
     * @param string $msg
     * @param int $code
     * @param array $data
     * @return false|string
     */
    public function success(string $msg, int $code = 200, array $data = [])
    {
        $msg = (new ErrorCode())->getSuccessMsg($msg);

        $response = [
            'meta' =>[
                'status' => $code,
                'msg'  => $msg
            ],
//            'data' => is_array($data) ? nullToStr($data) : $data
            'data' => is_array($data) ? $data : nullToStr($data)

        ];

        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return false|string
     */
    public function error(string $msg, int $code = 404, array $data = [])
    {
        $msg = (new ErrorCode())->getErrorMsg($msg);

        $response = [
            'meta' =>[
                'status' => $code,
                'msg'  => $msg
            ],
            'data' => $data
        ];

        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $url
     * @param bool $params
     * @param int $ispost
     * @param int $https
     * @return bool|string
     */
    public static function curl($url, bool $params = false, int $ispost= 0, int $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);

        return $response;
    }

}
