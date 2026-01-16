<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 이미지 테이블
const IMG_INF_TBL = 'img_inf';

/**
 * 이미지 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getImgInf(array $params)
{
    global $db;
    $response = [];

    $table = IMG_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 이미지 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListImgInf(array $params)
{
    global $db;
    $response = [];

    $table = IMG_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 이미지 데이터 저장
 *
 * @param array
 * @return bool
 */
function setImgInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = IMG_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (img_fnm, img_ext, img_size, img_path, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['img_fnm'].'", "'.$params['img_ext'].'", "'.$params['img_size'].'", "';
    $sql .= $params['img_path'].'", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['img_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 이미지 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateImgInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = IMG_INF_TBL;
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
 * 이미지 삭제
 *
 * @param array 이미지 정보
 * @return bool
 */
function deleteImgInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $img_id = $params['img_id'] ?? '';

    $table = IMG_INF_TBL;
    $sql = 'DELETE FROM '.$table.' WHERE img_id = '.$img_id;

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


?>