$(document).ready(function($) {
	var currentChoose = { "A" : [], "B" : [], "C" : [], "D": [] }; // 四强选择
	var finalChoose = { "A" : [0], "B" : [0], "C" : [0], "D" : [0]}; //冠军选择

	var hoverClass = "hover";
	var chooseClass = "active";
	var opacityClass = "opacity";
	var url_lv = '';
    var expiredTime = new Date('2014/6/30 10:30');
	var $submitBtn = $("#submitBtn");
    var $resultBtn = $("#showResultBtn");
    var $resultLayer = $("#resultLayer");
	var $closediv = $('#closediv');
    var $submitResult = $('#submitResult');
    var $getCode = $('#getCode');
    var $getResult = $('#getResult');
    var $floatWrap = $("#floatWrap");
    var seconds = 60;
    var interval = setInterval(function() {
    	--seconds;
    	if (seconds == 0) {
			clearInterval(interval);
    	}
	}, 1000);

	getUrl();

    voteHasExpired();

    function voteHasExpired() {
        var now = new Date();
        if (now > expiredTime) {
            $submitBtn.hide();
            $resultBtn.attr('class', 'btnYellow');
            //$(".search_No hover").css('width', '174px');
        }
        //return now > expireTime;

    }

    function getUrl() {
        var v = window.location.href;
        var index = v.lastIndexOf('/');

        url_lv = v.substring(0, index);
    }

    function checkVCode(code) {
    	var reg = /[0-9]{6}/;
    	var res = reg.exec(code);
    	return res
	}

	function easyCheckMobile(mobile) {
    	var reg = /^1[0-9]{10}/;
    	var res = reg.exec(mobile);
    	return res
	}

	$(window).scroll(function() {
    	if ($(window).scrollTop() >= 400) {
        	$floatWrap.show();
    	} else {
        	$floatWrap.hide();
    	}
	})

 	$(".dl1_c16").hover(function() {
 		$(this).addClass(hoverClass);
 	}, function() {
 		$(this).removeClass(hoverClass);
 	}).click(function(){
		var groupNum = $(this).parents("li").attr("groupId"); //分区编号
		var teamNum = $(this).attr("teamNum"); //球队编号
        var team = $(this).parents("ul").children("li").children("div").children("dl");
        var groupResult = currentChoose[groupNum];
        if ($(this)[0].className.indexOf(chooseClass) > -1) {
            $(this).removeClass(chooseClass);
            team.removeClass(opacityClass);
            var newAry = [];
            for (var i = 0; i < groupResult.length; i++) {
                if (groupResult[i] != teamNum) {
                    newAry.push(groupResult[i])
                }
            }
            currentChoose[groupNum] = newAry;
            team.find("i").hide();
			//$(this).find("i").hide();
        } else {
            $(this).addClass(chooseClass);           
            var delNum = groupResult.shift() - 1;
            team.eq(delNum).removeClass(chooseClass);     
            groupResult.push(teamNum);
            team.addClass(opacityClass);
            team.eq(groupResult[0] - 1).removeClass(opacityClass);
            team.find("i").hide();       
			$(this).find("i").show();
        }
	}).bind('click', function(event) {
		var groupNum = $(this).parents("li").attr("groupId"); //分区编号
		var teamNum = $(this).attr("teamNum"); //球队编号
		if(groupNum == "A") {
			var team = $("#A");
			var teamName = teamMap[0].country[teamNum - 1];
			var teamAHtml = '';
			teamAHtml += '<dt class="dt_04" teamNum="' + teamNum + '"><div class="div11"><img src="assets/image/1-' + teamNum + '.png"/><i></i></div></dt><dd class="dd_04 ">' + teamName + '</dd>';
			team.html(teamAHtml);
		}else{
			if(groupNum == "B") {
				var team = $("#B");
				var teamName = teamMap[1].country[teamNum - 1];
				var teamBHtml = '';
				teamBHtml += '<dt class="dt_04" teamNum="' + teamNum + '"><div class="div11"><img src="assets/image/2-' + teamNum + '.png"/><i></i></div></dt><dd class="dd_04 ">' + teamName + '</dd>';
				team.html(teamBHtml);
			}else {
				if (groupNum == "C") {
					var team = $("#C");
					var teamName = teamMap[2].country[teamNum - 1];
					var teamCHtml = '';
					teamCHtml += '<dt class="dt_04 " teamNum="' + teamNum + '"><div class="div11"><img src="assets/image/3-' + teamNum + '.png"/><i></i></div></dt><dd class="dd_04 ">' + teamName + '</dd>';
					team.html(teamCHtml);
				}else {
					var team = $("#D");
					var teamName = teamMap[3].country[teamNum - 1];
					var teamDHtml = '';
					teamDHtml += '<dt class="dt_04 " teamNum="' + teamNum + '"><div class="div11"><img src="assets/image/4-' + teamNum + '.png"/><i></i></div></dt><dd class="dd_04 ">' + teamName + '</dd>';
					team.html(teamDHtml);
				}
			}
		}
	});

	$(".final").hover(function() {
 		$(this).addClass(hoverClass);
 	}, function() {
 		$(this).removeClass(hoverClass);
 	}).click(function() {
 		var teamGroup = $(this).attr("id");
		var championNum = $(this).children('dt').attr("teamNum");
        var finalTeam = $(".final");
        if($(this)[0].className.indexOf(chooseClass) == -1) {
        	finalTeam.find('i').hide();
        	finalTeam.removeClass(chooseClass);
        	finalTeam.addClass(opacityClass);
        	$(this).removeClass(opacityClass);
        	$(this).addClass(chooseClass);
        	$(this).find('i').show();
        	finalChoose[teamGroup] = championNum;
        }
        else {
        	finalTeam.removeClass(opacityClass);
        	$(this).removeClass(chooseClass);
        	finalTeam.find("i").hide();
        }
        
	}).bind('click', function() {
		var teamGroup = $(this).attr("id");
		var championNum = $(this).children('dt').attr("teamNum");
		var teamId = 0;
		var champion = $("#champion");
		//finalChoose = {"groupId":teamGroup,"teamNum":championNum};
		if (teamGroup == "B") {
			teamId = 1;
		}
		if (teamGroup == "C") {
			teamId = 2;
		}
		if (teamGroup == "D") {
			teamId = 3;
		}
		var Id = teamId + 1;
		var teamName = teamMap[teamId].country[championNum - 1];
		var championHtml = '';
		championHtml +='<dt class="dt_04 "><img src="assets/image/'+ Id +'-'+championNum+'.png"/></dt><dd class="dd_04 ">' + teamName + '</dd>';
		var championChoose = 
		champion.html(championHtml);
	});
	
	//十六强
	var teamMap = [
		{"groupId":"A","teamNum":["1","2","3","4"],"imgPath": "1-","country":["巴西","智利","哥伦比亚","乌拉圭"]},
		{"groupId":"B","teamNum":["1","2","3","4"],"imgPath": "2-","country":["法国","尼日利亚","德国","阿尔及利亚"]},
		{"groupId":"C","teamNum":["1","2","3","4"],"imgPath": "3-","country":["荷兰","墨西哥","哥斯达黎加","希腊"]},
		{"groupId":"D","teamNum":["1","2","3","4"],"imgPath": "4-","country":["阿根廷","瑞士","比利时","美国"]},
	]

	var fResult = [
		{"groupID": "A", "teamNum": "0"},
		{"groupID": "B", "teamNum": "0"},
		{"groupID": "C", "teamNum": "0"},
		{"groupID": "D", "teamNum": "0"},
	]

	var championResult = [
		{"groupId":"A", "teamNum":"0"},
		{"groupId":"B", "teamNum":"0"},
		{"groupId":"C", "teamNum":"0"},
		{"groupId":"D", "teamNum":"0"},
	]

	function showSubmitDiv() {
        document.getElementById("overDiv").style.display = "block";
        document.getElementById("hsDiv").style.display = "block";
    }

    function closeSubmitDiv() {
        clearInterval(interval);
        $getCode.attr("disabled", false);
        $getCode.val('获取验证码');
        $getCode.css({'font-weight': 'normal', 'width': '88px'});
        document.getElementById("overDiv").style.display = "none";
        document.getElementById("hsDiv").style.display = "none";
    }

//获取数据

    $("#getcode_num").click(function() {
        $(this).attr("src", url_lv + '/service/index.php/Index/createCode?' + Math.random());
    });

    $getResult.bind('click', function() {
//alert('123123');
        var mobile = $('#result_mobile').val();
        var code = $('#result_code').val();
        //getMyVot

        if (mobile.length != 11 || !easyCheckMobile(mobile)) {
            alert('请输入正确的手机号');
            return;
        }
//mobileTmp = v_mobile;
        $.ajax({
            url: url_lv + "/service/index.php/Index/getMyVot",
            data: {
                'phone': mobile,
                'code': code
            },
            type: "post",
            dataType: "json",
            success: function(data) {
            	//alert(data.d);
                if (data) {
                    if (data.s == 200) {
//alert('获得验证码成功');
                        closeSubmitDiv();
                        var result = data.d[0];
                        var detail = data.d[1];

                        result = aryToJson(JSON.parse(result));
                        detail = aryToJson(JSON.parse(detail));
                        alertResult(result,detail);
                    } else if (data.s == 201) {
                        alert('尚未投票，请先投票');
                    }
                    else if (data.s == 202) {
                        alert('验证码错误');
                    }
                    $("#getcode_num").attr("src", url_lv + '/service/index.php/Index/createCode?' + Math.random());
                }
            }, error: function() {//失败
                alert('网络异常');
                $("#getcode_num").attr("src", url_lv + '/service/index.php/Index/createCode?' + Math.random());
            }
        });
    });

	 function alertResult(result,detail) {
        var mask = $("#winMask").show();
        var closeBtn = $resultLayer.find(".closeBtn");
        mask.one("click", function() {
            $(this).hide();
            $resultLayer.hide();
        })

        closeBtn.one("click", function() {
            mask.hide();
            $resultLayer.hide();
        })

        $(window).scrollTop(200);
        var myResult = $("#my4");
        var finalResult = $("#final4");
        var lotteryResult = $("#lottery4");
        var myChampion = $("#myChampion");
        var finalChampion = $("#finalChampion");
        var chamLottery = $("#chamLottery");
        $resultLayer.show();
        autoMid($resultLayer);
        var resultHtml = '';
        for (var i = 0; i < 4; i++) {
            var teamNum = result[teamMap[i].groupId].sort()[0];
            var teamName = teamMap[i].country[teamNum - 1]
            resultHtml += '<dl style="padding:0 160px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/' + teamMap[i].imgPath + teamNum + '.png"></div></div><div class="titCenter">' + teamName + '</div></div></dd></dl>';
        }

        //输出4强结果
        var finalHtml = '';

        for (var i = 0; i < 4; i++) {
            if (fResult[i].teamNum != 0) {
            	var teamName = teamMap[i].country[fResult[i].teamNum - 1];
                finalHtml += '<dl style="width:100px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/' + teamMap[i].imgPath + fResult[i].teamNum + '.png"></div></div><div class="titCenter">' + teamName + '</div></div></dd></dl>';
            }else {
                finalHtml += '<dl style="width:100px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/jqqd.png"></div></div><div class="titCenter">敬请期待...</div></div></dd></dl>';
            }
        }

        //输出预测结果
        var lotteryHtml ='';
        for (var i = 0; i < 4; i++) {
            if (result[teamMap[i].groupId].sort()[0] == fResult[i].teamNum) {
                lotteryHtml += '<dl><dt class="wid10">' + '<span></span><div><img style="margin-top:28px;" src="assets/image/02.png"></div></dt></dl>';
            }
            else {
                if(fResult[i].teamNum == 0){
                    lotteryHtml += '<dl><dt class="wid10">' + '<span></span><div><img style="margin-top:28px;" src="assets/image/wenhao.png"></div></dt></dl>';
                }
                else {
                    lotteryHtml += '<dl><dt class="wid10">' + '<span></span><div><img style="margin-top:28px;" src="assets/image/01.png"></div></dt></dl>';
                }    
            }
        }
        
        //预测冠军
        var myChampionHtml = '';
        for (var i = 0; i < 4; i++) {
        	var championNum = detail[teamMap[i].groupId].sort()[0];
        	var championGroup;
        	var championName;
        	if (championNum != 0) {

        		championName = teamMap[i].country[championNum - 1];
        		championGroup = i;
        		myChampionHtml = '<dl style="padding:0 160px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/' + teamMap[championGroup].imgPath + championNum + '.png"></div></div><div class="titCenter">' + championName + '</div></div></dd></dl>';
        	}
        	
        }
        //myChampionHtml = '<dl style="padding:0 160px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/' + teamMap[i].imgPath + teamNum + '.png"></div></div><div class="titCenter">' + teamName + '</div></div></dd></dl>';
        
        myChampion.html(myChampionHtml);
        //最终冠军

        var finalChampionHtml = '';
        for(var i = 0; i < 4; i++) {
        	var championNum = championResult[i].teamNum;
        	var championGroup;
        	var championName;
        	if (championNum != 0) {

        		championName = teamMap[i].country[championNum - 1];
        		championGroup = i;
        		finalChampionHtml = '<dl style="padding:0 160px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/' + teamMap[championGroup].imgPath + championNum + '.png"></div></div><div class="titCenter">' + championName + '</div></div></dd></dl>';
        		break;
        	}
        	else {
        		finalChampionHtml = '<dl style="padding:0 160px;"><dd class="wid100"><div class="holderNo_po"><div class="flag"><div class="icon_right"><img src="assets/image/jqqd.png"></div></div><div class="titCenter">敬请期待...</div></div></dd></dl>';
        	}
        }

        var chamLotteryHtml = '';
        for (var i = 0; i < 4; i++) {
            if (championResult[i].teamNum != 0) {
                if (detail[teamMap[i].groupId].sort()[0] == championResult[i].teamNum) {
                    chamLotteryHtml = '<dl><dt class="wid10">' + '<span></span><div><img style="margin-top:28px;" src="assets/image/02.png"></div></dt></dl>';
                }
                else {
                    chamLotteryHtml = '<dl><dt class="wid10">' + '<span></span><div><img style="margin-top:28px;" src="assets/image/01.png"></div></dt></dl>';
                }
                break;
            }
            else {
                chamLotteryHtml = '<dl><dt class="wid10">' + '<span></span><div><img style="margin-top:28px;" src="assets/image/wenhao.png"></div></dt></dl>';
            }
        }
        chamLottery.html(chamLotteryHtml);
        finalChampion.html(finalChampionHtml);
        myResult.html(resultHtml);
        lotteryResult.html(lotteryHtml);
        finalResult.html(finalHtml);
        changeColor();

    }

    function changeColor() {
        var des = document.getElementById("result");
        var dls = des.getElementsByTagName("dl");
        for(var i = 0; i < dls.length; i += 2) {
            dls[i].style.background = '#f2f2f2';
        }
    }

//查看结果
    $resultBtn.bind("click", function() {

        console.info("查看结果")
        $('#tbdiv').hide();
        $('#tbdiv1').show();
        $('#result_mobile').val('请输入您的手机号');
        $('#result_code').val('请输入图片中的验证码');

        $('#getcode_num').attr("src", url_lv + '/service/index.php/Index/createCode?' + Math.random());
        showSubmitDiv();
    })

//提交
    $submitBtn.bind("click", function() {

        $('#tbdiv1').hide();
        $('#tbdiv').show();
        $('#v_yy').val('请输入您的YY数字ID');
        //$('#v_code').val('请输入您的验证码');
        $('#v_mobile').val('请输入您的手机号');
        $('#v_name').val('请输入姓名或YY昵称');


        if (!checkResult(currentChoose)) {
            alertControl(1);
            return;
        }


        showSubmitDiv();
//        if (checkResult(currentChoose)) {
//            pushData()
//        } else {
//            alertControl(1);
//        }

    })

    $getCode.bind('click', function() {
        var v_mobile = $('#v_mobile').val();
        if (v_mobile.length != 11 || !easyCheckMobile(v_mobile)) {
            alert('请输入正确的手机号');
            return;
        }
        mobileTmp = v_mobile;
        $.ajax({
            url: url_lv + "/service/index.php/Index/getCode",
            data: {
                'phone': mobileTmp
            },
            type: "post",
            dataType: "json",
            success: function(data) {
                if (data) {
                    if (data.s == 200) {
                        alert('获得验证码成功');
                        seconds = 60;
                        $getCode.attr("disabled", true);
                        interval = setInterval(function() {
                            --seconds;
                            $getCode.val(seconds + ' 秒');
                            $getCode.css({'font-weight': 'bold', 'width': '60px'});
                            if (seconds == 0) {
                                $getCode.attr("disabled", false);
                                $getCode.val('获取验证码');
                                $getCode.css({'font-weight': 'normal', 'width': '88px'});
                                clearInterval(interval);
                            }
                        }, 1000);

                    } else {
                        alert('获得验证码失败');
                    }
                }
            }, error: function() {//失败
                alert('失败');
            }
        });
    });

    $closediv.bind('click', function() {
        closeSubmitDiv();
    });

    $submitResult.bind('click', function() {
        var v_code = $('#v_code').val();
        if (v_code.length != 6 || !checkVCode(v_code)) {
		//closeSubmitDiv();
		//alertControl(4, null, '请输入手机验证码');
            alert('请输入手机验证码');
            return;
        }
        var v_mobile = $('#v_mobile').val();
        if (v_mobile.length != 11 || !easyCheckMobile(v_mobile)) {
            alert('请输入正确的手机号');
            return;
        }
        var v_yy = $('#v_yy').val();
        if (v_yy != '' && v_yy != '请输入您的YY数字ID' && isNaN(v_yy)) {
            alert('请输入YY数字ID');
            return;
        }
        var v_name = $('#v_name').val();
        if (v_name == '' || v_name == '请输入姓名或YY昵称') {
            alert('请输入姓名或YY昵称');
            return;
        }
        if (!checkResult(currentChoose)) {
            alertControl(1);
            return;
        } else {
            pushData();
        }
    });

//提交数据

    function pushData() {
        //var de = combineResultString(currentChoose);
        var ddd=33333;
        $.ajax({
            url: url_lv + "/service/index.php/Index/submitResult",
            data: {
                'phone': $('#v_mobile').val(),
                'yy': $('#v_yy').val() == '请输入您的YY数字ID' ? '' : $('#v_yy').val(),
                'result': "[" + jsonToAry(currentChoose) + "]",
                'code': $('#v_code').val(),
                'detail': "["+ jsonToAry(finalChoose) + "]",
                'name': $('#v_name').val()
            },
            type: "post",
            dataType: "json",
            success: function(data) {
                closeSubmitDiv();
                if (data) {
                    alertControl(1, null, data.d);
                }
            }, error: function() {//失败
                closeSubmitDiv();
                alertControl(1, null, '网络异常');
            }
        });
    }

    function checkResult(currentChoose) {
        var allChoose = true;
        for (i in currentChoose) {
           if (currentChoose[i].length != 1) {
                allChoose = false;
           }
        }
        if((finalChoose["A"][0] == 0)&&(finalChoose["B"][0] == 0)&&(finalChoose["C"][0] == 0)&&(finalChoose["D"][0] == 0)) {
            allChoose = false;
        }
        return allChoose;
    }

    //控制弹出层
    function alertControl(type, fn, msg) {
        var mask = $("#winMask").show();
        var currentLayer = $("#active1-alert").find(".alert-wrap").eq(type).show();
        autoMid(currentLayer);
        var closeBtn = currentLayer.find(".closeBtn");
        var confirmBtn = currentLayer.find(".confirmBtn");
        closeBtn.one("click", function() {
            mask.hide();
            currentLayer.hide();
        })

        confirmBtn.one("click", function() {
            mask.hide();
            currentLayer.hide();
        })

        if (msg) {
            var msgText = currentLayer.find(".infoTxt");
            if (msgText) {
                msgText.html(msg);
            }
        }

        switch (type) {
            case 0: //队伍没选全
                break;
            case 1:   //提交成功
                break;
            case 2:  //提交失败
                break;
            case 3://登陆网银
                break;
            case 4:
                break;
        }

        fn && fn();
    }

});