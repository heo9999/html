$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
        var user_id = document.getElementById("user_id").value;
				if(user_id == ''){
					alert("사용자ID를 입력해 주세요.");
					return false;
				}
        var role_id = document.getElementById("role_id").value;
				if(role_id == ''){
					alert("권한ID를 입력해 주세요.");
					return false;
				}
				if(confirm("사용자별권한 등록 하시겠습니까?")){
					let formData = new Object();
					formData['user_id'] = user_id;
					formData['role_id'] = role_id;

					$.post("/system/role_user/roleUserRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/role_user/role_user.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("사용자별권한을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['user_id'] = $("input[name=user_id]").val();
					formData['role_id'] = $("input[name=role_id]").val();

					$.post("/system/role_user/roleUserDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/role_user/role_user.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/system/role_user/role_user.php";
				break;
		}
	});


});

