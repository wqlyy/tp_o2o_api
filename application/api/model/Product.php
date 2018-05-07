<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/5
 * Time: 15:36
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = ['pivot','delete_time','from','create_time','update_time','category_id'];
    public function getMainImgUrlAttr($url,$data){
        return $this->prefixImgUrl($url,$data);
    }

    public static function getMostRecent($count){
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }
}