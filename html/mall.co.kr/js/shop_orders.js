$(function(){
  $("a.btn").on("click", function(event){
    event.preventDefault ? event.preventDefault() : event.returnValue = false;
    switch(this.name){
      case 'btnOrderModify' :
        var orders_stat_cd = document.getElementById("orders_stat_cd").value;
        if(orders_stat_cd == ''){
          alert("주문상태코드를 입력해 주세요.");
          return false;
        }
        if(confirm("주문상태를 수정 하시겠습니까?")){
          let formData = new Object();
          formData['user_id'] = $("input[name=user_id]").val();
          formData['orders_id'] = $("input[name=orders_id]").val();
          formData['orders_stat_cd'] = orders_stat_cd;

          $.post("/shop/order/ordersModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
                document.location.href="/shop/order/orders_inf.php";
              }else{
                alert(resData.msg);
                return false;
              }
          }).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
        }
        break;
			//주문삭제 (준비중인 주문만 가능)
			case 'btnOrderDelete' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}
				var chk = $.trim($("input[name=orders_stat_cd]").val());
				if(chk != "주문중"){
					alert("주문중인 주문만 삭제 할 수 있습니다."+chk);
					return false;
				}

				if(confirm("주문을 삭제 하시겠습니까?")){
					let formData = new Object();
					formData['orders_id'] = $("input[name=orders_id]").val();

					$.post("/shop/order/ordersDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
									alert("주문이 정상적으로 삭제되었습니다.");
									document.location.href="/shop/order/orders_inf.php";
              }else{
                  alert(resData.msg);
                  return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
        break;
			//주문내역
			case 'btnOrderList' :
        document.location.href="/shop/order/orders_inf.php";
				break;

    }
  });


});

