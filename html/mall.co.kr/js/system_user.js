$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
				if($.trim($("input[name=user_id]").val()) == ''){
					alert("사용자ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pwd]").val()) == ''){
					alert("비밀번호을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=user_nm]").val()) == ''){
					alert("사용자명를 입력해 주세요.");
					return false;
				}
        var hospitalNo = document.getElementById("hospitalNo").value;
				if(hospitalNo == ''){
					alert("요양병원NO를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=job_nm]").val()) == ''){
					alert("직위명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=tel]").val()) == ''){
					alert("전화번호를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=email]").val()) == ''){
					alert("이메일를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("사용자를 등록 하시겠습니까?")){
					let formData = new Object();
					formData['user_id'] = $("input[name=user_id]").val();
					formData['pwd'] = $("input[name=pwd]").val();
					formData['user_nm'] = $("input[name=user_nm]").val();
					formData['hospitalNo'] = hospitalNo;
					formData['job_nm'] = $("input[name=job_nm]").val();
					formData['tel'] = $("input[name=tel]").val();
					formData['email'] = $("input[name=email]").val();
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/user/userRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/user/user_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("사용자을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['user_id'] = $("input[name=user_id]").val();

					$.post("/system/user/userDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/user/user_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnModify' :
				if($.trim($("input[name=user_id]").val()) == ''){
					alert("사용자ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pwd]").val()) == ''){
					alert("비밀번호을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=user_nm]").val()) == ''){
					alert("사용자명를 입력해 주세요.");
					return false;
				}
        var hospitalNo = document.getElementById("hospitalNo").value;
				if(hospitalNo == ''){
					alert("요양병원NO를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=job_nm]").val()) == ''){
					alert("직위명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=tel]").val()) == ''){
					alert("전화번호를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=email]").val()) == ''){
					alert("이메일를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("사용자를 수정 하시겠습니까?")){
					let formData = new Object();
					formData['user_id'] = $("input[name=user_id]").val();
					formData['pwd'] = $("input[name=pwd]").val();
					formData['user_nm'] = $("input[name=user_nm]").val();
					formData['hospitalNo'] = hospitalNo;
					formData['job_nm'] = $("input[name=job_nm]").val();
					formData['tel'] = $("input[name=tel]").val();
					formData['email'] = $("input[name=email]").val();
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/user/userModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/user/user_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/system/user/user_inf.php";
				break;
		}
	});


});

function pwdReset(key)
{
    var table = $('#dataTable').DataTable();
    if (table.row('.selected').selected()) {
        console.log('Row is selected');
        var rVal = table.row('.selected').data();
        var ids = $.map(table.rows('.selected').data(), function (item) {
            return item[key];
        });
        console.log('aaa :'+rVal);
				console.log('ids :'+ids);
				if(confirm("비밀번호를 초기화 하시겠습니까?")){
					let formData = new Object();
					formData['UserId'] = ids.toString();

					$.post("/auth/loginForgotPassword.php", $.param(formData), function(objData){
						console.log(objData);
						const resData = JSON.parse(objData);
						if(resData.result == true){
							document.location.href="/system/user/user_inf.php";
						}else{
							alert(resData.msg);
							return false;
						}
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
    }
    else {
        console.log('Row is not selected');
        alert("데이터를 선택해야 합니다.");
    }

}