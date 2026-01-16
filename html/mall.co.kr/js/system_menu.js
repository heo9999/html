$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
				if($.trim($("input[name=pgm_id]").val()) == ''){
					alert("프로그램ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=upper_pgm_id]").val()) == ''){
					alert("상위프로그램ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pgm_ordr]").val()) == ''){
					alert("프로그램순서를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pgm_nm]").val()) == ''){
					alert("프로그램명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pgm_url]").val()) == ''){
					alert("프로그램URL를 입력해 주세요.");
					return false;
				}
				var pgm_ty_cd = document.getElementById("pgm_ty_cd").value;
				if(pgm_ty_cd == ''){
					alert("프로그램형태를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("프로그램 등록 하시겠습니까?")){
					let formData = new Object();
					formData['pgm_id'] = $("input[name=pgm_id]").val();
					formData['upper_pgm_id'] = $("input[name=upper_pgm_id]").val();
					formData['pgm_ordr'] = $("input[name=pgm_ordr]").val();
					formData['pgm_nm'] = $("input[name=pgm_nm]").val();
					formData['pgm_url'] = $("input[name=pgm_url]").val();
					formData['pgm_ty_cd'] = pgm_ty_cd;
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/menu/menuRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/menu/menu_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("프로그램을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['pgm_id'] = $("input[name=pgm_id]").val();

					$.post("/system/menu/menuDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/menu/menu_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnModify' :
				if($.trim($("input[name=upper_pgm_id]").val()) == ''){
					alert("상위프로그램ID을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pgm_ordr]").val()) == ''){
					alert("프로그램순서를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pgm_nm]").val()) == ''){
					alert("프로그램명를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=pgm_url]").val()) == ''){
					alert("프로그램URL를 입력해 주세요.");
					return false;
				}
				var pgm_ty_cd = document.getElementById("pgm_ty_cd").value;
				if(pgm_ty_cd == ''){
					alert("프로그램형태를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("프로그램을 수정 하시겠습니까?")){
					let formData = new Object();
					formData['pgm_id'] = $("input[name=pgm_id]").val();
					formData['upper_pgm_id'] = $("input[name=upper_pgm_id]").val();
					formData['pgm_ordr'] = $("input[name=pgm_ordr]").val();
					formData['pgm_nm'] = $("input[name=pgm_nm]").val();
					formData['pgm_url'] = $("input[name=pgm_url]").val();
					formData['pgm_ty_cd'] = pgm_ty_cd;
					formData['etc_meta_1'] = $("input[name=etc_meta_1]").val();
					formData['etc_meta_2'] = $("input[name=etc_meta_2]").val();
					formData['use_yn'] = use_yn;

					$.post("/system/menu/menuModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/menu/menu_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/system/menu/menu_inf.php";
				break;
		}
	});


});

