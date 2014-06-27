<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author zq
 */
class ZJFootballModel extends ZModelBase {

    //put your code here
    public function __construct() {
        parent::__construct("zj_champion");
    }

    public function addNew($mobile, $result, $yy, $detail, $name) {

        $entity = array(
            'Mobile' => mymd5($mobile, 'EN', '898'),
            'Result' => $result,
            'CreateTime' => CommHelper::getPRCNowStr(),
            'YY' => $yy,
            'ResultDetail' => $detail,
            'Name' => $name
        );
        $res = $this->add($entity);

        return $res;
    }

    public function getByMobile($mobile) {

        $query = EQ('Mobile', mymd5($mobile, 'EN', '898'));

        return $this->get($query->condition, $query->params, null);
    }

}

?>
