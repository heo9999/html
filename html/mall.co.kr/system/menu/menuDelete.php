<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/pgm_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['pgm_id'] = (isset($_POST['pgm_id']) === true ? $_POST['pgm_id'] : '');

    if (empty($params['pgm_id'])) {
        print('{"result":false, "msg":"프로그램ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params2 = [
        'use_yn' => '',
        'user_id' => $user_id,
        'pgm_id' => $params['pgm_id']
    ];

    $result = deletePgmInf($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"프로그램제거에 실패하였습니다."}');
    }

	$db->close();

?>
