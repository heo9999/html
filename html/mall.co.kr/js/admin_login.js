$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnForgotPassword' :
				if($.trim($("input[name=UserId]").val()) == ''){
					alert("사용자ID을 입력해 주세요.");
					return false;
				}
        var hospital = document.getElementById("hospitalNo").value;
				if(hospital == ''){
					alert("요양병원번호을 입력해 주세요.");
					return false;
				}
				if(confirm("비밀번호를 초기화 하시겠습니까?")){
					let formData = new Object();
					formData['UserId'] = $("input[name=UserId]").val();
					$.post("/auth/loginForgotPassword.php", $.param(formData), function(objData){
						console.log(objData);
            const resData = JSON.parse(objData);
            if(resData.result == true){
							document.location.href="/index.php";
            }else{
							alert(resData.msg);
							return false;
            }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnRegister' :
				if($.trim($("input[name=UserId]").val()) == ''){
					alert("사용자ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=UserName]").val()) == ''){
					alert("사용자명을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=Email]").val()) == ''){
					alert("이메일을 입력해 주세요.");
					return false;
				}
        var hospital = document.getElementById("hospitalNo").value;
				if(hospital == ''){
					alert("요양병원번호을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=InputPassword]").val()) == ''){
					alert("비밀번호을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=InputPassword]").val()) != $.trim($("input[name=RepeatPassword]").val())){
					alert("비밀번호확인이 틀립니다.");
					return false;
				}
				if(confirm("사용자를 등록 하시겠습니까?")){
					let formData = new Object();
					formData['UserId'] = $("input[name=UserId]").val();
					formData['UserName'] = $("input[name=UserName]").val();
					formData['Email'] = $("input[name=Email]").val();
					formData['hospitalNo'] = hospital;
					formData['InputPassword'] = $("input[name=InputPassword]").val();

					$.post("/auth/loginRegister.php", $.param(formData), function(objData){
						console.log(objData);
            const resData = JSON.parse(objData);
            if(resData.result == true){
							document.location.href="/index.php";
            }else{
							alert(resData.msg);
							return false;
            }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
		}
	});


});
