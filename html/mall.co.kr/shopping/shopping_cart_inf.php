<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/shopping/shopping_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/cart_inf_dao.php");

    // 입력 데이터 수신
    $user_id = $mallUserId;

    $db = new database();

    $params = [
        'user_id' => $user_id
    ];
    $cart_inf = getListCartInfWithDetail($params);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                        <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">장바구니</h1>
                        </div>
                        <table class="table table-striped" id="cartTable">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">이미지</th>
                              <th scope="col">상품명</th>
                              <th scope="col">수량</th>
                              <th scope="col">수량변경</th>
                              <th scope="col">금액</th>
                              <th scope="col">삭제</th>
                              <th scope="col" style="display: none;">상품ID</th>
                              <th scope="col" style="display: none;">상품가격</th>
                              <th scope="col" style="display: none;">장바구니ID</th>
                              <th scope="col" style="display: none;">상품재고수</th>
                            </tr>
                          </thead>
                          <tbody>
<?

	if(!$cart_inf){
        $sumAmt = 0;
?>
<?
	}else{
		foreach($cart_inf as $list){
            $sumAmt = $list['sum_cart_price'];
?>

                                        <tr>
                                            <td><?=$list['row_num']?></td>
                                            <td><img src=<?=$list['img1_path']?> width=50 height=50></td>
                                            <td><?=$list['product_nm']?></td>
                                            <td><?=$list['cart_cnt']?></td>
                                            <td><a class="btn btn-outline-success" onclick="subCart('<?=$list['row_num']?>');">-</a><a class="btn btn-outline-success" name="btnAdd" onclick="addCart('<?=$list['row_num']?>');">+</a><a class="btn btn-outline-primary" onclick="saveCart('<?=$list['row_num']?>');">수정</a></td>
                                            <td><?=number_format($list['cart_price'])?></td>
                                            <td><a class="btn btn-outline-danger" name="btnDel" onclick="delCart('<?=$list['row_num']?>');">삭제</a></td>
                                            <td style="display: none;"><?=$list['product_id']?></td>
                                            <td style="display: none;"><?=$list['product_price']?></td>
                                            <td style="display: none;"><?=$list['cart_id']?></td>
                                            <td style="display: none;"><?=$list['product_cnt']?></td>
                                        </tr>
<?
		}
	}
?>
                          </tbody>
                        </table>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-danger">
                                <div class="card-body text-right">
                                    <a>총 구매금액 : </a>
                                    <input id="totAmt" readonly class="btn btn-outline-dark text-right py-1" value="<?=number_format($sumAmt)?>">
                                    <a> 원</a>
                                </div>
                        </div>
                        </div>
                        <div class="col">
                            <div class="card mb-4 py-1 border-bottom-info">
                                <div class="card-body text-center">
                                        <div class="form-group row">
                                        <div class="col mr-2">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-outline-dark" name="btnCartOrder">주문하기</a>
                                            <a class="btn btn-outline-dark" name="btnProdList">계속쇼핑하기</a>
                                            <a class="btn btn-outline-dark" name="btnCartEmpty">장바구니 비우기</a>
                                        </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Content Row -->


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>