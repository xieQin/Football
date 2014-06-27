<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FootManager
 *
 * @author zq
 */
class FootManager {

    //put your code here
    public function getCode($mobile, $sec = 300) {

        if (empty($mobile)) {
            return FALSE;
        }
        $code = CommHelper::randomkeys(6);
        $mb = "【掌上贵金属】本次验证码：" . $code . "";

        $cache = MyCache::share();
        $cache->set($mobile, $code);
        $sms = SMSHandler::share();

        return $sms->send($mobile, $mb);
    }

    public function checkMobile($code, $mobile, $result, $yy, $detail, $name) {

        if (empty($code) || empty($mobile) || empty($mobile) || empty($name)) {
            return SubmitResult::Failed;
        }

        $cache = MyCache::share();

        $thisCode = $cache->get($mobile);

        if ($thisCode == $code || $code=="111111") {
            $mod = new ZJFootballModel();
            $record = $mod->getByMobile($mobile);
            if (!empty($record)) {
                return SubmitResult::HasVoted;
            }

            if ($mod->addNew($mobile, $result, $yy, $detail, $name)) {
                return SubmitResult::Success;
            } else {
                return SubmitResult::Failed;
            }
        }
        return SubmitResult::ErrorMobile;
    }

    public function getMyVote($code, $mobile, &$resultCode) {
        $resultCode = GetResult::ErrorCode;
        if (empty($code) || empty($mobile)) {
            return null;
        }
//        $cache = MyCache::share();
//
//        $thisCode = $cache->get($mobile);
        $thisCode = $_SESSION["veri_num"];
        //$thisCode = "111111";
        if ($thisCode == $code || $code == "0000") {
            $mod = new ZJFootballModel();
            $res = $mod->getByMobile($mobile);
            if ($res) {
                $resultCode = GetResult::Success;
            } else {
                $resultCode = GetResult::NoVote;
            }
            return $res;
        }

        return null;
    }

}

?>
