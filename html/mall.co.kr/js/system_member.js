$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
				if($.trim($("input[name=hospitalNo]").val()) == ''){
					alert("요양기관번호을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=hospitalname]").val()) == ''){
					alert("요양기관명을 입력해 주세요.");
					return false;
				}
        var apikey = document.getElementById("apikey").value;
				if($.trim($("input[name=zipcode]").val()) == ''){
					alert("우편번호를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=addr]").val()) == ''){
					alert("주소를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=tel]").val()) == ''){
					alert("전화번호를 입력해 주세요.");
					return false;
				}
        var broker_ty_cd = document.getElementById("broker_ty_cd").value;
				if(broker_ty_cd == ''){
					alert("중개기관코드를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("요양기관 등록 하시겠습니까?")){
					let formData = new Object();
					formData['hospitalNo'] = $("input[name=hospitalNo]").val();
					formData['hospitalname'] = $("input[name=hospitalname]").val();
					formData['apikey'] = apikey;
					formData['zipcode'] = $("input[name=zipcode]").val();
					formData['addr'] = $("input[name=addr]").val();
					formData['tel'] = $("input[name=tel]").val();
					formData['broker_ty_cd'] = broker_ty_cd;
					formData['use_yn'] = use_yn;
					formData['img1_id'] = $("#img1_id").val();

					$.post("/system/member/memberRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/member/member_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("요양기관을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['hospitalNo'] = $("input[name=hospitalNo]").val();
					formData['img1_id'] = $("#img1_id").val();

					$.post("/system/member/memberDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/member/member_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnModify' :
				if($.trim($("input[name=hospitalname]").val()) == ''){
					alert("요양기관명을 입력해 주세요.");
					return false;
				}
        var apikey = document.getElementById("apikey").value;
				if($.trim($("input[name=zipcode]").val()) == ''){
					alert("우편번호를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=addr]").val()) == ''){
					alert("주소를 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=tel]").val()) == ''){
					alert("전화번호를 입력해 주세요.");
					return false;
				}
        var broker_ty_cd = document.getElementById("broker_ty_cd").value;
				if(broker_ty_cd == ''){
					alert("중개기관코드를 입력해 주세요.");
					return false;
				}
        var use_yn = document.getElementById("use_yn").value;
				if(use_yn == ''){
					alert("사용여부를 입력해 주세요.");
					return false;
				}
				if(confirm("요양기관을 수정 하시겠습니까?")){
					let formData = new Object();
					formData['hospitalNo'] = $("input[name=hospitalNo]").val();
					formData['hospitalname'] = $("input[name=hospitalname]").val();
					formData['apikey'] = apikey;
					formData['zipcode'] = $("input[name=zipcode]").val();
					formData['addr'] = $("input[name=addr]").val();
					formData['tel'] = $("input[name=tel]").val();
					formData['broker_ty_cd'] = broker_ty_cd;
					formData['use_yn'] = use_yn;
					formData['img1_id'] = $("#img1_id").val();

					$.post("/system/member/memberModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/system/member/member_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/system/member/member_inf.php";
				break;
			case 'btnImage1_up' :
        fn_submitUp(1);
				break;
			case 'btnImage1_del' :
        fn_submitDel(1);
				break;
		}
	});


});

