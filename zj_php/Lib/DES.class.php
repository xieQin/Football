<?php

/**
 * DES 加解密
 * 
 * 注意： 会把加密后字符串中的 “/” 替换成 “@@”，“+” 替换成 “$$”。
 * 
 * @author joy
 */

abstract class DES {

    public static function all_osTag()
    {
        return array("android", "ios", "debug");
    }
    
    public static function share($osTag) {
        if ("ios" == $osTag) {
            return new IOSDES();
        }
        
        if ("android" == $osTag) {
            return new AndroidDES();
        }
        
        if ("debug" == $osTag) {
            return new DebugDES();
        }
    }

    public function encode($content, $key) {
        return "";
    }

    public function decode($content, $key) {
        return "";
    }
}

class DebugDES extends DES 
{
    public function encode($content, $key) {
        return $content;
    }

    public function decode($content, $key) {
        return $content;
    }
}

class AndroidDES extends DES {

    var $key;
    var $iv; //偏移量

    public function encode($content, $key) {
        $this->key = $key;
        $this->iv = $key;

        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $str = $this->pkcs5Pad($content, $size);
        $data = mcrypt_cbc(MCRYPT_DES, $this->key, $str, MCRYPT_ENCRYPT, $this->iv);
        $ret = base64_encode($data);
        $ret = str_replace("/","@@",$ret);
        $ret = str_replace("+","$$",$ret);
        return $ret;
    }

    public function decode($content, $key) {
        $this->key = $key;
        $this->iv = $key;

        $content = str_replace("@@", "/", $content);
        $content = str_replace("$$", "+", $content);
        $content = base64_decode($content);
        $content = mcrypt_cbc(MCRYPT_DES, $this->key, $content, MCRYPT_DECRYPT, $this->iv);
        $content = $this->pkcs5Unpad($content);
        return $content;
    }

    function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5Unpad($text) {
        $pad = ord($text {strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, - 1 * $pad);
    }
}

class IOSDES extends DES {

    var $key;

    public function encode($content, $key) {
        $this->key = $key;
        $ivArray = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF);
        $iv = null;
        foreach ($ivArray as $element)
            $iv.=CHR($element);


        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $content = $this->pkcs5Pad($content, $size);

        $data = mcrypt_encrypt(MCRYPT_DES, $this->key, $content, MCRYPT_MODE_CBC, $iv);

        $data = base64_encode($data);
        $data = str_replace("/","@@",$data);
        $data = str_replace("+","$$",$data);
        
        return $data;
    }

    public function decode($content, $key) {
        $this->key = $key;
        $content = str_replace("@@", "/", $content);
        $content = str_replace("$$", "+", $content);
        
        $ivArray = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xAB, 0xCD, 0xEF);
        $iv = null;
        foreach ($ivArray as $element)
            $iv.=CHR($element);

        $content = base64_decode($content);

        $result = mcrypt_decrypt(MCRYPT_DES, $this->key, $content, MCRYPT_MODE_CBC, $iv);
        $result = $this->pkcs5Unpad($result);

        return urldecode($result);
    }

    function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5Unpad($text) {
        $pad = ord($text {strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, - 1 * $pad);
    }
}

