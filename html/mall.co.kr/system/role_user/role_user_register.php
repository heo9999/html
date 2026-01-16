<?php
    $GLOBAL['appPath'] = "S";
	include_once("{$_SERVER['DOCUMENT_ROOT']}/system/role_user/role_user_header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/role_user_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/role_inf_dao.php");

    $db = new database();

    //사용자 리스트
    $params = [
        'use_yn' => '',
        'user_id' => ''
    ];
    $userList = getListUserInfWithDetail($params);

    //권한 리스트
    $params1 = [
        'use_yn' => '',
        'role_id' => ''
    ];

    $roleList = getListRoleInfWithDetail($params1);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">사용자별권한정보를 등록합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="custom-select" id="user_id" name="user_id"
                                            placeholder="사용자ID">
                                        <?php foreach ($userList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['user_id']) ?>"? placeholder="사용자ID">
                                            <?= htmlspecialchars($value['user_nm']) ?>:<?= htmlspecialchars($value['user_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="role_id" name="role_id"
                                            placeholder="권한ID">
                                        <?php foreach ($roleList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['role_id']) ?>"? placeholder="권한ID">
                                            <?= htmlspecialchars($value['role_nm']) ?>:<?= htmlspecialchars($value['role_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
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
                                    사용자별권한등록
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