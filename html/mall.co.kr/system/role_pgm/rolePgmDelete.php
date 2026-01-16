<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_pgm_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['pgm_id'] = (isset($_POST['pgm_id']) === true ? $_POST['pgm_id'] : '');

    if (empty($params['pgm_id'])) {
        print('{"result":false, "msg":"프로그램ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['role_id'] = (isset($_POST['role_id']) === true ? $_POST['role_id'] : '');

    if (empty($params['role_id'])) {
        print('{"result":false, "msg":"권한ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params2 = [
        'pgm_id' => $params['pgm_id'],
        'user_id' => $user_id,
        'role_id' => $params['role_id']
    ];

    $result = deleteRolePgm($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"프로그램별권한제거에 실패하였습니다."}');
    }

	$db->close();

?>
