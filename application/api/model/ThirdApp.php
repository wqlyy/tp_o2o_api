<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 11:03
 */

namespace app\api\model;


class ThirdApp extends BaseModel
{
    public static function check($ac,$se){
        $app = self::where('app_id','=',$ac)
            ->where('app_secret','=',$se)->find();
        return $app;
    }
}