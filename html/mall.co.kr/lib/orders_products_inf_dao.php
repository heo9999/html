<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

// 주문별 상품별 테이블
const ORDERS_PRODUCTS_INF_TBL = 'orders_products_inf';

/**
 * 주문별 상품별 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getOrders_ProductsInf(array $params)
{
    global $db;
    $response = [];

    $table = ORDERS_PRODUCTS_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 주문별 상품별 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListOrders_ProductsInf(array $params)
{
    global $db;
    $response = [];

    $table = ORDERS_PRODUCTS_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 주문별 상품별 데이터 저장
 *
 * @param array
 * @return bool
 */
function setOrders_ProductsInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = ORDERS_PRODUCTS_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (orders_id, product_id, products_price, products_final_price, products_tax, ';
    $sql .='products_cnt, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['orders_id'].'", "'.$params['product_id'].'", "'.$params['products_price'].'", "';
    $sql .= $params['products_final_price'].'", "'.$params['products_tax'].'", "'.$params['products_cnt'].'","';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['orders_products_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 주문별 상품별 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateOrders_ProductsInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = ORDERS_PRODUCTS_INF_TBL;
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
 * 주문별 상품별 삭제
 *
 * @param array 주문 정보
 * @return bool
 */
function deleteOrders_ProductsInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $orders_products_id = $params['orders_products_id'] ?? '';

    $table = ORDERS_PRODUCTS_INF_TBL;
    $sql = 'DELETE FROM '.$table.' WHERE orders_products_id = '.$orders_products_id;

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
 * 주문번호로 주문별 상품별삭제 삭제
 *
 * @param array 주문 정보
 * @return bool
 */
function deleteOrders_ProductsInfWithOrdersID(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $orders_id = $params['orders_id'] ?? '';

    $table = ORDERS_PRODUCTS_INF_TBL;
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



?>