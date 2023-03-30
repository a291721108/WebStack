<?php
/**
 * Created by LJL.
 * Date: 2022/3/23
 * Time: 15:11
 */

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;

class UploadController extends BaseController
{
    /**
     * @catalog 小程序API/公共
     * @title 图片上传
     * @description 图片上传
     * @method post
     * @url 39.105.183.79/api/saveFile
     *
     * @param file 必选 string 图片地址
     *
     * @return {"code":200,"msg":"成功","data":[]}
     *
     * @return_param code int 状态吗(200:请求成功,404:请求失败)
     * @return_param msg string 返回信息
     * @return_param data array 返回数据
     * @return_param url string 图片路径
     *
     * @remark
     * @number 6
     */
    public function saveFile(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|file'
        ]);

        $file = $request->file('file');

        // 监测上传文件是否合法
        if (!$file->isValid()) {
            $this->error('error');
        }

        //获取文件名自带后缀
        $filename = $file->getClientOriginalName();

        // 重命名
        $fileNewName = date("YmdHms_", time()) . $filename;

        // 保存位置
        $dir = env("UPLOAD_DIR");

        $pathName = $file->move($dir, $fileNewName);

        if (is_file($pathName)) {
            return json_encode(['url' => env("APP_URL") . $pathName]);
        }

        $this->error('error');
    }
}