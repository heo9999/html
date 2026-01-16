<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/code/code_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

    $db = new database();

    $code_id = (isset($_GET['code_id']) === true ? $_GET['code_id'] : '');
    error_log("aaa".$code_id);
    $params2 = [
        'use_yn' => '',
        'code_id' => $code_id
    ];

    $code_inf = getListCodeInfWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">코드을 수정합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="code_id" name="code_id" value="<?=$code_inf[0]['code_id']?>" readonly
                                            placeholder="코드ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="code_list" name="code_list" value="<?=$code_inf[0]['code_list']?>"
                                            placeholder="코드값">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="code_kind" name="code_kind" value="<?=$code_inf[0]['code_kind']?>"
                                            placeholder="코드종류">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="code_nm" name="code_nm" value="<?=$code_inf[0]['code_nm']?>"
                                            placeholder="코드명">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="sort_ordr" name="sort_ordr" value="<?=$code_inf[0]['sort_ordr']?>"
                                            placeholder="정렬순서">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="code_desc" name="code_desc" value="<?=$code_inf[0]['code_desc']?>"
                                            placeholder="설명">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_1" name="etc_meta_1" value="<?=$code_inf[0]['etc_meta_1']?>"
                                            placeholder="기타1">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_2" name="etc_meta_2" value="<?=$code_inf[0]['etc_meta_2']?>"
                                            placeholder="기타2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="custom-select" id="use_yn" name="use_yn"
                                            placeholder="사용여부">
                                            <option value="Y" <?php if( 'Y' == $code_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>Y</option>
                                            <option value="N" <?php if( 'N' == $code_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>N</option>
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

                                <a href="#" name="btnModify" class="btn btn-primary btn-user btn-block">
                                    코드수정
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