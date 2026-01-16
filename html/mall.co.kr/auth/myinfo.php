<?php
    $GLOBAL['appPath'] = 'S';

	include_once("{$_SERVER['DOCUMENT_ROOT']}/header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

    // 입력 데이터 수신
    $user_id = $mallUserId;

    $ver = time();
    $db = new database();

    //사용자정보
    $params1 = [
        'where' => "user_id = '".$user_id."'"
    ];
    $user_inf = getUserInf($params1);

    if ($user_inf) {
        $hospitalNo = $user_inf['hospitalNo'];
        $user_id = $user_inf['user_id'];
        $user_nm = $user_inf['user_nm'];
        $email = $user_inf['email'];;
    } else {
        $hospitalNo = '';
        $user_id = '';
        $user_nm = '';
        $email = '';
    }

    $params2=[
        'where' => "hospitalNo = '".$hospitalNo."'"
    ];

    $member = getMemberInf($params2);
    if ($member) {
        $hospitalname = $member['hospitalname'];

    } else {
        $hospitalname = '';
    }

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">My Info</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="UserId" name="UserId"
                                            placeholder="사용자Id" value="<?=$user_id?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="UserName" name="UserName"
                                            placeholder="사용자명" value="<?=$user_nm?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="Email" name="Email"
                                            placeholder="Email Address" value="<?=$email?>">
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="hospitalname" name="hospitalname"
                                            placeholder="hospitalname" value="<?=$hospitalname?>">
                                </div>
                            </form>
                            <hr>
                        </div>

                    </div>
                    <!-- Content Row -->


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>