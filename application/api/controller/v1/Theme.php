<?php

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostivenInt;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * $url /theme?ids=id1,id2.....
     */
    public function getSimpleList($ids=''){
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $result = ThemeModel::with('topicImg,headimg')->select($ids);
        if($result->isEmpty()){
            throw new ThemeException();
        }
        return $result;
    }

    /**
     * @url /theme/:id
     */
    public function getComplexOne($id){
        (new IDMustBePostivenInt())->goCheck();
        $theme = ThemeModel::getThemeWithProduct($id);
        if(!$theme){
            throw new ThemeException();
        }
        return $theme;
    }
}
