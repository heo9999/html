<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 권한 테이블
const ROLE_INF_TBL = 'role_inf';

/**
 * 권한 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getRoleInf(array $params)
{
    global $db;
    $response = [];

    $table = ROLE_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 권한 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListRoleInf(array $params)
{
    global $db;
    $response = [];

    $table = ROLE_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 권한 데이터 저장
 *
 * @param array
 * @return bool
 */
function setRoleInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = ROLE_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (role_id, role_nm, role_ordr, role_desc, use_yn, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['role_id'].'", "'.$params['role_nm'].'", "'.$params['role_ordr'].'", "';
    $sql .= $params['role_desc'].'", "Y", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['role_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 권한 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateRoleInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $role_id = $params['role_id'] ?? '';

    $table = ROLE_INF_TBL;
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
 * 권한 삭제
 *
 * @param array 권한 정보
 * @return bool
 */
function deleteRoleInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $role_id = $params['role_id'] ?? '';

    $table = ROLE_INF_TBL;
    $sql = "DELETE FROM ".$table." WHERE role_id = '".$role_id."'";

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
function getListRoleInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $use_yn = $cond['use_yn'];
    $role_id = $cond['role_id'];

    $where = '1=1';
    if($use_yn != ''){
        $where .= " and use_yn = '".$use_yn."'";
    }
    if($role_id != ''){
        $where .= " and role_id = '".$role_id."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY role_id, role_ordr ASC) AS row_num,  role_inf.* ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'role_inf.role_id',
    ];
    $result = getListRoleInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    $response = $result;

    return $response;
}


?>