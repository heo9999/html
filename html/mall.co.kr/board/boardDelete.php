<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/board_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['board_id'] = (isset($_POST['board_id']) === true ? $_POST['board_id'] : '');

    if (empty($params['board_id'])) {
        print('{"result":false, "msg":"게시판ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params2 = [
        'use_yn' => '',
        'user_id' => $user_id,
        'board_id' => $params['board_id']
    ];

    $result = deleteBoardInf($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"게시판제거에 실패하였습니다."}');
    }

	$db->close();

?>
