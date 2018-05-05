<?php

namespace app\api\controller\v1;

use app\api\validate\IDCollection;

class Theme
{
    /**
     * $url /theme?ids=id1,id2.....
     * @return array
     */
    public function getSimpleList($ids=''){
        (new IDCollection())->goCheck();
        return 'susess';
    }
}
