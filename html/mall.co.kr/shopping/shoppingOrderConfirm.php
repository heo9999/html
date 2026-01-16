<?
    //header('Content-type: application/json');

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/cart_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['orders_id'] = (isset($_POST['orders_id']) === true ? $_POST['orders_id'] : '');

    if (empty($params['orders_id'])) {
        print('{"result":false, "msg":"주문ID가 없습니다."}');
        $db->close();
        exit;
    }

    $orders_stat_cd = 'O0002';
    $updateSql  = "  orders_stat_cd = '".$orders_stat_cd."'";
    $params1 = [
        'where' => "orders_id ='".$params['orders_id']."'"." and user_id ='".$user_id."'",
        'set' => $updateSql
    ];

    $result = updateOrdersInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            //장바구니를 주문하고 장바구니를 비운다
            $params2 = [
                    'user_id' => $user_id
                ];

                $result2 = deleteCartInf($params2);

                if ($result2) {
                    if (empty($result2['error'])) {
                        print('{"result":true, "msg":"정상처리했습니다."}');
                    } else {
                        print('{"result":false, "msg":"'.$result['error'].'"}');
                    }
                } else {
                    print('{"result":false, "msg":"주문후 장바구니삭제에 실패하였습니다."}');
                }

        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"주문등록에 실패하였습니다."}');
    }

	$db->close();
?>
