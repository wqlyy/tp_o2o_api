<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 15:41
 */

namespace app\api\model;


use think\Model;

class Banner extends Model
{
    //ORM 对象关系映射
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public static function getBannerByID($id){
//       $res = Db::query('select * from banner_item WHERE banner_id=?',[$id]);

//        $res = Db::table('banner_item')
//            ->where('banner_id','=',$id)
//            ->select();


    }
}