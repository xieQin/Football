<?php

class BaseAction extends Action {

    function response($result, $os) {
        $des = DES($os, True);

        if ($result instanceof ReRight) {
            return $des->encode(json_encode(array("s" => "200", "d" => $result->reObj)), DES_KEY);
        }

        if ($result instanceof ReFail) {
            return $des->encode(json_encode(array("s" => $result->code, "d" => $result->desc)), DES_KEY);
        }

        return $des->encode('{"s":"400","d":"操作失败"}', DES_KEY);
    }

    function responseRight($result) {
        return json_encode(array("s" => "200", "d" => $result));
    }

    function responseFail($result, $code = 201) {
        return json_encode(array("s" => $code, "d" => $result));
    }

    function checkTokenValid($ignoreMethods) {
        global $q_apitoken, $_QueryMethod;
        parent::__before();

        //不判断的方法
        $ignMethods = is_array($ignoreMethods) ? $ignoreMethods : array();
        if (in_array($_QueryMethod, $ignMethods)) {
            return;
        }

        $checkApiToken = getC("API_TOKEN_KEYS");
        if (!checkApiToken($q_apitoken, $checkApiToken)) {
            echo API_TOKEN_INVALID;
            exit;
        }
    }

}

?>
