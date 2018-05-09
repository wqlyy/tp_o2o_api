<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 10:49
 */

namespace app\api\controller\v2;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissException;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http  GET
     * @param $id
     * @return string
     * @throws \think\Exception
     */
    public function getBanner($id){
        return 'This is V2 Version';
    }
}