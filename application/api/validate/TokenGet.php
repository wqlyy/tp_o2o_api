<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 15:29
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
     protected $rule = [
         'code'=>'require|isNotEmpty'
     ];
     protected $message = [
        'code'=>'请传入Code参数'
     ];
}