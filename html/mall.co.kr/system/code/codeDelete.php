<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['code_id'] = (isset($_POST['code_id']) === true ? $_POST['code_id'] : '');

    if (empty($params['code_id'])) {
        print('{"result":false, "msg":"코드ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params2 = [
        'use_yn' => '',
        'user_id' => $user_id,
        'code_id' => $params['code_id']
    ];

    $result = deleteCodeInf($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"코드제거에 실패하였습니다."}');
    }

	$db->close();

?>
