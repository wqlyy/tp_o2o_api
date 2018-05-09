<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/9
 * Time: 11:32
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\OrderPlace;

class Order extends BaseController
{

    //用户选择商品后，向API提交包含它所选择商品的相关信息
    //API在接收到信息后，需要检查订单相关商品的库存量
    //有库存，把订单数据存入数据库中，下单成功，返回客户端信息，通知客户支付
    //调用支付接口，进行支付
    //还需要在此进行库存量检测
    //服务器这边调用微信的支付接口进行支付
    //微信会返回支付结果，根据返回结果进行库存改变
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only'=>'placeorder']//only对应的必须全小写
    ];



    public function placeOrder(){
        (new OrderPlace())->goCheck();
    }
}