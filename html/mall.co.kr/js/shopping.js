//카트내용 수정
const cellCount = 3;
const cellPrice = 5;
const cellProductId = 7;
const cellProductPrice = 8;
const cellCartId = 9;
const cellProductCnt = 10; //재고수량

$(function(){
	$("a.btn").on("click", function(event){
		event.preventDefault ? event.preventDefault() : event.returnValue = false;
		switch(this.name){
			//주문하기
			case 'btnCartOrder' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}
        var firstRow = $("#cartTable tbody tr:first");
        if (firstRow.length) {
            if(confirm("주문 하시겠습니까?")){
								var table = document.getElementById('cartTable');
								var rowList = table.rows;

								let formData = new FormData();
								for (i=1; i<rowList.length; i++) {
										var row = rowList[i];     //thead 부분을 제외하기 위해 i가 1부터 시작됩니다.
										var cart_Cnt = row.cells[cellCount].innerHTML; //count
										var cart_Amt = row.cells[cellPrice].innerHTML; //price
										var product_price = row.cells[cellProductPrice].innerHTML; //product_price
										var product_id = row.cells[cellProductId].innerHTML; //product_id
										var cart_id = row.cells[cellCartId].innerHTML; //cart_id
										var product_cnt = row.cells[cellProductCnt].innerHTML; //product_price

										formData.append('cart_id[]', cart_id);
										formData.append('product_id[]', product_id);
										rStr1 = product_price.replace(/,/g, ""); // 모든 콤마 제거
										formData.append('product_price[]', rStr1);
										rStr = cart_Amt.replace(/,/g, ""); // 모든 콤마 제거
										formData.append('cart_price[]', rStr);
										formData.append('cart_cnt[]', cart_Cnt);
										formData.append('product_cnt[]', product_cnt);
										rStr2 = $('#totAmt').val().replace(/,/g, ""); // 모든 콤마 제거
										formData.append('totAmt[]', rStr2);
								}
								const jsonObject = formDataToJson(formData);

                $.post("/shopping/shoppingOrderRegister.php", $.param(jsonObject), function(objData){
                    console.log(objData);
                    const resData = JSON.parse(objData);
                    if(resData.result == true){
												var tmp = resData.rval;
												var params = "orders_stat_cd=O0001&orders_id="+tmp;
												console.log(params);
                        document.location.href="/shopping/shopping_order_inf.php?"+params;
                        return true;
                    }else{
                        alert(resData.msg);
                        return false;
                    }
                }).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
            }
        } else {
					alert("장바구니 내용이 없습니다.");
					return false;
        }
				break;
			//장바구니 비우기
			case 'btnCartEmpty' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}
        var fRow = $("#cartTable tbody tr:first");
        if (fRow.length) {
            if(confirm("장바구니를 비우시겠습니까?")){
                let formData = new Object();

                $.post("/shopping/shoppingCartEmpty.php", $.param(formData), function(objData){
                    console.log(objData);
                    const resData = JSON.parse(objData);
                    if(resData.result == true){
                        document.location.href="/shopping/shopping_cart_inf.php";
                        return true;
                    }else{
                        alert(resData.msg);
                        return false;
                    }
                }).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
            }
        } else {
					alert("장바구니 내용이 없습니다.");
					return false;
        }
				break;
			//구매하기
			case 'btnCartBuy' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}
				if($.trim($("input[name=totalCnt]").val()) == ''){
					alert("수량을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=totalAmt]").val()) == ''){
					alert("금액을 입력해 주세요.");
					return false;
				}
				if(confirm("구매 하시겠습니까?")){
					let formData = new Object();
					formData['product_id'] = $("input[name=product_id]").val();
					formData['product_price'] = $("input[name=product_price]").val();
					formData['product_cnt'] = $("input[name=product_cnt]").val();
					formData['cart_cnt'] = $("input[name=totalCnt]").val();
					var rStr = $("input[name=totalAmt]").val();
          formData['cart_price'] = rStr.replace(/,/g, ""); // 모든 콤마 제거

					$.post("/shopping/shoppingCartRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
								document.location.href="/shopping/shopping_cart_inf.php";
              }else{
                alert(resData.msg);
                return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			//장바구니 담기
			case 'btnCartPush' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}

				if($.trim($("input[name=totalCnt]").val()) == ''){
					alert("수량을 입력해 주세요.");
					return false;
				}
				if($.trim($("input[name=totalAmt]").val()) == ''){
					alert("금액을 입력해 주세요.");
					return false;
				}
				let formData = new Object();
				formData['product_id'] = $("input[name=product_id]").val();
				formData['product_price'] = $("input[name=product_price]").val();
				formData['product_cnt'] = $("input[name=product_cnt]").val();
				formData['cart_cnt'] = $("input[name=totalCnt]").val();
				var rStr = $("input[name=totalAmt]").val();
        formData['cart_price'] = rStr.replace(/,/g, ""); // 모든 콤마 제거

				$.post("/shopping/shoppingCartRegister.php", $.param(formData), function(objData){
					console.log(objData);
          const resData = JSON.parse(objData);
          if(resData.result == true){
              $.confirm({
                  title: '장바구니',
                  content: '선택하신 상품을 장바구니에 담았습니다.',
                  buttons: {
                      shopping: {
                          text: '계속쇼핑하기',
                          action: function(){
                              document.location.href="/shopping/shopping_product_inf.php";
                          }
                      },
                      cart: {
                          text: '장바구니',
                          action: function(){
                              document.location.href="/shopping/shopping_cart_inf.php";
                          }
                      }
                  }
              });
          }else{
              alert(resData.msg);
              return false;
          }
				}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				break;
			//구매확정
			case 'btnOrderConfirm' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}

				var cb = $('input:checkbox[id="agree"]').is(":checked");

				console.log('aaaa: '+cb);
				if(!cb){
					alert("결제정보에 동의를 해 주세요.");
					return false;
				}
				if(confirm("주문 하시겠습니까?")){
					let formData = new Object();
					formData['orders_id'] = $("input[name=orders_id]").val();

					$.post("/shopping/shoppingOrderConfirm.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
									alert("상품이 정상적으로 주문되었습니다.");
									document.location.href="/shopping/shopping_product_inf.php";
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

					$.post("/shopping/shoppingOrderDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
									alert("주문이 정상적으로 삭제되었습니다.");
									document.location.href="/shopping/shopping_order_list.php";
              }else{
                  alert(resData.msg);
                  return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			//주문취소 (장바구니 담긴 주문을 취소 하면삭제됨)
			case 'btnOrderCancel' :
				if (!checkRole('ROLE_USER'))
				{
					alert("로그인이 필요합니다.");
					document.location.href="/login.php";
					return false;
				}
				var chk = $.trim($("input[name=orders_stat_cd]").val());
				if(chk != "주문중"){
					alert("주문중인 주문만 취소 할 수 있습니다."+chk);
					return false;
				}

				if(confirm("주문을 취소 하시겠습니까?")){
					let formData = new Object();
					formData['orders_id'] = $("input[name=orders_id]").val();

					$.post("/shopping/shoppingOrderDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
									alert("주문이 정상적으로 취소되었습니다.");
									document.location.href="/shopping/shopping_cart_inf.php";
              }else{
                  alert(resData.msg);
                  return false;
              }
					}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
				}
				break;
			//주문내역
			case 'btnOrderList' :
				document.location.href="/shopping/shopping_order_list.php";
				break;
			//상품목록
			case 'btnProdList' :
        document.location.href="/shopping/shopping_product_inf.php";
				break;
			//장바구니목록
			case 'btnCartList' :
        document.location.href="/shopping/shopping_cart_inf.php";
				break;

		}
	});

});

//장바구니 수량추가
function addCart(key)
{
    var table = document.getElementById('cartTable');
    var rowList = table.rows;
    var row = rowList[key];

    var tCnt = row.cells[cellCount].innerHTML; //count
    var tAmt = row.cells[cellPrice].innerHTML; //price
    var price = row.cells[cellProductPrice].innerHTML; //product_price

    var nCnt = parseInt(tCnt) + 1;
    var nAmt = formatCurrency(nCnt * parseInt(price));

    row.cells[cellCount].innerText = nCnt; //count
    row.cells[cellPrice].innerText = nAmt; //price

    totalAmt();
}

//장바구니 수량감소
function subCart(key)
{
    var table = document.getElementById('cartTable');
    var rowList = table.rows;
    var row = rowList[key];

    var tCnt = row.cells[cellCount].innerHTML; //count
    var tAmt = row.cells[cellPrice].innerHTML; //price
    var price = row.cells[cellProductPrice].innerHTML; //product_price

    var nCnt = parseInt(tCnt) - 1;
    if (nCnt < 0)
    {
        return;
    }
    var nAmt = formatCurrency(nCnt * parseInt(price));

    row.cells[cellCount].innerText = nCnt; //count
    row.cells[cellPrice].innerText = nAmt; //price

    totalAmt();

}

//총금액
function totalAmt()
{
    var table = document.getElementById('cartTable');
    var rowList = table.rows;

    var tAmt = 0;
    for (i=1; i<rowList.length; i++) {
        var row = rowList[i];
        rStr = row.cells[cellPrice].innerHTML; //price
        amt = rStr.replace(/,/g, ""); // 모든 콤마 제거
        tAmt += parseInt(amt);
    }

    var nAmt = formatCurrency(tAmt);
    $('#totAmt').val(nAmt);

}

//장바구니 변경저장
function saveCart(key)
{
    var table = document.getElementById('cartTable');
    var rowList = table.rows;
    var row = rowList[key];

    var cart_Cnt = row.cells[cellCount].innerHTML; //count
    var cart_Amt = row.cells[cellPrice].innerHTML; //price
    var product_price = row.cells[cellProductPrice].innerHTML; //product_price
    var product_id = row.cells[cellProductId].innerHTML; //product_id
    var cart_id = row.cells[cellCartId].innerHTML; //cart_id

    let formData = new Object();
		formData['cart_id'] = cart_id;
		formData['product_id'] = product_id;
    rStr = cart_Amt.replace(/,/g, ""); // 모든 콤마 제거
		formData['cart_price'] = rStr;
		formData['cart_cnt'] = cart_Cnt;

		$.post("/shopping/shoppingCartModify.php", $.param(formData), function(objData){
					console.log(objData);
					const resData = JSON.parse(objData);
					if(resData.result == true){
							alert(resData.msg);
							document.location.href="/shopping/shopping_cart_inf.php";
							return true;
					}else{
							alert(resData.msg);
							return false;
					}
		}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });

}

//장바구니 삭제
function delCart(key)
{
    var table = document.getElementById('cartTable');
    var rowList = table.rows;
    var row = rowList[key];

    var cart_Cnt = row.cells[cellCount].innerHTML; //count
    var cart_Amt = row.cells[cellPrice].innerHTML; //price
    var product_price = row.cells[cellProductPrice].innerHTML; //product_price
    var product_id = row.cells[cellProductId].innerHTML; //product_id
    var cart_id = row.cells[cellCartId].innerHTML; //cart_id

    let formData = new Object();
		formData['cart_id'] = cart_id;
		formData['product_id'] = product_id;
    rStr = cart_Amt.replace(/,/g, ""); // 모든 콤마 제거
		formData['cart_price'] = rStr;
		formData['cart_cnt'] = cart_Cnt;

		$.post("/shopping/shoppingCartDelete.php", $.param(formData), function(objData){
					console.log(objData);
					const resData = JSON.parse(objData);
					if(resData.result == true){
							alert(resData.msg);
							document.location.href="/shopping/shopping_cart_inf.php";
							return true;
					}else{
							alert(resData.msg);
							return false;
					}
		}).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });

}

//상품구매수량증가
function addAmt()
{
    var tCnt = $("input[name=totalCnt]").val();
    var tAmt = $("input[name=totalAmt]").val();
    var product_price = $("input[name=product_price]").val();

    var nCnt = parseInt(tCnt) + 1;
    var nAmt = formatCurrency(nCnt * parseInt(product_price));

    $("input[name=totalCnt]").val(nCnt);
    $("input[name=totalAmt]").val(nAmt);
}

//상품구매수량감소
function subAmt()
{
    var tCnt = $("input[name=totalCnt]").val();
    var tAmt = $("input[name=totalAmt]").val();
    var product_price = $("input[name=product_price]").val();

    var nCnt = parseInt(tCnt) - 1;
    if (nCnt < 0)
    {
        return;
    }
    var nAmt = formatCurrency(nCnt * parseInt(product_price));

    $("input[name=totalCnt]").val(nCnt);
    $("input[name=totalAmt]").val(nAmt);
}


