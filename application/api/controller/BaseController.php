<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/9
 * Time: 14:44
 */

namespace app\api\controller;

use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
    protected function checkPrimaryScope(){
        TokenService::needPrimaryScope();
    }
    protected function checkExclusiveScope(){
        TokenService::needExclusiveScope();
    }
}