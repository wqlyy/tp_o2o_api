<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 16:43
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 404;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;
}