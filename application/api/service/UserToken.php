<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 15:38
 */

namespace app\api\service;


use app\lib\exception\WeChatException;
use think\Exception;

class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code){
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception('获取session_key以及openID时异常，微信内部错误');
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                $this->grantToken($wxResult);
            }
        }
    }
    private function grantToken($wxResult){
        //拿到openid
        //对比数据库openid是否存在
        //如果存在不处理，不存在则新增一条user记录
        //生成令牌，保存相关数据值缓存
        //返回至客户端
        $openid=$wxResult['openid'];
    }
    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode']
        ]);
    }
}
