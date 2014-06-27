<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReRight
 *
 * @author joy
 */
class ReRight {
    
    public $reObj;
    public static function Right($reObj = true)
    {
        $re = new ReRight();
        $re->reObj = $reObj;
        return $re;
    }
}

?>
