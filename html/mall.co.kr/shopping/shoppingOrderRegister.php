<?
    //header('Content-type: application/json');

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/orders_products_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $cart_ids = (isset($_POST['cart_id']) === true ? $_POST['cart_id'] : []);
    $product_ids = (isset($_POST['product_id']) === true ? $_POST['product_id'] : []);
    $product_prices = (isset($_POST['product_price']) === true ? $_POST['product_price'] : []);
    $product_cnts = (isset($_POST['product_cnt']) === true ? $_POST['product_cnt'] : []);
    $cart_prices = (isset($_POST['cart_price']) === true ? $_POST['cart_price'] : []);
    $cart_cnts = (isset($_POST['cart_cnt']) === true ? $_POST['cart_cnt'] : []);
    $totAmts = (isset($_POST['totAmt']) === true ? $_POST['totAmt'] : []);

    error_log('array: '.count($cart_ids));

    //주문정보 저장
    //주문자/배송지 정보
    $params1 = [
        'user_id' => $user_id
    ];
    $user_order_inf = getOrderInfoWithUser($params1);

    $currentDate = time();
    $timeString = date("Ymd", $currentDate);

    //계좌정보
    $params2=[
        'where' => "code_kind = 'credit_account' "
    ];
    $codeList = getListCodeInf($params2);

    $params['customers_zipcode'] = $user_order_inf['zipcode'];
    $params['customers_addr'] = $user_order_inf['addr'];
    $params['delivery_zipcode'] = $user_order_inf['zipcode'];
    $params['delivery_addr'] = $user_order_inf['addr'];
    $params['pay_bank_cd'] = $codeList[0]['etc_meta_1'];
    $params['pay_acct_no'] = $codeList[0]['etc_meta_2'];
    $params['orders_date'] = $timeString; //now()
    $params['orders_stat_cd'] = 'O0001'; //상품준비중
    $params['orders_total_amt'] = $totAmts[0];
    $params['orders_tax'] = 0;

    $result = [];
    $result = setOrdersInf($params);

    if ($result) {
        $orders_id = $result['orders_id'];

        //주문별 상품들 저장
        for ($i = 0; $i < count($cart_ids); $i++) {

            $cart_id = trim($cart_ids[$i]);
            $product_id = trim($product_ids[$i]);
            $product_price = trim($product_prices[$i]);
            $product_cnt = trim($product_cnts[$i]);
            $cart_price = trim($cart_prices[$i]);
            $cart_cnt = trim($cart_cnts[$i]);

            $params = [
                'user_id' => $user_id,
                'orders_id' => $orders_id,
                'product_id' => $product_id,
                'products_price' => (float)$product_price,
                'products_final_price' => $cart_price,
                'products_tax' => 0,
                'products_cnt' => (float)$cart_cnt

            ];
            $result1 = setOrders_ProductsInf($params);
        }

    }

    if ($result1) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다.", "rval":'.$orders_id.'}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"주문하기에 실패하였습니다."}');
    }

	$db->close();
?>
