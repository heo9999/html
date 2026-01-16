<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 프로그램별권한 테이블
const ROLE_PGM_TBL = 'role_pgm';

/**
 * 프로그램별권한 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getRolePgm(array $params)
{
    global $db;
    $response = [];

    $table = ROLE_PGM_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 프로그램별권한 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListRolePgm(array $params)
{
    global $db;
    $response = [];

    $table = ROLE_PGM_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 프로그램별권한 데이터 저장
 *
 * @param array
 * @return bool
 */
function setRolePgm(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = ROLE_PGM_TBL;
    $sql = 'INSERT INTO '.$table.' (pgm_id, role_id, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['pgm_id'].'", "'.$params['role_id'].'", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['pgm_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 프로그램별권한 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateRolePgm(array $params)
{
    global $db;
    $response = [];

    $pgm_id = $params['pgm_id'] ?? '';
    $role_id = $params['role_id'] ?? '';

    $table = ROLE_PGM_TBL;
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
 * 프로그램별권한 삭제
 *
 * @param array 프로그램별권한 정보
 * @return bool
 */
function deleteRolePgm(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $pgm_id = $params['pgm_id'] ?? '';
    $role_id = $params['role_id'] ?? '';

    $table = ROLE_PGM_TBL;
    $sql = "DELETE FROM ".$table." WHERE pgm_id = '".$pgm_id."'"." and role_id = '".$role_id."'";

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
 * 프로그램별권한 목록 상세 데이터 조회
 * @return array
 */
function getListRolePgmWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $pgm_id = $cond['pgm_id'];
    $role_id = $cond['role_id'];

    $where = '1=1';
    if($pgm_id != ''){
        $where .= " and pgm_id = '".$pgm_id."'";
    }
    if($role_id != ''){
        $where .= " and role_id = '".$role_id."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY pgm_id, role_id ASC) AS row_num,  role_pgm.* ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'role_pgm.pgm_id, role_pgm.role_id',
    ];
    $result = getListRolePgm($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    $response = $result;

    return $response;
}



?>