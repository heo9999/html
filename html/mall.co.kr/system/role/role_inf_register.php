<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/role/role_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/role_inf_dao.php");

    $db = new database();

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">권한정보를 등록합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="role_id" name="role_id"
                                            placeholder="권한ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="role_nm" name="role_nm"
                                            placeholder="권한명">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="role_ordr" name="role_ordr"
                                            placeholder="정렬순서">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="role_desc" name="role_desc"
                                            placeholder="설명">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_1" name="etc_meta_1"
                                            placeholder="기타1">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_2" name="etc_meta_2"
                                            placeholder="기타2">
                                    </div>
                                </div>
                                <div class="form-group row">
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
                        </div>
                                <div class="form-group">
                                </div>

                                <a href="#" name="btnRegister" class="btn btn-primary btn-user btn-block">
                                    권한등록
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