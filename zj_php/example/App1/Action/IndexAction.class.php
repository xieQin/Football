<?php

/**
 * Description of IndexAction
 *
 * @author Joy
 */
class IndexAction extends Action {
    
    public function index() {
        echo "this is IndexAction index";
    }
    
    public function m1()
    {
        global $_QueryAction, $_QueryMethod;
        my_log($_QueryAction);
        my_log($_QueryMethod);
    }

    public function m2() {
        echo "this is IndexAction m2";
    }

    public function m3() {
        //echo getC("TPL_PATH");
        $viewData["aa"] = "aaaa";
        $viewData["bb"] = "bbbb";

        renderView("Index", "m3", $viewData);
    }

    public function m4() {
        $Data["aa"] = "aaaa";
        $Data["bb"] = "bbbb";
        renderJson($Data);
    }

    public function upload() {
        renderView("Index", "upload");
    }

    public function upload_do() {
        if (isset($_FILES['file'])) {
            $tArr = explode(".", $_FILES["file"]["name"]);
            $type = $tArr[count($tArr) - 1];

            $filename = $_FILES["file"]["tmp_name"];
            $handle = fopen($filename, "r");
            $data = fread($handle, filesize ($filename));
            fclose($handle);
    
            $server = getC("upload_server");
            $sign = getC("upload_sign");
            
            echo upload_file($server, $data, $type, $sign);
        }
    }
}

?>
