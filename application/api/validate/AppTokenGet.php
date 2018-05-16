<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 10:55
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected $rule = [
      'ac' => 'require|isNotEmpty',
      'se' => 'require|isNotEmpty'
    ];
}