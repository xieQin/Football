<?php

define("CONFIG_TAG", "dev");

//dev
if (CONFIG_TAG == "dev") {

    define("DEF_ADMIN_SSO_SERVICE", "http://112.124.26.68/zsgjs2/trunk/");
    define("DEF_ADMIN_SSO_APPKEY", "SHOP_SIEJDJNGSJIEUJSNOFS");

    return array(
        "SERVER_PLAT" => "OWN",
        //本地数据库
        "DB_HOST" => "112.124.26.68:3306",
        "DB_USER" => "zsgjs",
        "DB_PWD" => "zsgjs123456",
        "DB_NAME" => "test",

//        "DB_HOST" => "localhost:3306",
//        "DB_USER" => "root",
//        "DB_PWD" => "123123",
//        "DB_NAME" => "moadb",        
        
        "SMS_KEY" => "51",
        "SMS_SUCRET" => "d08c824d703007fa5c980a904d851897048e2c92",
        "upload_server" => "http://112.124.26.68/ImageServer/trunk/upload_service.php",
        "upload_sign" => "WERGHJMOIJNBGHJLIM1234567890",
        "API_TOKEN_KEYS" => array("UNDHJSU--"),
        "ZJUSER_SERVICE" => array(
            "url" => "http://112.124.26.68/zsgjs2/trunk/Mobi/A/Credits/",
            "appkey" => "SHOP_IUDKJFUEINDFDFDFNIDNFSD",
        ),
    );
}

//test
if (CONFIG_TAG == "test") {

    define("DEF_ADMIN_SSO_SERVICE", "http://2.zsgjs.sinaapp.com/");
    define("DEF_ADMIN_SSO_APPKEY", "SHOP_SIEJDJNGSJIEUJSNOFS");

    return array(
        "SERVER_PLAT" => "SAE",
        //SAE
        "DB_HOST" => SAE_MYSQL_HOST_M . ":" . SAE_MYSQL_PORT,
        "DB_USER" => SAE_MYSQL_USER,
        "DB_PWD" => SAE_MYSQL_PASS,
        "DB_NAME" => SAE_MYSQL_DB,

        "SMS_KEY" => "51",
        "SMS_SUCRET" => "4385856d676e468b099b375425d788ad575913b5",
        "upload_server" => "http://112.124.26.68/ImageServer/trunk/upload_service.php",
        "upload_sign" => "WERGHJMOIJNBGHJLIM1234567890",
        "API_TOKEN_KEYS" => array("UNDHJSU--"),
        "ZJUSER_SERVICE" => array(
            "url" => "http://2.zsgjs.sinaapp.com/Mobi/A/Credits/",
            "appkey" => "SHOP_IUDKJFUEINDFDFDFNIDNFSD",
        ),
    );
}

//pub
if (CONFIG_TAG == "pub") {

    define("DEF_ADMIN_SSO_SERVICE", "http://hg01.sinaapp.com/");
    define("DEF_ADMIN_SSO_APPKEY", "SHOP_SIEJDJNGSJIEUJSNOFS");

    return array(
        "SERVER_PLAT" => "SAE",
        //SAE
        "DB_HOST" => 'w.rdc.sae.sina.com.cn:3307' . ',' . 'r.rdc.sae.sina.com.cn:3307',
        "DB_USER" => 'y40j40w55l',
        "DB_PWD" => '0253y5lhlx324x05y3jzixj4j4j3jz13k25zljz5',
        "DB_NAME" => 'app_zhj8',

        "SMS_KEY" => "51",
        "SMS_SUCRET" => "4385856d676e468b099b375425d788ad575913b5",
        "upload_server" => "http://img1.zsgjs.com/upfile/upload_service.php",
        "upload_sign" => "WERGHJMOIJNBGHJLIM1234567890",
        "API_TOKEN_KEYS" => array("UNDHJSU--"),
        "ZJUSER_SERVICE" => array(
            "url" => "http://hg01.sinaapp.com/Mobi/A/Credits/",
            "appkey" => "SHOP_IUDKJFUEINDFDFDFNIDNFSD",
        ),
    );
}
