<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/5
 * Time: 15:54
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids'=>'require|checkIDs'
    ];

    protected $message = [
        'ids'=>'ids必须以逗号分隔的正整数'
    ];
    protected function checkIDs($value, $rules){
        $values = explode(',',$value);
        if (empty($values)){
            return false;
        }
        foreach ($values as $id){
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}