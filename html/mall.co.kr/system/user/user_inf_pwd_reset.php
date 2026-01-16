<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/user/user_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

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
