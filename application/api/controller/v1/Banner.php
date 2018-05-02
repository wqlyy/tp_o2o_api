<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePostivenInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
use think\Exception;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http  GET
     * @param $id banner的id
     * @return string
     * @throws \think\Exception
     */
    public function getBanner($id){
        (new IDMustBePostivenInt())->goCheck();
        $banner = BannerModel::getBannerByID($id);
        if(!$banner){
            throw new BannerMissException();
        }
        return $banner;

    }
}