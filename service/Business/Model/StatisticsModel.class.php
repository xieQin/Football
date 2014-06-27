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
class StatisticsModel extends ZModelBase {

    //put your code here
    public function __construct() {
        parent::__construct("t_statistics_qqdownload");
    }

    public function increaseByName($name) {
        $entity = array(
            'StatisticsName' => $name,
            'TotalCount' => 1,
            'StatisticsNameCN' => $name,
            'CreateTime' => CommHelper::getPRCNowStr()
        );
        $res = $this->add($entity);

        return $res;
    }

}

?>
