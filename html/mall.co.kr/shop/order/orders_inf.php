<?php
    $GLOBAL['appPath'] = "S";
    include_once("{$_SERVER['DOCUMENT_ROOT']}/shop/order/orders_header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_inf_dao.php");

    $db = new database();

    $user_id = $mallUserId;
    $orders_stat_cd = "";

    $params = [
        'orders_id' => '',
        'user_id' => '',
        'orders_stat_cd' => $orders_stat_cd
    ];
    $orders_inf = getListOrdersInfWithDetail($params);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">주문관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">주문</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL2('/shop/order/orders_inf_detail.php','orders_id',1,'user_id',2);">상세</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>주문ID</th>
                                            <th scope="col" style="display: none;">사용자ID</th>
                                            <th>주문자_우편번호</th>
                                            <th>주문자_주소</th>
                                            <th>배송지_우편번호</th>
                                            <th>배송지_주소</th>
                                            <th>지급은행코드</th>
                                            <th>지급계좌번호</th>
                                            <th>주문시간</th>
                                            <th>주문상태</th>
                                            <th>주문금액</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>주문ID</th>
                                            <th scope="col" style="display: none;">사용자ID</th>
                                            <th>주문자_우편번호</th>
                                            <th>주문자_주소</th>
                                            <th>배송지_우편번호</th>
                                            <th>배송지_주소</th>
                                            <th>지급은행코드</th>
                                            <th>지급계좌번호</th>
                                            <th>주문시간</th>
                                            <th>주문상태</th>
                                            <th>주문금액</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$orders_inf){
?>
<?
	}else{
		foreach($orders_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['orders_id']?></td>
                                            <td style="display: none;"><?=$list['user_id']?></td>
                                            <td><?=$list['customers_zipcode']?></td>
                                            <td><?=$list['customers_addr']?></td>
                                            <td><?=$list['delivery_zipcode']?></td>
                                            <td><?=$list['delivery_addr']?></td>
                                            <td><?=$list['pay_bank_cd']?></td>
                                            <td><?=$list['pay_acct_no']?></td>
                                            <td><?=$list['orders_date']?></td>
                                            <td><?=$list['orders_stat_cd']?></td>
                                            <td><?=$list['orders_total_amt']?></td>
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


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>