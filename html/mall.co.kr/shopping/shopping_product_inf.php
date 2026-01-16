<?php
    //상품목록 ROLE_GUEST
    $GLOBAL['appPath'] = "S";
	include_once("{$_SERVER['DOCUMENT_ROOT']}/shopping/shopping_header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/product_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'product_id' => '',
        'product_stat_cd' => 'S0002'  //상품판매중
    ];
    $product_inf = getListProductInfWithDetail($params);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">상품목록</h1>

                    <!-- Content Row -->
                    <div class="row">


<?

	if(!$product_inf){
        for ($i=1;$i<5 ;$i++ ) {
                $inum = number_format($i * 10000);
?>
                        <!-- 상품 Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                준비중</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> &#x20A9; <?= $inum ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <img class="img-thumbnail" src="/image/no_image.jpg" width="30" height="20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?
        }
	}else{
        $rowCnt = 0;
		foreach($product_inf as $list){
?>
                        <!-- 상품 Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <a href="/shopping/shopping_product_register.php?product_id=<?=$list['product_id']?>"><img class="img-thumbnail" src="<?=$list['img1_path']?>" alt="<?=$list['product_nm']?>"></a>
                                        </div>
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <?=$list['product_nm']?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> &#x20A9; <?=number_format($list['product_price'])?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?
		}
	}
?>
                    </div>
                    <!-- Content Row -->


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>