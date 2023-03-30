<?php

namespace App\Exceptions;


class ErrorCode
{


    /**
     * 错误数组
     * @var array|string[]
     */
    public array $errorCode = [
        'success'                 => "成功",
        'error'                   => "失败",
        'user_not_exists'         => "未查询到此用户,请检查填写信息是否正确",
        'permissions_error'       => "账号信息和当前微信不匹配",
        'password_error'          => "密码错误,请重新输入",
        "account_disabled"        => "该账号已禁用",
        'company_is_have'         => "公司已存在,无需重新申请",
        'data_not_exist'          => "今天还没有打卡",
        'phone_error'             => "手机号错误",
        'code_send_success'       => "验证码发送成功",
        'code_expired'            => "验证吗已过期",
        'licence_expired'         => "激活码已过期",
        'licence_error'           => "激活码错误",
        'code_error'              => "验证吗输入错误",
        'code_has_time'           => "验证吗任在有效期内，请稍后在试",
        'password_length_error'   => "密码格式错误,请输入6-12位字符密码",
        'password_style_error'    => "密码格式不正确",
        'update_true'             => "修改密码成功",
        'login_success'           => "登录成功",
        'up_message_ture'         => "修改信息成功",
        'redis_write_token_error' => "请求异常，令牌存入失败",
        'has_child'               => "请先删除子集任务",
        'import_success'          => "导入成功",
        'push_success'            => "推送成功",
        'oneInterview_error'      => "未执行初次审核",
        'oneInterview_pass'       => "初次审核未通过",
        'secondInterview_pass'    => "复试审核未通过",
    ];


    /**
     * 返回错误
     * @param $code
     * @return mixed|string
     */
    public function getErrorMsg($code)
    {
        $code == 'false' ?? $code = 'error';
        return $this->errorCode[$code];
    }


    /**
     * 返回成功
     * @param $code
     * @return mixed|string
     */
    public function getSuccessMsg($code)
    {
        $code == 'true' ?? $code = 'success';
        return $this->errorCode[$code];
    }

}
