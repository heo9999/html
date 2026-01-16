<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 장바구니 테이블
const CART_INF_TBL = 'cart_inf';

/**
 * 장바구니 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getCartInf(array $params)
{
    global $db;
    $response = [];

    $table = CART_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 장바구니 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListCartInf(array $params)
{
    global $db;
    $response = [];

    $table = CART_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 장바구니 데이터 저장
 *
 * @param array
 * @return bool
 */
function setCartInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = CART_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (user_id, product_id, product_price, product_cnt, cart_price, cart_cnt, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['user_id'].'", "'.$params['product_id'].'", "'.$params['product_price'].'", "';
    $sql .= $params['product_cnt'].'", "'.$params['cart_price'].'", "'.$params['cart_cnt'].'", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['cart_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 장바구니 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateCartInf(array $params)
{
    global $db;
    $response = [];

    $cart_id = $params['cart_id'] ?? '';
    $user_id = $params['user_id'] ?? '';

    $table = CART_INF_TBL;
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
 * 장바구니 삭제
 *
 * @param array 장바구니 정보
 * @return bool
 */
function deleteCartInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $cart_id = $params['cart_id'] ?? '';

    $table = CART_INF_TBL;
    $sql = 'DELETE FROM '.$table." WHERE user_id = '".$user_id."'";

    if($cart_id != ''){
        $sql .= " and cart_id = '".$cart_id."'";
    }

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
 * 장바구니 상품 목록 상세 데이터 조회
 * @return array
 */
function getListCartInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 20;
    $descLimitLength = 20;

    // 목록 조회 조건
    $user_id = $cond['user_id'];

    // 목록 조회
    $sql  ='select ';
    $sql .='ROW_NUMBER() OVER(ORDER BY cart_id ASC) AS row_num,  `cart_inf`.*, product_inf.product_nm ';
    $sql .= ", (select sum(x.cart_price) from cart_inf x where x.user_id = '".$user_id."') sum_cart_price ";
    $sql .= ', (select img_path from img_inf X where X.img_id = `product_inf`.img1_id) img1_path ';
    $sql .= ' from cart_inf, product_inf, img_inf ';
    $sql .= ' where cart_inf.product_id = product_inf.product_id ';
    $sql .= ' and product_inf.img1_id = img_inf.img_id ';
    $sql .= " and cart_inf.user_id = '".$user_id."' ";
    $sql .= ' group by cart_id';


    $result = $db->fetch_array($sql);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 상품명(name), 가격(product_price)
        $cart[$index] = $data;
        $cart[$index]['row_num'] = $data['row_num'];
        $cart[$index]['cart_id'] = $data['cart_id'];
        $cart[$index]['product_id'] = $data['product_id'];
        $cart[$index]['product_nm'] = (mb_strlen($data['product_nm']) > $nameLimitLength ? cutStr($data['product_nm'], $nameLimitLength).'....' : $data['product_nm']);
        $cart[$index]['product_price'] = $data['product_price'];
        $cart[$index]['cart_cnt'] = $data['cart_cnt'];
        $cart[$index]['product_cnt'] = $data['product_cnt'];

        $cart[$index]['img1_path'] = (empty($data['img1_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img1_path']);
    }
    $response = $cart;

    return $response;
}



?>