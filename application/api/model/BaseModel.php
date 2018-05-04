<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/4
 * Time: 17:44
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{

    protected function prefixImgUrl($url,$data){
        if($data['from'] == 1){
            return config('queue.img_prefix').$url;
        }else{
            return $url;
        }
    }
}