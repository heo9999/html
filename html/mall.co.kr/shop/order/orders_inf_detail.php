<?php
    $GLOBAL['appPath'] = "S";
	include_once("{$_SERVER['DOCUMENT_ROOT']}/shop/order/orders_header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_inf_dao.php");

    // 입력 데이터 수신
    // 관리자모드라 사용자를 입력 받아야 함
    $user_id = (isset($_GET['user_id']) === true ? $_GET['user_id'] : '');
    $orders_id = (isset($_GET['orders_id']) === true ? $_GET['orders_id'] : '');
    $orders_stat_cd = (isset($_GET['orders_stat_cd']) === true ? $_GET['orders_stat_cd'] : '');

    $db = new database();

    //주문상태코드
    $params=[
        'where' => "code_kind = 'orders_stat_cd' "
    ];
    $codeList = getListCodeInf($params);

    //주문내역
    $params1 = [
        'user_id' => $user_id,
        'orders_id' => $orders_id,
        'orders_stat_cd' => $orders_stat_cd
    ];
    $user_order_inf = getListShoppingOrdersInfWithDetail($params1);

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                        <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">주문/결제</h1>
                        </div>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-danger">
                                <div class="card-body text-left">
                                <h5 class="card-title">주문목록</h5>
                        <table class="table table-striped" id="cartTable">
                          <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">이미지</th>
                              <th scope="col">상품명</th>
                              <th scope="col">수량</th>
                              <th scope="col">금액</th>
                              <th scope="col" style="display: none;">주문ID</th>
                            </tr>
                          </thead>
                          <tbody>
<?

	if(!$user_order_inf){
        $sumAmt = 0;
        $user_nm = '';
        $email = 'aaa@google.com';
        $tel = '010-1234-1234';
        $orders_id = '';
        $orders_stat_cd = '';
        $delivery_zipcode = '';
        $delivery_addr = '';
        $pay_bank_cd = '';
        $pay_acct_no = '';
?>
<?
	}else{
		foreach($user_order_inf as $list){
            $sumAmt = $list['orders_total_amt'];
            $user_nm = $list['user_nm'];
            $email = $list['email'];
            $tel = $list['tel'];
            $user_id = $list['user_id'];
            $orders_id = $list['orders_id'];
            $orders_stat_cd = $list['orders_stat_cd'];
            $delivery_zipcode = $list['delivery_zipcode'];
            $delivery_addr = $list['delivery_addr'];
            $pay_bank_cd = $list['pay_bank_cd'];
            $pay_acct_no = $list['pay_acct_no'];
?>

                                        <tr>
                                            <td><?=$list['row_num']?></td>
                                            <td><img src=<?=$list['img1_path']?> width=50 height=50></td>
                                            <td><?=$list['product_nm']?></td>
                                            <td><?=$list['products_cnt']?></td>
                                            <td><?=number_format($list['products_price'])?></td>
                                            <td style="display: none;"><?=$list['orders_id']?></td>
                                        </tr>
<?
		}
	}
?>
                          </tbody>
                        </table>
                        </div>
                            </div>
                                </div>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-warning">
                                <div class="card-body text-left">
                                    <h5 class="card-title">주문자정보</h5>
<?
	if(!$user_order_inf){
?>
        <div class="alert alert-secondary">
            <a class="card-text">해당내용이 없음</a>
        </div>
<?
	} else {
?>
        <div class="alert alert-secondary">
            <a class="card-text"><?=$user_nm?> </a><br>
        </div>
        <div class="alert alert-primary">
            <input class="card-text" value="<?=$email?>">
        </div>
        <div class="alert alert-primary">
            <input class="card-text" value="<?=$tel?>">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="orders_id" value="<?=$orders_id?>">
            <input type="hidden" name="orders_stat_cd" value="<?=$orders_stat_cd?>">
        </div>
<?
    }
?>
                                </div>
                        </div>
                        </div>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-warning">
                                <div class="card-body text-left">
                                    <h5 class="card-title">배송정보</h5>
<?
	if(!$user_order_inf){
?>
        <div class="alert alert-secondary">
            <a class="card-text">해당내용이 없음</a>
        </div>
<?
	} else {
?>
        <div class="alert alert-primary">
            <a class="card-text"><?=$delivery_zipcode?> </a><br>
        </div>
        <div class="alert alert-primary">
            <a class="card-text"><?=$delivery_addr?> </a>
        </div>
<?
    }
?>
                                </div>
                        </div>
                        </div>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-warning">
                                <div class="card-body text-left">
                                    <h5 class="card-title">주문상품적용내역</h5>
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th scope="col">상품금액</th>
                                          <th scope="col">배송비</th>
                                          <th scope="col">할인금액</th>
                                          <th scope="col">추가금액</th>
                                          <th scope="col">결제예정금액</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                            <td><?=number_format($sumAmt)?> 원</td>
                                            <td>(+)2,500 원</td>
                                            <td>(-)0 원</td>
                                            <td>(+)0 원</td>
                                            <td>(=)<?=number_format($sumAmt)?> 원</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>
                        </div>
                        </div>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-warning">
                                <div class="card-body text-left">
                                    <h5 class="card-title">결제정보</h5>
                                    <div class="alert alert-secondary">
                                        <a class="card-text"><?=$pay_bank_cd?> <?=$pay_acct_no?></a>
                                    </div>
                                    <div class="alert alert-secondary">
                                        <a class="card-text">예금주 이투웹</a>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="col">
                        <div class="card mb-4 py-1 border-bottom-danger">
                                <div class="card-body text-left">
                                    <h5 class="card-title">결제금액</h5>
                                    <div class="alert alert-danger">
                                    최종결제금액
                                    <a><?=number_format($sumAmt)?></a>
                                    <a> 원</a>
                                    </div>
                                </div>
                        </div>
                        <div class="card mb-4 py-1 border-bottom-warning">
                                <div class="card-body text-left">
                                    <div class="alert alert-warning">
                                    주문상태
                                    </div>
                                        <select class="custom-select" id="orders_stat_cd" name="orders_stat_cd"
                                            placeholder="주문상태">
                                            <label>주문상태</label>
                                        <?php foreach ($codeList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['code_id']) ?>"? placeholder="주문상태"
                                            <?php if( $value['code_nm'] == $orders_stat_cd ): ?> selected="selected"<?php endif; ?>
                                            >
                                            <?= htmlspecialchars($value['code_nm']) ?>:<?= htmlspecialchars($value['code_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                </div>
                        </div>
                        </div>
                        <div class="col">
                            <div class="card mb-4 py-1 border-bottom-info">
                                <div class="card-body text-center">
                                        <div class="form-group row">
                                        <div class="col mr-2">
                                        <div class="btn-group" role="group" aria-label="Basic example">

<?
	if($orders_stat_cd == "주문중"){
?>
                                            <a class="btn btn-outline-dark" name="btnOrderList">주문내역</a>
                                            <a class="btn btn-outline-dark" name="btnOrderModify">상태변경</a>
                                            <a class="btn btn-outline-dark" name="btnOrderDelete">주문삭제</a>
<?
	} else {
?>
                                            <a class="btn btn-outline-dark" name="btnOrderList">주문내역</a>
                                            <a class="btn btn-outline-dark" name="btnOrderModify">상태변경</a>
<?
    }
?>

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