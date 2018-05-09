<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 11:20
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
    protected $message = [
        'count'=>'最新商品count数量只能在1-15之间'
    ];
}