<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommHelper
 *
 * @author zq
 */
class CommHelper {

    //put your code here
    public static function arrayIsEmptyOrNull($entity) {
        if (!is_array($entity))
            return true;
        $i = empty($entity) || count($entity) == 0;
        return $i;
    }

    public static function combineTime($time) {
        $nowTime = date("Y-m-d ");
        return $nowTime . trim($time);
    }

    public static function getPRCNowTime() {
        date_default_timezone_set("PRC");
        return time();
    }

    public static function getPRCTimeByString($timeString) {
        return strtotime($timeString);
    }

    public static function getPRCNowStr() {
        $t = self::getPRCNowTime();
        return date("Y-m-d H:i:s", $t);
    }

    public static function getPRCNowStrByTime($now) {
        return date("Y-m-d H:i:s", $now);
    }

    public static function getPRCTimeAfterDays($days) {
        date_default_timezone_set("PRC");
        return strtotime("+" . $days . " day");
    }

    public static function daydiff($begin_time, $end_time) {
        if ($begin_time < $end_time) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        $timediff = $endtime - $starttime;
        $days = intval($timediff / 86400);

        return $days;
    }

    public static function isNULL($params) {
        return !isset($params) || empty($params);
    }

    public static function isDateFormat($timeString) {

        if (empty($timeString)) {
            return 0;
        }
        return preg_match("/^[0-9]{4}(\-|\/)[0-9]{1,2}(\\1)[0-9]{1,2}(|\s+[0-9]{1,2}(:[0-9]{1,2}){0,2})$/", $timeString);
    }

    public static function array_search_between_time($st = null, $ed = null) {
        $start = 0;
        $end = 0;
        $stIndex = 0;
        $edIndex = 0;
        if (!empty($st)) {
            $start = strtotime($st);
        }
        if (!empty($ed)) {
            $end = strtotime($ed);
        }
        $output = array();
        if (empty($st) && !empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] > $end) {
                    $edIndex = $key - 1;
                    break;
                }
            }
            if ($key === -1) {
                return null;
            }
            $output = array_slice($res, 0, $edIndex + 1);
        } else if (!empty($st) && empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start) {
                    $stIndex = $key;
                    break;
                }
            }
            if ($key === -1) {
                return null;
            }
            $output = array_slice($res, $stIndex, count($res) - $stIndex);
        } else if (!empty($st) && !empty($ed)) {
            $getFirst = FALSE;
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start && !$getFirst) {
                    $stIndex = $key;
                    $getFirst = TRUE;
                }
                if ($value["TimeSort"] > $end) {
                    $edIndex = $key - 1;
                    break;
                }
            }
            if ($edIndex < $stIndex) {
                return null;
            }
            $output = array_slice($res, $stIndex, $edIndex - $stIndex);
        }
        return $output;
    }

    public static function array_search_between_time1($res, $st = null, $ed = null) {
        $start = 0;
        $end = 0;
        if (!empty($st)) {
            $start = strtotime($st);
        }
        if (!empty($ed)) {
            $end = strtotime($ed);
        }
        $output = array();
        if (empty($st) && !empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] <= $end) {
                    array_push($output, $value);
                }
            }
        } else if (!empty($st) && empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start) {
                    array_push($output, $value);
                }
            }
        } else if (!empty($st) && !empty($ed)) {
            foreach ($res as $key => $value) {
                if ($value["TimeSort"] >= $start && $value["TimeSort"] <= $end) {
                    array_push($output, $value);
                }
            }
        }
        return $output;
    }

    public static function randomkeys($length) {
        $output = '';
        for ($a = 0; $a < $length; $a++) {
            $output .= chr(mt_rand(48, 57));    //生成php随机数
        }
        return $output;
    }

    public static function IndexOf($string, $c) {
        $index = strpos($string, $c);

        return substr($string, 0, $index);
    }

    public static function getCode($num, $w, $h) {
        $code = "";
        for ($i = 0; $i < $num; $i++) {
            $code .= rand(0, 9);
        }
        //4位验证码也可以用rand(1000,9999)直接生成 
        //将生成的验证码写入session，备验证时用 
        $_SESSION["veri_num"] = $code;
        //创建图片，定义颜色值 
        header("Content-type: image/PNG");
        $im = imagecreate($w, $h);
        $black = imagecolorallocate($im, 0, 0, 0);
        $gray = imagecolorallocate($im, 200, 200, 200);
        $bgcolor = imagecolorallocate($im, 255, 255, 255);
        //填充背景 
        imagefill($im, 0, 0, $gray);

        //画边框 
        imagerectangle($im, 0, 0, $w - 1, $h - 1, $black);

        //随机绘制两条虚线，起干扰作用 
        $style = array($black, $black, $black, $black, $black,
            $gray, $gray, $gray, $gray, $gray
        );
        imagesetstyle($im, $style);
        $y1 = rand(0, $h);
        $y2 = rand(0, $h);
        $y3 = rand(0, $h);
        $y4 = rand(0, $h);
        imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
        imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);

        //在画布上随机生成大量黑点，起干扰作用; 
        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
        }
        //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成 
        $strx = rand(3, 8);
        for ($i = 0; $i < $num; $i++) {
            $strpos = rand(1, 6);
            imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
            $strx += rand(8, 12);
        }
        imagepng($im); //输出图片 
        imagedestroy($im); //释放图片所占内存 
    }

}

?>