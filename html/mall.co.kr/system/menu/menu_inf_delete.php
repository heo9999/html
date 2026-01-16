<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/menu/menu_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/pgm_inf_dao.php");

    $db = new database();

    $pgm_id = (isset($_GET['pgm_id']) === true ? $_GET['pgm_id'] : '');
    error_log("aaa".$pgm_id);
    $params2 = [
        'use_yn' => '',
        'pgm_id' => $pgm_id
    ];

    $pgm_inf = getListPgmInfWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">상품을 삭제합니다.</h1>
                            </div>
                            <form name="frmData" id="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="pgm_id" name="pgm_id" value="<?=$pgm_inf[0]['pgm_id']?>" placeholder="프로그램ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="upper_pgm_id" name="upper_pgm_id" value="<?=$pgm_inf[0]['upper_pgm_id']?>" placeholder="상위프로그램ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="pgm_ordr" name="pgm_ordr" value="<?=$pgm_inf[0]['pgm_ordr']?>" placeholder="프로그램순서">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="pgm_nm" name="pgm_nm" value="<?=$pgm_inf[0]['pgm_nm']?>" placeholder="프로그램명">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="pgm_url" name="pgm_url" value="<?=$pgm_inf[0]['pgm_url']?>" placeholder="프로그램URL">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="pgm_ty_cd" name="pgm_ty_cd" value="<?=$pgm_inf[0]['pgm_ty_cd']?>" placeholder="프로그램형태">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_1" name="etc_meta_1" value="<?=$pgm_inf[0]['etc_meta_1']?>" placeholder="기타1">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_2" name="etc_meta_2" value="<?=$pgm_inf[0]['etc_meta_2']?>" placeholder="기타2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="use_yn" name="use_yn"
                                            placeholder="사용여부">
                                            <option value="Y" <?php if( 'Y' == $pgm_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>Y</option>
                                            <option value="N" <?php if( 'N' == $pgm_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>N</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                </div>
                            </form>
                        <div class="row">
                        </div>
                                <div class="form-group">
                                </div>

                                <a href="#" name="btnDelete" class="btn btn-primary btn-user btn-block">
                                    프로그램삭제
                                </a>
                                <a href="#" name="btnPrev" class="btn btn-info btn-user btn-block">
                                    이전화면
                                </a>
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