<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

// 프로그램 테이블
const PGM_INF_TBL = 'pgm_inf';

/**
 * 프로그램 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getPgmInf(array $params)
{
    global $db;
    $response = [];

    $table = PGM_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 프로그램 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListPgmInf(array $params)
{
    global $db;
    $response = [];

    $table = PGM_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 프로그램 데이터 저장
 *
 * @param array
 * @return bool
 */
function setPgmInf(array $params)
{
    global $db;
    $response = [];

    $pgm_id = $params['pgm_id'] ?? '';

    $table = PGM_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (pgm_id, upper_pgm_id, pgm_ordr, pgm_nm, pgm_url, ';
    $sql .=' pgm_ty_cd, etc_meta_1, etc_meta_2, use_yn, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['pgm_id'].'", "'.$params['upper_pgm_id'].'", "'.$params['pgm_ordr'].'", "';
    $sql .= $params['pgm_nm'].'", "'.$params['pgm_url'].'", "'.$params['pgm_ty_cd'].'", "';
    $sql .= $params['etc_meta_1'].'", "'.$params['etc_meta_2'].'", "Y", "';
    $sql .= $pgm_id.'", "'.$pgm_id.'")';

    $response['result'] = $db->query($sql);
    $response['pgm_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 프로그램 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updatePgmInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $pgm_id = $params['pgm_id'] ?? '';

    $table = PGM_INF_TBL;
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
 * 프로그램 삭제
 *
 * @param array 프로그램 정보
 * @return bool
 */
function deletePgmInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $pgm_id = $params['pgm_id'] ?? '';

    $table = PGM_INF_TBL;
    $sql = "DELETE FROM ".$table." WHERE pgm_id = '".$pgm_id."'";

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
 * 프로그램 목록 상세 데이터 조회
 * @return array
 */
function getListPgmInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $use_yn = $cond['use_yn'];
    $pgm_id = $cond['pgm_id'];

    $where = '1=1';
    if($use_yn != ''){
        $where .= " and use_yn = '".$use_yn."'";
    }
    if($pgm_id != ''){
        $where .= " and pgm_id = '".$pgm_id."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY pgm_id, pgm_ordr ASC) AS row_num,  pgm_inf.* ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'pgm_inf.pgm_id',
    ];
    $result = getListPgmInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 상품명(name), 가격(pgm_price)
        $pgm[$index] = $data;
        $pgm[$index]['row_num'] = $data['row_num'];
        $pgm[$index]['pgm_id'] = $data['pgm_id'];
        $pgm[$index]['pgm_nm'] = (mb_strlen($data['pgm_nm']) > $nameLimitLength ? cutStr($data['pgm_nm'], $nameLimitLength).'....' : $data['pgm_nm']);
        $pgm[$index]['pgm_url'] = (mb_strlen($data['pgm_url']) > $descLimitLength ? cutStr(htmlspecialchars_decode($data['pgm_url']), $descLimitLength).'....' : htmlspecialchars_decode($data['pgm_url']));

        $params1=[
            'where' => "code_id = '".$data['pgm_ty_cd']."' "
        ];
        $pgm_ty_cd = getCodeInf($params1);
        $pgm[$index]['pgm_ty_cd'] = $pgm_ty_cd['code_nm'];

    }
    $response = $pgm;

    return $response;
}


?>