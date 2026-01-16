<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/header.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

    $db = new database();

    $hospitalList = getListForMemberInfCode();
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">비밀번호를 분실하셨나요?</h1>
                                        <p class="mb-4">ID 를 입력하시면 비밀번호(1234)를 초기화 해드립니다.</p>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="UserId" name="UserId" aria-describedby="emailHelp"
                                                placeholder="사용자ID">
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
                                        <a href="#" name="btnForgotPassword" class="btn btn-primary btn-user btn-block">
                                            비밀번호 초기화
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">신규등록!</a>
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