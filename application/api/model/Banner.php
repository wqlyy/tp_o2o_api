<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 15:41
 */

namespace app\api\model;


class Banner extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];
    //ORM 对象关系映射
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public static function getBannerByID($id){
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
    }
}