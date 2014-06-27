<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReFail
 *
 * @author joy
 */
class ReFail
{
    
    public $code;
    public $desc;
    
    
    public static function Fail($code, $desc)
    {
        $re = new Refail();
        $re->code = "$code";
        $re->desc = $desc;
        
        return $re;
    }
}

?>
