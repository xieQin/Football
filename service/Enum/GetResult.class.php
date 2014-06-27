<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuditResult
 *
 * @author zq
 */
class GetResult {
    //put your code here

    const Success = 200;
    const NoVote = 201;
    const ErrorCode = 202;

    public static function getResultMsg($v) {
        switch ($v) {
            case self::NoVote:
                return "尚未投票";
                break;
            case self::Success:
                return "获得投票成功";
                break;
            case self::ErrorCode:
                return "验证码错误";
                break;
        }
    }

}

?>
