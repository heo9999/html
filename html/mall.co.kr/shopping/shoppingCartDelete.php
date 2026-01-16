<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/cart_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $cart_id = (isset($_POST['cart_id']) === true ? $_POST['cart_id'] : '');

    if (empty($params['cart_id'])) {
        print('{"result":false, "msg":"카트ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params2 = [
        'cart_id' => $cart_id,
        'user_id' => $user_id
    ];

    $result = deleteCartInf($params2);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"장바구니삭제에 실패하였습니다."}');
    }

	$db->close();

?>
