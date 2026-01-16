$(function(){
	$.fn.popupCenter = function(){
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2)) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2)) + "px");
    return this;
	}
});

//링크시 점선 없애주기
document.onfocusin=function(){try{if(event.srcElement.tagName=="A")event.srcElement.blur();}catch(e){}}

/*-------------------------------------------------------------------------
   쿠키 가져오기
  -------------------------------------------------------------------------*/
function getCookie( name ){
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
			endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}

		x = document.cookie.indexOf( " ", x ) + 1;

		if ( x == 0 ) break;
	}
			return "";
}


/*-------------------------------------------------------------------------
   쿠키 생성
  -------------------------------------------------------------------------*/
function setCookie( name, value, expiredays ) {

		if(expiredays != null){
			var todayDate = new Date();
			todayDate.setDate(todayDate.getDate() + expiredays);
			document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
		}else{
			document.cookie = name + "=" + escape( value ) + "; path=/;";
		}
}

/*-------------------------------------------------------------------------
   쿠키 삭제
  -------------------------------------------------------------------------*/
function delCookie (name) {
		var exp = new Date();
		exp.setTime (exp.getTime() - 1);
		var cval = getCookie (name);
		document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}

function openLayerPopup(src, w, h){
	$("#popup .popimg").html("<img src='"+src+"'/>");
	$("#popup").css({"width":w,"height":h});
	$("#popup").show();
}

function closeLayerPopup(str){
	if(str != ''){
		setCookie("pop", "done");
	}
	$("#popup").hide();
}

function openPopup(src, name, w, h, features){
	var noticeCookie=getCookie(name);
	if(noticeCookie != "yes") openCenterPopup(src, name, w, h, features);
}

function openCenterPopup(theURL, winName, w, h, features){
	x = (screen.availWidth - w) / 2;
	y = (screen.availHeight - h) / 2;
	if(features != ''){
		features += ',width='+w+',height='+h+',left='+x+',top='+y;
	}else{
		features = 'width='+w+',height='+h+',left='+x+',top='+y;
	}
	window.open(theURL,winName,features);
}

function formatCurrency(number){
	var str = String(number);

	if(!isNaN(str)){
		if(str != 'Infinity'){
			var temp = [];

			if(number < 0) str = str.substr(1);

			while(str.length > 3){
				temp.push(str.slice(str.length - 3));
				str = str.slice(0, str.length - 3);
			}
			temp.push(str);

			str = temp.reverse().join(",");

			if(number < 0) str = "-" + str;

			return str;
		}else{
			return '∞';
		}
	}else{
		return '';
	}
}

//숫자만 입력받기....
function isNum(){
	if(event.keyCode>=48 && event.keyCode<=57){
		return true;
	}
	return false;
}

function chkNumber(num) {
	var pattern = /^[0-9]+$/;
	return (pattern.test(num));
}

function checkSSN(ssn) {

    // 주민번호의 형태와 7번째 자리(성별) 유효성 검사
    fmt = /^\d{6}-?[123456]\d{6}$/;
    if (!fmt.test(ssn)) {
        return false;
    }

    // 날짜 유효성 검사
    birthYear = (["1", "2", "5", "6"].include(ssn.charAt(7))) ? "19" : "20";
    birthYear += ssn.substr(0, 2);
    birthMonth = ssn.substr(2, 2) - 1;
    birthDate = ssn.substr(4, 2);
    birth = new Date(birthYear, birthMonth, birthDate);

    if ( birth.getYear() % 100 != ssn.substr(0, 2) || birth.getMonth() != birthMonth || birth.getDate() != birthDate) {
        return false;
    }

    // Check Sum 코드의 유효성 검사
	if(["1", "2", "3", "4"].include(ssn.charAt(7))){
		buf = new Array(13);
		for (i = 0; i < 6; i++) buf[i] = parseInt(ssn.charAt(i));
		for (i = 6; i < 13; i++) buf[i] = parseInt(ssn.charAt(i + 1));

		multipliers = [2,3,4,5,6,7,8,9,2,3,4,5];
		for (i = 0, sum = 0; i < 12; i++) sum += (buf[i] *= multipliers[i]);

		if ((11 - (sum % 11)) % 10 != buf[12]) {
			return false;
		}
	}

	return true;

}

function checkEmail(str){
	let regex = new RegExp('^[\._a-zA-Z0-9-]+@[._a-zA-Z0-9-]+\.[a-zA-Z]+$');
	return regex.test(str);
}

function checkBizNo(num) {
	var pattern = /^([0-9]{3})-?([0-9]{2})-?([0-9]{5})$/;
	if(!pattern.test(num)) return false;
	num = RegExp.$1 + RegExp.$2 + RegExp.$3;
	var keyArr = [1,3,7,1,3,7,1,3,5];
	var chk = 0;

	keyArr.forEach(function(val, idx){
		chk+= parseInt(num.substr(idx, 1)) * val;
	});
	chk+= Math.floor(parseInt(num.substr(8,1)) * 5 / 10);
	chk = 10 - (chk % 10);
	if(chk == 10) chk = 0;
	return (parseInt(num.substr(-1)) == chk) ? true : false;
}

function checkCellPhone(num) {
	var pattern = /^(01[016789]{1})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
	return (pattern.test(num)) ? true : false;
}

function checkIsDate(dt){
	var str = /^[1-2][0-9]{3}[\-][0-1][0-9][\-][0-1][0-9]$/;
	return str.test(dt);
	return true;
}

function getFileSize(size){
	var units = [" Byte", " KB", " MB", " GB", " TB"];
	if(size == 0){
		return 'n/a';
	}else{
		var i = 0;
		while(size > 1024){
			size = Math.round(size / 1024);
			i++;
		}

		return formatCurrency(size)+units[i];
	}
}