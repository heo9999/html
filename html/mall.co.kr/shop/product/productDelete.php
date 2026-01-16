<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/product_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['product_id'] = (isset($_POST['product_id']) === true ? $_POST['product_id'] : '');

    if (empty($params['product_id'])) {
        print('{"result":false, "msg":"상품ID가 없습니다."}');
        $db->close();
        exit;
    }

    error_log("aaa".$params['product_id']);
    $params2 = [
        'use_yn' => '',
        'user_id' => $user_id,
        'product_id' => $params['product_id']
    ];

    $result = deleteProductInf($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"상품삭제에 실패하였습니다."}');
    }

	$db->close();

?>
