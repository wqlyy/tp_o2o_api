<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 15:28
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code=''){
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return $token;
    }
}