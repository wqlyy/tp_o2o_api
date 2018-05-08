<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 11:04
 */

namespace app\api\service;


class Token
{
    public static function generateToken(){
        //32个字符随机字符串
        $randChars = getRandChars(32);
        //三组字符串，进行MD5签名;
        $timestamp = $_SERVER['REQUEST_TIME'];
        $salt = config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }
}