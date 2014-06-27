/**
 * Created by SDX on 2014/5/9.
 * vision:1.0
 * title: 世界杯活动工具函数库
 * e-mail:jrshenduxian@jd.com
 * 导航：
 */


/**
 * 用户登录弹窗
 */

function alertLogInBox(fn) {
    jdModelCallCenter.settings = {
        'fn': function () {
            helloService();
            fn && fn();
        }
    };
    jdModelCallCenter.login();
}

function helloService() {
    $.ajax({
        url: ("https:" == document.location.protocol ? "https://" : "http://") + "passport." + pageConfig.FN_getDomain() + "/new/helloService.ashx?m=ls",
        dataType: "jsonp",
        scriptCharset: "gb2312",
        success: function (a) {
            a && a.info && $("#loginbar").html(a.info),
                a && a.sso && $.each(a.sso,
                function () {
                    $.getJSON(this);
                });
        }
    });
}


/**
 * 存储读取用户选择
 */
function setUserChoose(settings) {
    var setType = settings.setType;
    var contType = settings.contType;
    var json = settings.json;
    var userName = settings.userName || "";
    var cName = null
    if (!contType)return false;
    switch (contType) {
        case "0":
            cName = "JD_football16" + userName;
            break;
        case "1":
            cName = "JD_resultGuess" + userName;
            break;
    }
    if (setType == "save") {
        var value = JSON.stringify(json);
        setCookie(cName, value, 1);
    } else {
        return getCookie(cName);
    }
}


/*cookie存储*/
function setCookie(c_name, value, expiredays) {
    var exdate = new Date()
    exdate.setDate(exdate.getDate() + expiredays)
    document.cookie = c_name + "=" + encodeURI(value) +
        ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
}


function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=")
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1
            c_end = document.cookie.indexOf(";", c_start)
            if (c_end == -1) c_end = document.cookie.length
            return decodeURI(document.cookie.substring(c_start, c_end))
        }
    }
    return ""
}


/**
 * json对象转换为jsonList;
 */
function jsonToAry(json) {
    var ary = [];
    for (i in json) {
        ary.push("{\"" + i + "\":[" + json[i].toString() + "]}")
    }
    return ary.toString();
}

/**
 * jsonList转换为json
 */
function aryToJson(ary) {
    var json = {};
    for (var i = 0; i < ary.length; i++) {
        for (j in ary[i]) {
            json[j] = ary[i][j]
        }
    }
    return json;
}


/**
 *自动垂直居中
 * @param obj
 */
function autoMid(obj) {
    var winHeight = $(window).height();
    var winScrollTop = $(window).scrollTop();
    var objH = obj.height();
    obj.css("top", winScrollTop + Math.max(0, (winHeight - objH) / 2) + "px")
}

/**
 *  平滑滚动
 */
function navScroll(obj, time) {
    if(!obj[0])return false;
    var n = 0;
    var start = $(window).scrollTop();
    var currentTarget = $(window).scrollTop();
    var target = obj.offset().top;
    //console.info("start:" + start + "----target:" + target)
    var totalNum = time / 20;
    var timer = setInterval(function () {
        currentTarget = (target - currentTarget) * (n / totalNum) + currentTarget;
        n++;
        $(window).scrollTop(currentTarget);
        if (n == totalNum) {
            clearInterval(timer)
        }
    }, 20)
}


/**
 *  吸顶灯效果
 */
function cellingLight() {

}





