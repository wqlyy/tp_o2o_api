<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 16:50
 */

namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    //需要返回客户端当前请求的URL路径

    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            //如果是自定义异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            if(config('app_debug')){
                return parent::render($e);
            }else{
                $this->code=500;
                $this->msg='服务器内部错误,请稍候重试~';
                $this->errorCode=999;
                $this->recordErrorLog($e);
            }
        }
        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code'=>$this->errorCode,
            'requ est_url'=>$request->url()
        ];
        return json($result,$this->code);
    }
    private function recordErrorLog(Exception $e){
        Log::init([
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}