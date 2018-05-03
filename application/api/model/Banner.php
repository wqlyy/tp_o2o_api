<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 15:41
 */

namespace app\api\model;


class Banner
{
    public static function getBannerByID($id){
        if($id){
            return json([1,2,3]);
        }
        return null;
    }
}