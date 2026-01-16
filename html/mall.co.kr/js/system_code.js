$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
				if($.trim($("input[name=code_id]").val()) == ''){
					alert("코드ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_list]").val()) == ''){
					alert("코드값을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_kind]").val()) == ''){
					alert("코드종류를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_nm]").val()) == ''){
					alert("코드명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=sort_ordr]").val()) == ''){
					alert("정렬순서를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_desc]").val()) == ''){
					alert("설명를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("코드 등록 하시겠습니까?")){
					let formData = new Object();
					formData['code_id'] = $("input[name=code_id]").val();
					formData['code_list'] = $("input[name=code_list]").val();
					formData['code_kind'] = $("input[name=code_kind]").val();
					formData['code_nm'] = $("input[name=code_nm]").val();
					formData['sort_ordr'] = $("input[name=sort_ordr]").val();
					formData['code_desc'] = $("input[name=code_desc]").val();
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/code/codeRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/code/code_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("코드을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['code_id'] = $("input[name=code_id]").val();

					$.post("/system/code/codeDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/code/code_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnModify' :
				if($.trim($("input[name=code_list]").val()) == ''){
					alert("코드값을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_kind]").val()) == ''){
					alert("코드종류를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_nm]").val()) == ''){
					alert("코드명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=sort_ordr]").val()) == ''){
					alert("정렬순서를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=code_desc]").val()) == ''){
					alert("설명를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("코드을 수정 하시겠습니까?")){
					let formData = new Object();
					formData['code_id'] = $("input[name=code_id]").val();
					formData['code_list'] = $("input[name=code_list]").val();
					formData['code_kind'] = $("input[name=code_kind]").val();
					formData['code_nm'] = $("input[name=code_nm]").val();
					formData['sort_ordr'] = $("input[name=sort_ordr]").val();
					formData['code_desc'] = $("input[name=code_desc]").val();
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/code/codeModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/code/code_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/system/code/code_inf.php";
				break;
		}
	});


});

