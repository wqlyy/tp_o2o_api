<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostivenInt;
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
        (new IDMustBePostivenInt())->goCheck();
        $banner = BannerModel::getBannerByID($id);
//        $banner->hidden(['delete_time','update_time','items.type']);
        if(!$banner){
            throw new BannerMissException();
        }
        return $banner;
    }
}