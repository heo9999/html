<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 코드 테이블
const CODE_INF_TBL = 'code_inf';

/**
 * 코드 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getCodeInf(array $params)
{
    global $db;
    $response = [];

    $table = CODE_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 코드 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListCodeInf(array $params)
{
    global $db;
    $response = [];

    $table = CODE_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 코드 데이터 저장
 *
 * @param array
 * @return bool
 */
function setCodeInf(array $params)
{
    global $db;
    $response = [];

    $code_id = $params['code_id'] ?? '';

    $table = CODE_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (code_id, code_list, code_kind, code_nm, sort_ordr, ';
    $sql .=' code_desc, etc_meta_1, etc_meta_2, use_yn, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['code_id'].'", "'.$params['code_list'].'", "'.$params['code_kind'].'", "';
    $sql .= $params['code_nm'].'", "'.$params['sort_ordr'].'", "'.$params['code_desc'].'", "';
    $sql .= $params['etc_meta_1'].'", "'.$params['etc_meta_2'].'", "Y", "';
    $sql .= $code_id.'", "'.$code_id.'")';

    $response['result'] = $db->query($sql);
    $response['code_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 코드 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateCodeInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $code_id = $params['code_id'] ?? '';

    $table = CODE_INF_TBL;
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
 * 코드 삭제
 *
 * @param array 코드 정보
 * @return bool
 */
function deleteCodeInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $code_id = $params['code_id'] ?? '';

    $table = CODE_INF_TBL;
    $sql = "DELETE FROM ".$table." WHERE code_id = '".$code_id."'";

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
 * 코드 목록 상세 데이터 조회
 * @return array
 */
function getListCodeInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $use_yn = $cond['use_yn'];
    $code_id = $cond['code_id'];

error_log('xxx :'.$code_id);

    $where = '1=1';
    if($use_yn != ''){
        $where .= " and use_yn = '".$use_yn."'";
    }
    if($code_id != ''){
        $where .= " and code_id = '".$code_id."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY code_id, sort_ordr ASC) AS row_num,  code_inf.* ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'code_inf.code_id',
    ];
    $result = getListCodeInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    $response = $result;

    return $response;
}


?>