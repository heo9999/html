<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

// 상품 테이블
const PRODUCT_INF_TBL = 'product_inf';
/**
 * 상품 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getProductInf(array $params)
{
    global $db;
    $response = [];

    $table = PRODUCT_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 상품 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListProductInf(array $params)
{
    global $db;
    $response = [];

    $table = PRODUCT_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 상품 데이터 저장
 *
 * @param array
 * @return bool
 */
function setProductInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = PRODUCT_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (product_nm, category_cd, product_ctnt, product_price, product_cnt, sale_price, ';
    $sql .='sale_ratio, sale_cnt, sale_end_date, product_stat_cd, ';
    $sql .='img1_id, img2_id, img3_id, img4_id, ';
    $sql .=' use_yn, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['product_nm'].'", "'.$params['category_cd'].'", "'.$params['product_ctnt'].'", "';
    $sql .= $params['product_price'].'", "'.$params['product_cnt'].'", "'.$params['sale_price'].'", "'.$params['sale_ratio'].'", "';
    $sql .= $params['sale_cnt'].'", "'.$params['sale_end_date'].'", "'.$params['product_stat_cd'].'", "';
    $sql .= $params['img1_id'].'", "'.$params['img2_id'].'", "'.$params['img3_id'].'", "'.$params['img4_id'].'", "Y", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['product_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 상품 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateProductInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = PRODUCT_INF_TBL;
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
 * 상품 삭제
 *
 * @param array 상품 정보
 * @return bool
 */
function deleteProductInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $product_id = $params['product_id'] ?? '';

    $table = PRODUCT_INF_TBL;
    $sql = 'DELETE FROM '.$table.' WHERE product_id = '.$product_id;

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
 * 상품 목록 상세 데이터 조회
 * @return array
 */
function getListProductInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 20;
    $descLimitLength = 20;

    // 목록 조회 조건
    $use_yn = $cond['use_yn'];
    $product_id = $cond['product_id'];
    $product_stat_cd = $cond['product_stat_cd'];

error_log('xxx :'.$product_id);

    $where = '1=1';
    if($use_yn != ''){
        $where .= " and use_yn = '".$use_yn."'";
    }
    if($product_id != ''){
        $where .= " and product_id = '".$product_id."'";
    }
    if($product_stat_cd != ''){
        $where .= " and product_stat_cd = '".$product_stat_cd."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY product_id ASC) AS row_num,  `product_inf`.* ';
    $select .= ', (select img_path from img_inf X where X.img_id = `product_inf`.img1_id) img1_path ';
    $select .= ', (select img_path from img_inf X where X.img_id = `product_inf`.img2_id) img2_path ';
    $select .= ', (select img_path from img_inf X where X.img_id = `product_inf`.img3_id) img3_path ';
    $select .= ', (select img_path from img_inf X where X.img_id = `product_inf`.img4_id) img4_path ';
    $select .= ', (select img_path from img_inf X where X.img_id = `product_inf`.img5_id) img5_path ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => '`product_inf`.product_id',
    ];
    $result = getListProductInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 상품명(name), 가격(product_price)
        $product[$index] = $data;
        $product[$index]['row_num'] = $data['row_num'];
        $product[$index]['product_id'] = $data['product_id'];
        $product[$index]['product_nm'] = (mb_strlen($data['product_nm']) > $nameLimitLength ? cutStr($data['product_nm'], $nameLimitLength).'....' : $data['product_nm']);
        $product[$index]['product_ctnt'] = (mb_strlen($data['product_ctnt']) > $descLimitLength ? cutStr(htmlspecialchars_decode($data['product_ctnt']), $descLimitLength).'....' : htmlspecialchars_decode($data['product_ctnt']));
        $product[$index]['product_price'] = $data['product_price'];

        $params1=[
            'where' => "code_id = '".$data['category_cd']."' "
        ];
        $category_cd = getCodeInf($params1);
        $product[$index]['category_cd'] = $category_cd['code_nm'];

        $params2=[
            'where' => "code_id = '".$data['product_stat_cd']."' "
        ];
        $product_stat_cd = getCodeInf($params2);
        $product[$index]['product_stat_cd'] = $product_stat_cd['code_nm'];

        $product[$index]['img1_path'] = (empty($data['img1_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img1_path']);
        $product[$index]['img2_path'] = (empty($data['img2_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img2_path']);
        $product[$index]['img3_path'] = (empty($data['img3_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img3_path']);
        $product[$index]['img4_path'] = (empty($data['img4_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img4_path']);
        $product[$index]['img5_path'] = (empty($data['img5_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img5_path']);
    }
    $response = $product;

    return $response;
}

?>