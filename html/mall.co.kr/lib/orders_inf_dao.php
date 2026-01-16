<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

// 주문 테이블
const ORDERS_INF_TBL = 'orders_inf';

/**
 * 주문 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getOrdersInf(array $params)
{
    global $db;
    $response = [];

    $table = ORDERS_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 주문 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListOrdersInf(array $params)
{
    global $db;
    $response = [];

    $table = ORDERS_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 주문 데이터 저장
 *
 * @param array
 * @return bool
 */
function setOrdersInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = ORDERS_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (user_id, customers_zipcode, customers_addr, delivery_zipcode, delivery_addr, ';
    $sql .='pay_bank_cd, pay_acct_no, orders_date, orders_stat_cd, orders_total_amt, orders_tax, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $user_id.'", "'.$params['customers_zipcode'].'", "'.$params['customers_addr'].'", "';
    $sql .= $params['delivery_zipcode'].'", "'.$params['delivery_addr'].'", "';
    $sql .= $params['pay_bank_cd'].'", "'.$params['pay_acct_no'].'", "';
    $sql .= $params['orders_date'].'", "'.$params['orders_stat_cd'].'", "';
    $sql .= $params['orders_total_amt'].'", "'.$params['orders_tax'].'", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['orders_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 주문 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateOrdersInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = ORDERS_INF_TBL;
    $sql = '';

    // Set 조건
    if (validSingleData($params, 'set')) {
        // Table 조건
        if (validSingleData($params, 'table')) {
            $sql = 'UPDATE '.$params['table'].' SET '.$params['set'].', mod_dttm = now(), mod_id = '.'"'.$user_id.'"';
        } else {
            $sql = 'UPDATE '.$table.' SET '.$params['set'].', mod_dttm = now(), mod_id = '.'"'.$user_id.'"';
        }
    } else {
        $response['result'] = false;
        $response['error'] = '갱신할 정보가 유효하지 않습니다.';
        return $response;
    }

    // Where 조건
    if (validSingleData($params, 'where')) {
        $sql .= ' WHERE '.$params['where'];
    }

    $res = $db->query($sql);

    error_log("update affected_rows ".$db->affected_rows());

    if ($db->affected_rows() > 0) {
        $response['result'] = true;
    } else {
        $response['result'] = false;
        $response['error'] = $db->last_error();
    }

    return $response;
}


/**
 * 주문 삭제
 *
 * @param array 주문 정보
 * @return bool
 */
function deleteOrdersInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $orders_id = $params['orders_id'] ?? '';

    $table = ORDERS_INF_TBL;
    $sql = 'DELETE FROM '.$table.' WHERE orders_id = '.$orders_id;

    $res = $db->query($sql);

    error_log("delete affected_rows ".$db->affected_rows());

    if ($db->affected_rows() > 0) {
        $response['result'] = true;
    } else {
        $response['result'] = false;
        $response['error'] = $db->last_error();
    }

    return $response;

}

/**
 * DAO 를 활용한 Inteface
 *
 */

/**
 * 주문 목록 상세 데이터 조회
 * @return array
 */
function getListOrdersInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $user_id = $cond['user_id'];
    $orders_id = $cond['orders_id'];
    $orders_stat_cd = $cond['orders_stat_cd'];

    // 목록 조회
    $sql  = "select ";
    $sql .= " ROW_NUMBER() OVER(ORDER BY orders_id ASC) AS row_num ";
    $sql .= ", a.orders_id ";
    $sql .= ", a.customers_zipcode ";
    $sql .= ", a.customers_addr ";
    $sql .= ", a.delivery_zipcode ";
    $sql .= ", a.delivery_addr ";
    $sql .= ", a.pay_bank_cd ";
    $sql .= ", a.pay_acct_no ";
    $sql .= ", a.orders_date ";
    $sql .= ", a.orders_stat_cd ";
    $sql .= ", a.orders_tax ";
    $sql .= ", a.orders_total_amt ";
    $sql .= ", b.user_id ";
    $sql .= ", b.user_nm ";
    $sql .= ", b.tel ";
    $sql .= ", b.email ";
    $sql .= "from orders_inf a, user_inf b ";
    $sql .= "where 1=1 ";
    $sql .= "and a.user_id = b.user_id ";
    if (!empty($user_id)) {
        $sql .= "and a.user_id = '".$user_id."' ";
    }
    if (!empty($orders_id)) {
        $sql .= "and a.orders_id = '".$orders_id."' ";
    }
    if (!empty($orders_stat_cd)) {
        $sql .= "and a.orders_stat_cd = '".$orders_stat_cd."' ";
    }
    $result = $db->fetch_array($sql);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 주문명(name), 가격(price)
        $orders[$index] = $data;
        $orders[$index]['row_num'] = $data['row_num'];
        $orders[$index]['orders_id'] = $data['orders_id'];
        $orders[$index]['customers_zipcode'] = $data['customers_zipcode'];
        $orders[$index]['customers_addr'] = (mb_strlen($data['customers_addr']) > $nameLimitLength ? cutStr($data['customers_addr'], $nameLimitLength).'....' : $data['customers_addr']);
        $orders[$index]['delivery_zipcode'] = $data['delivery_zipcode'];
        $orders[$index]['delivery_addr'] = (mb_strlen($data['delivery_addr']) > $nameLimitLength ? cutStr($data['delivery_addr'], $nameLimitLength).'....' : $data['delivery_addr']);

        $orders[$index]['pay_bank_cd'] = $data['pay_bank_cd'];
        $orders[$index]['pay_acct_no'] = $data['pay_acct_no'];
        $orders[$index]['orders_date'] = $data['orders_date'];

        $params1=[
            'where' => "code_id = '".$data['orders_stat_cd']."' "
        ];
        $orders_stat_cd = getCodeInf($params1);
        $orders[$index]['orders_stat_cd'] = $orders_stat_cd['code_nm'];

        $orders[$index]['orders_total_amt'] = $data['orders_total_amt'];
        $orders[$index]['orders_tax'] = $data['orders_tax'];
    }
    $response = $orders;

    return $response;
}


/**
 * 주문 목록 상세 데이터 조회
 * @return array
 */
function getListShoppingOrdersInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $user_id = $cond['user_id'];
    $orders_id = $cond['orders_id'];
    $orders_stat_cd = $cond['orders_stat_cd'];

    // 목록 조회
    $sql  = "select ";
    $sql .= " ROW_NUMBER() OVER(ORDER BY orders_id ASC) AS row_num ";
    $sql .= ", a.orders_id ";
    $sql .= ", a.customers_zipcode ";
    $sql .= ", a.customers_addr ";
    $sql .= ", a.delivery_zipcode ";
    $sql .= ", a.delivery_addr ";
    $sql .= ", a.pay_bank_cd ";
    $sql .= ", a.pay_acct_no ";
    $sql .= ", a.orders_date ";
    $sql .= ", a.orders_stat_cd ";
    $sql .= ", a.orders_tax ";
    $sql .= ", a.orders_total_amt ";
    $sql .= ", b.user_id ";
    $sql .= ", b.user_nm ";
    $sql .= ", b.tel ";
    $sql .= ", b.email ";
    $sql .= ", c.product_id ";
    $sql .= ", c.products_final_price ";
    $sql .= ", c.products_cnt ";
    $sql .= ", c.products_price ";
    $sql .= ", d.product_nm ";
    $sql .= ", (select X.img_path from img_inf X where X.img_id = d.img1_id ) img1_path ";
    $sql .= "from orders_inf a, user_inf b, orders_products_inf c, product_inf d ";
    $sql .= "where a.user_id = '".$user_id."' ";
    if (!empty($orders_id)) {
        $sql .= "and a.orders_id = '".$orders_id."' ";
    }
    if (!empty($orders_stat_cd)) {
        $sql .= "and a.orders_stat_cd = '".$orders_stat_cd."' ";
    }

    $sql .= "and a.user_id = b.user_id ";
    $sql .= "and a.orders_id = c.orders_id ";
    $sql .= "and c.product_id = d.product_id ";
    $result = $db->fetch_array($sql);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 주문명(name), 가격(price)
        $orders[$index] = $data;
        $orders[$index]['row_num'] = $data['row_num'];
        $orders[$index]['orders_id'] = $data['orders_id'];
        $orders[$index]['customers_zipcode'] = $data['customers_zipcode'];
        $orders[$index]['customers_addr'] = (mb_strlen($data['customers_addr']) > $nameLimitLength ? cutStr($data['customers_addr'], $nameLimitLength).'....' : $data['customers_addr']);
        $orders[$index]['delivery_zipcode'] = $data['delivery_zipcode'];
        $orders[$index]['delivery_addr'] = (mb_strlen($data['delivery_addr']) > $nameLimitLength ? cutStr($data['delivery_addr'], $nameLimitLength).'....' : $data['delivery_addr']);

        $orders[$index]['pay_bank_cd'] = $data['pay_bank_cd'];
        $orders[$index]['pay_acct_no'] = $data['pay_acct_no'];
        $orders[$index]['orders_date'] = $data['orders_date'];

        $params1=[
            'where' => "code_id = '".$data['orders_stat_cd']."' "
        ];
        $orders_stat_cd = getCodeInf($params1);
        $orders[$index]['orders_stat_cd'] = $orders_stat_cd['code_nm'];

        $orders[$index]['orders_total_amt'] = $data['orders_total_amt'];
        $orders[$index]['orders_tax'] = $data['orders_tax'];
    }
    $response = $orders;

    return $response;
}


?>