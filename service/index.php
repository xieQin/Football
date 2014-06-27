<?php
session_start();
define("DES_KEY", "JiwLYG=-");


//应用zj_php框架
require_once '../zj_php/zj_php.php';
//设置应用路径
setC("APP_PATH", dirname(__FILE__));
//设置 APP URL
$arr1 = explode("index.php", $_SERVER["SCRIPT_NAME"]);
setC("APP_URL", $arr1[0]);
setC("APP_URL_ACTIONTAG", "A/");


//添加应用自动加载类路径
add_autoload_path(getC("APP_PATH")."/Action/");
add_autoload_path(getC("APP_PATH")."/Business/");
add_autoload_path(getC("APP_PATH")."/Entity/");
add_autoload_path(getC("APP_PATH")."/Business/Model/");
add_autoload_path(getC("APP_PATH")."/Lib/");
add_autoload_path(getC("APP_PATH")."/Enum/");

//添加应用配置文件
add_app_config(getC("APP_PATH")."/Config/AppConf.php");
require_once "./Config/DbQueryFunc.php";



//执行请求
Runtime::doQuery();
