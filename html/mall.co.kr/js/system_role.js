$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
				if($.trim($("input[name=role_id]").val()) == ''){
					alert("권한ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=role_nm]").val()) == ''){
					alert("권한명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=role_ordr]").val()) == ''){
					alert("정렬순서를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=role_desc]").val()) == ''){
					alert("설명를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("권한 등록 하시겠습니까?")){
					let formData = new Object();
					formData['role_id'] = $("input[name=role_id]").val();
					formData['role_nm'] = $("input[name=role_nm]").val();
					formData['role_ordr'] = $("input[name=role_ordr]").val();
					formData['role_desc'] = $("input[name=role_desc]").val();
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/role/roleRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/role/role_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("권한을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['role_id'] = $("input[name=role_id]").val();

					$.post("/system/role/roleDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/role/role_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnModify' :
				if($.trim($("input[name=role_nm]").val()) == ''){
					alert("권한명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=role_ordr]").val()) == ''){
					alert("정렬순서를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=role_desc]").val()) == ''){
					alert("설명를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("권한을 수정 하시겠습니까?")){
					let formData = new Object();
					formData['role_id'] = $("input[name=role_id]").val();
					formData['role_nm'] = $("input[name=role_nm]").val();
					formData['role_ordr'] = $("input[name=role_ordr]").val();
					formData['role_desc'] = $("input[name=role_desc]").val();
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/role/roleModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/role/role_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/system/role/role_inf.php";
				break;
		}
	});


});

