<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 11:16
 */

namespace app\api\validate;





class IDMustBePostivenInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isPostivenInteger'
    ];
    protected $message = [
        'id.require'=>'请传入id参数',
        'id.isPostivenInteger'=>'id必须是正整数'
    ];
}