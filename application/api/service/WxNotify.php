<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10
 * Time: 15:14
 */

namespace app\api\service;

use app\api\model\Product;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');

class WxNotify extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg){
        if($data['result_code'] == 'SUCCESS'){
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try{
                $order = OrderModel::where('order_no','=',$orderNo)
                    ->lock(true)
                    ->find();
                if($order->status == 1){
                    $service = new OrderService();
                    $stockStatus = $service->checkOrderStock($order->id);
                    if($stockStatus['pass']){
                        $this->updateOrderStatus($order->id,true);
                        $this->reduceStock($stockStatus);
                    }else{
                        $this->updateOrderStatus($order->id,false);
                    }
                }
                Db::commit();
                return true;
            }catch (Exception $ex){
                Db::rollback();
                Log::record($ex);
                return false;
            }
        }else{
            //告知微信我已经知道支付失败了，不用继续通知了
            return true;
        }
    }
    private function reduceStock($stockStatus){
        foreach ($stockStatus['pStatusArray'] as $singleStatus){
//            $singleStatus['count']
            Product::where('id','=',$singleStatus['id'])->setDec('stock',$singleStatus['count']);
        }
    }
    private function updateOrderStatus($orderID,$success){
        $status = $success?OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id','=',$orderID)->update(['status'=>$status]);
    }
}