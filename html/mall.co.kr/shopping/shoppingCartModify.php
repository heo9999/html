<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/cart_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['cart_id'] = (isset($_POST['cart_id']) === true ? $_POST['cart_id'] : '');

    if (empty($params['cart_id'])) {
        print('{"result":false, "msg":"장바구니ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['product_id'] = (isset($_POST['product_id']) === true ? $_POST['product_id'] : 0);
    $params['product_price'] = (float)(isset($_POST['product_price']) === true ? $_POST['product_price'] : 0);
    $params['product_cnt'] = (float)(isset($_POST['product_cnt']) === true ? $_POST['product_cnt'] : 0);
    $params['cart_price'] = (float)(isset($_POST['cart_price']) === true ? $_POST['cart_price'] : 0);
    $params['cart_cnt'] = (float)(isset($_POST['cart_cnt']) === true ? $_POST['cart_cnt'] : 0);

    $updateSql  = "  product_id = '".$params['product_id']."'";
    $updateSql .= ", cart_price = '".$params['cart_price']."'";
    $updateSql .= ", cart_cnt = '".$params['cart_cnt']."'";
    $params1 = [
        'where' => "cart_id ='".$params['cart_id']."'"." and user_id ='".$user_id."'",
        'set' => $updateSql
    ];

    $result = updateCartInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"장바구니등록에 실패하였습니다."}');
    }

	$db->close();
?>
