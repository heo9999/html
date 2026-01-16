<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/user/user_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

    $db = new database();

    //요양병원 리스트
    $hospitalList = getListForMemberInfCode();

    $user_id = (isset($_GET['user_id']) === true ? $_GET['user_id'] : '');
    error_log("aaa".$user_id);
    $params2 = [
        'use_yn' => '',
        'user_id' => $user_id
    ];

    $user_inf = getListUserInfWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">사용자을 삭제합니다.</h1>
                            </div>
                            <form name="frmData" id="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="user_id" name="user_id" value="<?=$user_inf[0]['user_id']?>" placeholder="사용자ID">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="pwd" name="pwd" value="<?=$user_inf[0]['pwd']?>" placeholder="비밀번호">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="pwd_fail_ct" name="pwd_fail_ct" value="<?=$user_inf[0]['pwd_fail_ct']?>" placeholder="비밀번호실패횟수">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="last_pwd_upd_dttm" name="last_pwd_upd_dttm" value="<?=$user_inf[0]['last_pwd_upd_dttm']?>" placeholder="마지막비밀번호수정일시">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="last_login_success_dttm" name="last_login_success_dttm" value="<?=$user_inf[0]['last_login_success_dttm']?>" placeholder="마지막로그인일시">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="login_ct" name="login_ct" value="<?=$user_inf[0]['login_ct']?>" placeholder="로그인횟수">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="user_nm" name="user_nm" value="<?=$user_inf[0]['user_nm']?>" placeholder="사용자명">
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="pgm_ty_cd" name="pgm_ty_cd"
                                            placeholder="요양병원">
                                            <label>요양병원</label>
                                        <?php foreach ($hospitalList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['hospitalNo']) ?>"? placeholder="요양병원"
                                            <?php if( $value['hospitalNo'] == $user_inf[0]['hospitalNo'] ): ?> selected="selected"<?php endif; ?>
                                            >
                                            <?= htmlspecialchars($value['hospitalname']) ?>:<?= htmlspecialchars($value['hospitalNo']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="job_nm" name="job_nm" value="<?=$user_inf[0]['job_nm']?>" placeholder="직위명">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="tel" name="tel" value="<?=$user_inf[0]['tel']?>" placeholder="전화번호">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" value="<?=$user_inf[0]['email']?>" placeholder="이메일">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_1" name="etc_meta_1" value="<?=$user_inf[0]['etc_meta_1']?>" placeholder="기타1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="etc_meta_2" name="etc_meta_2" value="<?=$user_inf[0]['etc_meta_2']?>" placeholder="기타2">
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="use_yn" name="use_yn"
                                            placeholder="사용여부">
                                            <option value="Y" <?php if( 'Y' == $user_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>Y</option>
                                            <option value="N" <?php if( 'N' == $user_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>N</option>
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
                                    사용자삭제
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