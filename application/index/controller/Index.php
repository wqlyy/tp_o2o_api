<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 18:01
 */

namespace app\index\controller;


class Index
{
    public function index(){
        $key = 'XDEBUG_SESSION_START';
        $port = input($key);
//
        return "欢迎访问首页，获取XDEBUG端口:<h2 style='color: red'>?$key=$port</h2>";
    }
}