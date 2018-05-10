<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10
 * Time: 16:30
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected $rule = [
        'page'=>'isPositiveInteger',
        'size'=>'isPositiveInteger'
    ];
    protected $message = [
        'page'=>'分页参数必须为正整数',
        'size'=>'分页参数必须为正整数'
    ];
}