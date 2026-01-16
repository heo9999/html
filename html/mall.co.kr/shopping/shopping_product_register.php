<?php
    //상품목록 ROLE_USER
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/shopping/shopping_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/product_inf_dao.php");

    $db = new database();

    // 입력 데이터 수신
    $params['product_id'] = (isset($_GET['product_id']) === true ? $_GET['product_id'] : '');

    error_log('aaa :'.$params['product_id']);

    $params = [
        'use_yn' => '',
        'product_id' => $params['product_id'],
        'product_stat_cd' => 'S0002'  //상품판매중
    ];
    $product_inf = getListProductInfWithDetail($params);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">


                        <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">상품구매</h1>
                        </div>
                            <form class="user" name="ordersForm">
                                <input type="hidden" name="product_id" value="<?=$product_inf[0]['product_id']?>">
                                <input type="hidden" name="product_price" value="<?=$product_inf[0]['product_price']?>">
                                <input type="hidden" name="product_cnt" value="<?=$product_inf[0]['product_cnt']?>">
                                <div class="form-group row">
                        <!-- 상품 Card Example -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <img class="img-thumbnail" src="<?=$product_inf[0]['img1_path']?>" alt="<?=$product_inf[0]['product_nm']?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 상품 Card Example -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="form-group row">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <?=$product_inf[0]['product_nm']?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> &#x20A9; <?=number_format($product_inf[0]['product_price'])?></div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="form-group row">
                                            <h5><span class="badge badge-light">수량</span></h5>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="form-group row">
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="Basic example">
                                            <button type ="button" onclick="subAmt();" class="btn btn-outline-dark">-</button>
                                            <input type="button" name="totalCnt" value="1" readonly="readonly" class="btn btn-outline-dark"/>
                                            <button type="button" onclick="addAmt();" class="btn btn-outline-dark">+</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="Basic example">
                                            <input type="button" name="totalAmt" value=<?=number_format($product_inf[0]['product_price'])?> readonly="readonly" class="btn btn-primary"/>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="form-group row">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-outline-dark" name="btnCartBuy">구매하기</a>
                                            <a class="btn btn-outline-dark" name="btnCartPush">장바구니</a>
                                            <a class="btn btn-outline-dark" name="btnProdList">상품목록</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                </div>
                            </form>

                    </div>
                    <!-- Content Row -->


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>