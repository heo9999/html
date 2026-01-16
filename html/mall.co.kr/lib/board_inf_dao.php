<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 게시판 테이블
const BOARD_INF_TBL = 'board_inf';

/**
 * 게시판 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getBoardInf(array $params)
{
    global $db;
    $response = [];

    $table = BOARD_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 게시판 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListBoardInf(array $params)
{
    global $db;
    $response = [];

    $table = BOARD_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 게시판 데이터 저장
 *
 * @param array
 * @return bool
 */
function setBoardInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = BOARD_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (title, board_ctnt, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['title'].'", "'.$params['board_ctnt'].'", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['board_id'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 게시판 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateBoardInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $board_id = $params['board_id'] ?? '';

    $table = BOARD_INF_TBL;
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
 * 게시판 삭제
 *
 * @param array 게시판 정보
 * @return bool
 */
function deleteBoardInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $board_id = $params['board_id'] ?? '';

    $table = BOARD_INF_TBL;
    $sql = "DELETE FROM ".$table." WHERE board_id = '".$board_id."'";

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
 * 게시판 목록 상세 데이터 조회
 * @return array
 */
function getListBoardInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $board_id = $cond['board_id'];

    $where = '1=1';
    if($board_id != ''){
        $where .= " and board_id = '".$board_id."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY board_id ASC) AS row_num,  board_inf.* ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'board_inf.board_id',
    ];
    $result = getListBoardInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 내용(ctnt)
        $board[$index] = $data;
        $board[$index]['row_num'] = $data['row_num'];
        $board[$index]['board_id'] = $data['board_id'];
        $board[$index]['board_ctnt'] = (mb_strlen($data['board_ctnt']) > $descLimitLength ? cutStr(htmlspecialchars_decode($data['board_ctnt']), $descLimitLength).'....' : htmlspecialchars_decode($data['board_ctnt']));
    }
    $response = $board;

    return $response;
}


?>