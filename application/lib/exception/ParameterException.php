<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 15:20
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}