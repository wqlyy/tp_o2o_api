<?php

namespace app\api\model;

use think\Model;

class Image extends Model
{
    protected $hidden = ['id','from','delete_time','update_time'];

    public function getUrlAttr($value,$data){
        if($data['from'] == 1){
            return config('queue.img_prefix').$value;
        }else{
            return $value;
        }
    }
}
