<?
    //header('Content-type: application/json');

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_products_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $orders_id = (isset($_POST['orders_id']) === true ? $_POST['orders_id'] : '');

    error_log('orders_id: '.$orders_id);

    //주문별 상품들 삭제
    $params = [
        'user_id' => $user_id,
        'orders_id' => $orders_id,

    ];
    $result = deleteOrders_ProductsInfWithOrdersID($params);
    if ($result) {
        if (empty($result['error'])) {

            //주문정보 삭제
            $params1 = [
                'user_id' => $user_id,
                'orders_id' => $orders_id,
            ];
            $result1 = deleteOrdersInf($params1);
            if ($result1) {
                if (empty($result1['error'])) {
                    print('{"result":true, "msg":"정상처리했습니다."}');
                } else {
                    print('{"result":false, "msg":"'.$result['error'].'"}');
                }
            } else {
                print('{"result":false, "msg":"주문 삭제하기에 실패하였습니다."}');
            }
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"주문별 상품삭제하기에 실패하였습니다."}');
    }

	$db->close();

?>
