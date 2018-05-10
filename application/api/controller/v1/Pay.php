<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10
 * Time: 11:48
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePositiveInt;
use app\api\service\Pay as PayService;
class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope'=>['only'=>'getpreorder']
    ];
    public function getPreOrder($id=''){
        (new IDMustBePositiveInt())->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }


    public function receiveNotify(){
        //微信通知频率：15/15/30/180/1800/1800/1800/1800/3600;单位：秒
        //1.检查库存量,超卖
        //2.更新订单的status状态
        //3.减去相应库存
        //4.如果成功处理，返回微信成功处理的消息，否则返回没有成功处理，微信继续发起通知
        // 特点：POST，XML格式，不会携带参数

        $notify = new WxNotify();
        $notify->Handle();
    }
}