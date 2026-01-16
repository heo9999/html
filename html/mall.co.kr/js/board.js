$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			case 'btnRegister' :
				if($.trim($("input[name=title]").val()) == ''){
					alert("게시판제목을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=board_ctnt]").val()) == ''){
					alert("게시판내용를 입력해 주세요.");
					return false;
				}
				if(confirm("게시판 등록 하시겠습니까?")){
					let formData = new Object();
					formData['title'] = $("input[name=title]").val();
					formData['board_ctnt'] = $("input[name=board_ctnt]").val();

					$.post("/board/boardRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/board/board_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnDelete' :
				if(confirm("게시판을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['board_id'] = $("input[name=board_id]").val();

					$.post("/board/boardDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/board/board_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnModify' :
				if($.trim($("input[name=title]").val()) == ''){
					alert("게시판제목을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=board_ctnt]").val()) == ''){
					alert("게시판내용를 입력해 주세요.");
					return false;
				}
				if(confirm("게시판을 수정 하시겠습니까?")){
					let formData = new Object();
					formData['board_id'] = $("input[name=board_id]").val();
					formData['title'] = $("input[name=title]").val();
					formData['board_ctnt'] = $("input[name=board_ctnt]").val();

					$.post("/board/boardModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/board/board_inf.php";
              }else{
								alert(resData.msg);
								return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			case 'btnPrev' :
        document.location.href="/board/board_inf.php";
				break;
		}
	});


});

