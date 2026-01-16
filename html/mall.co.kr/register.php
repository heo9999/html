<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

    $db = new database();

    //요양병원 리스트
    $hospitalList = getListForMemberInfCode();

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">신규가입을 환영합니다.</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="UserId" name="UserId"
                                            placeholder="사용자Id">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="UserName" name="UserName"
                                            placeholder="사용자명">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="Email" name="Email"
                                            placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                        <select class="custom-select" id="hospitalNo" name="hospitalNo"
                                            placeholder="병원">
                                        <?php foreach ($hospitalList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['hospitalNo']) ?>"? placeholder="병원">
                                            <?= htmlspecialchars($value['hospitalname']) ?>:<?= htmlspecialchars($value['hospitalNo']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="InputPassword" name="InputPassword" placeholder="비밀번호">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="RepeatPassword" name="RepeatPassword" placeholder="비밀번호확인">
                                    </div>
                                </div>
                                <a href="#" name="btnRegister" class="btn btn-primary btn-user btn-block">
                                    사용자등록
                                </a>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgotPassword.php">비밀번호 모르세요?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">기존에 ID 가 있어요 Login 합니다.</a>
                            </div>

                                </div>
                                <!-- col -->
                                </div>
                                <!-- p5 -->
                    </div>
                    <!-- Content Row -->

<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>