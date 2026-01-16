<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    // 관리자모드라 사용자를 입력 받아야 함
    $user_id = (isset($_POST['user_id']) === true ? $_POST['user_id'] : '');
    $orders_id = (isset($_POST['orders_id']) === true ? $_POST['orders_id'] : '');
    $orders_stat_cd = (isset($_POST['orders_stat_cd']) === true ? $_POST['orders_stat_cd'] : '');

    if (empty($orders_id)) {
        print('{"result":false, "msg":"주문ID가 없습니다."}');
        $db->close();
        exit;
    }

    $updateSql = " orders_stat_cd = '".$orders_stat_cd."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "orders_id ='".$orders_id."' and user_id = '".$user_id."'" ,
        'set' => $updateSql
    ];

    $result = updateOrdersInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"주문수정에 실패하였습니다."}');
    }

	$db->close();
?>
