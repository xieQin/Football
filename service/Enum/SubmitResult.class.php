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
class SubmitResult {
    //put your code here

    const Success = 200;
    const Failed = 201;
    const ErrorMobile = 202;
    const HasVoted = 203;
    const VoteExpired = 204;

    public static function getResultMsg($v) {
        switch ($v) {
            case self::HasVoted:
                return "已投票";
                break;
            case self::Failed:
                return "投票失败";
                break;
            case self::Success:
                return "投票成功";
                break;
            case self::ErrorMobile:
                return "验证码错误";
                break;
            case self::VoteExpired:
                return "投票已结束"；
                break;
        }
    }

}

?>
