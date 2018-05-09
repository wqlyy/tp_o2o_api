<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 14:29
 */

namespace app\api\controller\v1;


use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends Controller
{

    protected $beforeActionList = [
        'checkPrimaryScope' => ['only'=>'createorupdateaddress']//only对应的必须全小写
    ];

    protected function checkPrimaryScope(){
        $scope = TokenService::getCurrentTokenVer('scope');
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

    public function createOrUpdateAddress(){
        $validate = new AddressNew();
        $validate->goCheck();
        //根据token获取uid
        $uid = TokenService::getCurrentUid();
        //根据uid来查找用户数据，判断用户是否存在，如果不在，抛出异常
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        //获取用户从客户端提交过来的数据
        $dataArray = $validate->getDataByRule(input('post.'));
        //根据用户地址是否存在，从而判断添加地址还是更新地址
        $userAddress = $user->address;
        if(!$userAddress){
            $user->address()->save($dataArray);
        }else{
            //更新
            $user->address->save($dataArray);
        }
//        return $user;
        return json(new SuccessMessage(),201);
    }
}