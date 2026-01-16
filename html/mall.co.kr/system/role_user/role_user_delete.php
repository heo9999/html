<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/role_user/role_user_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_user_dao.php");

    $db = new database();

    $user_id = (isset($_GET['user_id']) === true ? $_GET['user_id'] : '');
    $role_id = (isset($_GET['role_id']) === true ? $_GET['role_id'] : '');
    error_log("aaa".$role_id);
    $params2 = [
        'user_id' => $user_id,
        'role_id' => $role_id
    ];

    $role_user = getListRoleUserWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">사용자별권한을 삭제합니다.</h1>
                            </div>
                            <form name="frmData" id="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="user_id" name="user_id" value="<?=$role_user[0]['user_id']?>" placeholder="사용자ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="role_id" name="role_id" value="<?=$role_user[0]['role_id']?>" placeholder="권한ID">
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
                                    사용자별권한삭제
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