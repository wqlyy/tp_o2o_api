<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 11:04
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken(){
        //32个字符随机字符串
        $randChars = getRandChars(32);
        //三组字符串，进行MD5签名;
        $timestamp = $_SERVER['REQUEST_TIME'];
        $salt = config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }

    public static function getCurrentTokenVer($key){
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }else{
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }else{
                throw new Exception('尝试获取Token变量并不存在');
            }
        }
    }
    public static function getCurrentUid(){
        $uid = self::getCurrentTokenVer('uid');
        return $uid;
    }

    //用户和CMS管理员都可以访问
    public static function needPrimaryScope(){
        $scope = self::getCurrentTokenVer('scope');
        if($scope){
            if($scope >= ScopeEnum::User){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }
    //只有用户才能访问
    public static function needExclusiveScope(){
        $scope =self::getCurrentTokenVer('scope');
        if($scope){
            if($scope == ScopeEnum::User){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }

    public static function isValidOperate($checkedUID){
        if(!$checkedUID){
            throw new Exception('检查UID时，必须传入一个被检查的UID');
        }
        $currentOperateUID = self::getCurrentUid();
        if($currentOperateUID == $checkedUID){
            return true;
        }
        return false;
    }
    public static function verifyToken($token){
        $exist = Cache::get($token);
        if($exist){
            return true;
        }else{
            return false;
        }
    }
}