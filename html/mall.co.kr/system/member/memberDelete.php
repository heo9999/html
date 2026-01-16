<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['hospitalNo'] = (isset($_POST['hospitalNo']) === true ? $_POST['hospitalNo'] : '');

    if (empty($params['hospitalNo'])) {
        print('{"result":false, "msg":"요양기관번호가 없습니다."}');
        $db->close();
        exit;
    }

    $params2 = [
        'use_yn' => '',
        'user_id' => $user_id,
        'hospitalNo' => $params['hospitalNo']
    ];

    $result = deleteMemberInf($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"요양기관제거에 실패하였습니다."}');
    }

	$db->close();

?>
