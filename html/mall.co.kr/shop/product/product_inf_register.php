<?php
    $GLOBAL['appPath'] = "S";
    include_once("{$_SERVER['DOCUMENT_ROOT']}/shop/product/product_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/product_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

    $db = new database();

    $params=[
        'where' => "code_kind = 'category_cd' "
    ];
    $codeList = getListCodeInf($params);

    $params1=[
        'where' => "code_kind = 'product_stat_cd' "
    ];
    $codeList1 = getListCodeInf($params1);


?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">상품을 등록합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="product_nm" name="product_nm"
                                            placeholder="상품명">
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="category_cd" name="category_cd"
                                            placeholder="분류코드">
                                            <option "">상품분류</option>
                                        <?php foreach ($codeList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['code_id']) ?>"? placeholder="분류코드">
                                            <?= htmlspecialchars($value['code_nm']) ?>:<?= htmlspecialchars($value['code_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="product_ctnt" name="product_ctnt"
                                            placeholder="상품설명">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="product_price" name="product_price"
                                            placeholder="가격">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="product_cnt" name="product_cnt"
                                            placeholder="수량">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="sale_price" name="sale_price"
                                            placeholder="할인가격">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="sale_ratio" name="sale_ratio"
                                            placeholder="할인율">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="sale_cnt" name="sale_cnt"
                                            placeholder="할인수량">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="sale_end_date" name="sale_end_date"
                                            placeholder="할인종료일">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="custom-select" id="product_stat_cd" name="product_stat_cd"
                                            placeholder="상품상태">
                                            <option "">상품상태</option>
                                        <?php foreach ($codeList1 as $value1): ?>
                                            <option value="<?= htmlspecialchars($value1['code_id']) ?>"? placeholder="상품상태">
                                            <?= htmlspecialchars($value1['code_nm']) ?>:<?= htmlspecialchars($value1['code_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="use_yn" name="use_yn"
                                            placeholder="사용여부">
                                            <option "">사용여부</option>
                                            <option value="Y" selected>Y</option>
                                            <option value="N">N</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                </div>
                            </form>
                        <div class="row">
                        <div class="col-lg-6">

                            <!-- Image Upload1 -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <input type="file" id="image1" name="image" accept="image/*" required class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-xs font-weight text-primary text-uppercase mb-1">상품사진1</a>
                                </div>
                                <div class="card-body">
                                    <a href="#" name="btnImage1_up" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="#" name="btnImage1_del" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <img id="preViewImage1" src="" class="img-thumbnail">
                                    <input type="hidden" id="img1_id">
                                </div>
                            </div>

                            <!-- Image Upload2 -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <input type="file" id="image2" name="image" accept="image/*" required class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a class="text-xs font-weight text-primary text-uppercase mb-1">상품사진2</a>
                                </div>
                                <div class="card-body">
                                    <a href="#" name="btnImage2_up" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="#" name="btnImage2_del" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <img id="preViewImage2" src="" class="img-thumbnail">
                                    <input type="hidden" id="img2_id">
                                </div>
                            </div>

                        </div>
                        <!-- col-lg-6 -->
                        <div class="col-lg-6">

                            <!-- Image Upload3 -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <input type="file" id="image3" name="image" accept="image/*" required class="text-xs font-weight-bold text-info text-uppercase mb-1"><a class="text-xs font-weight text-primary text-uppercase mb-1">상품사진3</a>
                                </div>
                                <div class="card-body">
                                    <a href="#" name="btnImage3_up" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="#" name="btnImage3_del" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <img id="preViewImage3" src="" class="img-thumbnail">
                                    <input type="hidden" id="img3_id">
                                </div>
                            </div>

                            <!-- Image Upload4 -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <input type="file" id="image4" name="image" accept="image/*" required class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="text-xs font-weight text-primary text-uppercase mb-1">상품사진4</a>
                                </div>
                                <div class="card-body">
                                    <a href="#" name="btnImage4_up" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="#" name="btnImage4_del" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <img id="preViewImage4" src="" class="img-thumbnail">
                                    <input type="hidden" id="img4_id">
                                </div>
                            </div>

                        </div>
                        <!-- col-lg-6 -->
                        </div>
                        <!-- row -->
                                <div class="form-group">
                                </div>

                                <a href="#" name="btnRegister" class="btn btn-primary btn-user btn-block">
                                    상품등록
                                </a>
                                <a href="#" name="btnPrev" class="btn btn-info btn-user btn-block">
                                    이전화면
                                </a>
                                <hr>
                            <hr>

                                </div>
                                <!-- col -->
                                </div>
                                <!-- p5 -->
                    </div>
                    <!-- Content Row -->

<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>