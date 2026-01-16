<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_user_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $params['user_id'] = (isset($_POST['user_id']) === true ? $_POST['user_id'] : '');

    if (empty($params['user_id'])) {
        print('{"result":false, "msg":"사용자ID가 없습니다."}');
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
        'user_id' => $params['user_id'],
        'role_id' => $params['role_id']
    ];

    $result = deleteRoleUser($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"사용자별권한제거에 실패하였습니다."}');
    }

	$db->close();

?>
