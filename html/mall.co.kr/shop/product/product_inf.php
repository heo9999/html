<?php
    $GLOBAL['appPath'] = "S";
    include("{$_SERVER['DOCUMENT_ROOT']}/shop/product/product_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/product_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'product_id' => '',
        'product_stat_cd' => ''
    ];
    $product_inf = getListProductInfWithDetail($params);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">상품관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">상품</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/shop/product/product_inf_register.php">등록</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/shop/product/product_inf_modify.php','product_id',1);">수정</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/shop/product/product_inf_delete.php','product_id',1);">삭제</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">상품ID</th>
                                            <th scope="col">상품명</th>
                                            <th scope="col">분류코드</th>
                                            <th scope="col">상품설명</th>
                                            <th scope="col">가격</th>
                                            <th scope="col">재고수량</th>
                                            <th scope="col">사진</th>
                                            <th scope="col">할인가격</th>
                                            <th scope="col">할인율</th>
                                            <th scope="col">할인수량</th>
                                            <th scope="col">할인종료일</th>
                                            <th scope="col">상품상태</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">상품ID</th>
                                            <th scope="col">상품명</th>
                                            <th scope="col">분류코드</th>
                                            <th scope="col">상품설명</th>
                                            <th scope="col">가격</th>
                                            <th scope="col">재고수량</th>
                                            <th scope="col">사진</th>
                                            <th scope="col">할인가격</th>
                                            <th scope="col">할인율</th>
                                            <th scope="col">할인수량</th>
                                            <th scope="col">할인종료일</th>
                                            <th scope="col">상품상태</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$product_inf){
?>
<?
	}else{
		foreach($product_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['product_id']?></td>
                                            <td><?=$list['product_nm']?></td>
                                            <td><?=$list['category_cd']?></td>
                                            <td><?=$list['product_ctnt']?></td>
                                            <td><?=$list['product_price']?></td>
                                            <td><?=$list['product_cnt']?></td>
                                            <td><img src=<?=$list['img1_path']?> width=50 height=50></td>
                                            <td><?=$list['sale_price']?></td>
                                            <td><?=$list['sale_ratio']?></td>
                                            <td><?=$list['sale_cnt']?></td>
                                            <td><?=$list['sale_end_date']?></td>
                                            <td><?=$list['product_stat_cd']?></td>
                                            <td><?=$list['use_yn']?></td>
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