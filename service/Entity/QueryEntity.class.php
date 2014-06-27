<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QueryEntity
 *
 * @author zq
 */
class QueryEntity {

    //put your code here
    public $condition;
    public $params;

    function __construct($condition, $params) {
        $this->condition = $condition;
        $this->params = $params;
    }

}

?>
