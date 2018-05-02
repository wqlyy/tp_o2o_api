<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePostivenInt;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http  GET
     * @param $id banner的id
     * @throws \think\Exception
     */
    public function getBanner($id){
//        $data = [
//            'id'=>$id
//        ];
//        $validate = new IDMustBePostivenInt();
//        $result = $validate->check($data);
//        if($result){}else{
//            $e = $validate->getError();
//        }
        (new IDMustBePostivenInt())->goCheck();

    }
}