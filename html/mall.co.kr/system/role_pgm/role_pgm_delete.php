<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/role_pgm/role_pgm_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_pgm_dao.php");

    $db = new database();

    $pgm_id = (isset($_GET['pgm_id']) === true ? $_GET['pgm_id'] : '');
    $role_id = (isset($_GET['role_id']) === true ? $_GET['role_id'] : '');
    error_log("aaa:".$role_id." bbbb :".$pgm_id);
    $params2 = [
        'pgm_id' => $pgm_id,
        'role_id' => $role_id
    ];

    $role_pgm = getListRolePgmWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">프로그램별권한을 삭제합니다.</h1>
                            </div>
                            <form name="frmData" id="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="pgm_id" name="pgm_id" value="<?=$role_pgm[0]['pgm_id']?>" placeholder="프로그램ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="role_id" name="role_id" value="<?=$role_pgm[0]['role_id']?>" placeholder="권한ID">
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
                                    프로그램별권한삭제
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