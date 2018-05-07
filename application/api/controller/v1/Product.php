<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 11:18
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

class Product
{
    public function getRecent($count=15){
        (new Count())->goCheck();
        $result = ProductModel::getMostRecent($count);
        if($result->isEmpty()){
            throw new ProductException();
        }
        $result = $result->hidden(['summary']);

        return  $result;
    }
}