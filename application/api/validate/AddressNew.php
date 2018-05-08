<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 14:39
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
      'name' => 'require|isNotEmpty',
      'mobile' => 'require|isMobile',
      'province' => 'require|isNotEmpty',
      'city' => 'require|isNotEmpty',
      'country' => 'require|isNotEmpty',
      'detail' => 'require|isNotEmpty'
    ];
}