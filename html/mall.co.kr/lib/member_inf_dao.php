<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

// 요양기관 테이블
const MEMBER_INF_TBL = 'member_inf';

/**
 * 요양기관 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getMemberInf(array $params)
{
    global $db;
    $response = [];

    $table = MEMBER_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 요양기관 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListMemberInf(array $params)
{
    global $db;
    $response = [];

    $table = MEMBER_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 요양기관 데이터 저장
 *
 * @param array
 * @return bool
 */
function setMemberInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = MEMBER_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (hospitalNo, apikey, hospitalname, zipcode, addr, tel, ';
    $sql .=' broker_ty_cd, img1_id, use_yn, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['hospitalNo'].'", "'.$params['apikey'].'", "'.$params['hospitalname'].'", "';
    $sql .= $params['zipcode'].'", "'.$params['addr'].'", "'.$params['tel'].'", "';
    $sql .= $params['broker_ty_cd'].'", "'.$params['img1_id'].'", "Y", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['hospitalNo'] = $db->last_id();
    $response['error'] = $db->last_error();

    return $response;
}


/**
 * 요양기관 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateMemberInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = MEMBER_INF_TBL;
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
 * 요양기관 삭제
 *
 * @param array 요양기관 정보
 * @return bool
 */
function deleteMemberInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';
    $hospitalNo = $params['hospitalNo'] ?? '';

    $table = MEMBER_INF_TBL;
    $sql = 'DELETE FROM '.$table.' WHERE hospitalNo = '.$hospitalNo;

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
 * 병원 목록 상세 데이터 조회
 * @return array
 */
function getListMemberInfWithDetail(array $cond)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $use_yn = $cond['use_yn'];
    $hospitalNo = $cond['hospitalNo'];

    $where = '1=1';
    if($use_yn != ''){
        $where .= " and use_yn = '".$use_yn."'";
    }
    if($hospitalNo != ''){
        $where .= " and hospitalNo = '".$hospitalNo."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY hospitalNo ASC) AS row_num,  member_inf.* ';
    $select .= ', (select img_path from img_inf X where X.img_id = member_inf.img1_id) img1_path ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'member_inf.hospitalNo',
    ];
    $result = getListMemberInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 상품명(name)
        $member[$index] = $data;
        $member[$index]['row_num'] = $data['row_num'];
        $member[$index]['hospitalNo'] = $data['hospitalNo'];
        $member[$index]['hospitalname'] = (mb_strlen($data['hospitalname']) > $nameLimitLength ? cutStr($data['hospitalname'], $nameLimitLength).'....' : $data['hospitalname']);

        $params1=[
            'where' => "code_id = '".$data['broker_ty_cd']."' "
        ];
        $broker_ty_cd = getCodeInf($params1);
        $member[$index]['broker_ty_cd'] = $broker_ty_cd['code_nm'];

        $member[$index]['img1_path'] = (empty($data['img1_path']) === true ? PATH_COMMON_RESOURCE.'/no_image.jpg' : $data['img1_path']);
    }
    $response = $member;

    return $response;
}


/**
 * 고객사 목록 페이지 데이터 조회
 * @return array
 */
function getListForMemberInfCode()
{
    // 목록 조회 조건
    $memberinfCondtion = [
        'select'  => "`member_inf`.*",
         'where'  => "`member_inf`.use_yn = 'Y' ",
        'orderby' => "`member_inf`.hospitalname",
    ];
    $result = getListMemberInf($memberinfCondtion);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    foreach ($result as $index => $data) {
        // 번호(id), 고객명(hospitalname), Data 가공
        $member_inf[$index] = $data;
        $member_inf[$index]['hospitalNo'] = $data['hospitalNo'];
        $member_inf[$index]['hospitalname'] = $data['hospitalname'];
        $member_inf[$index]['zipcode'] = $data['zipcode'];
        $member_inf[$index]['addr'] = $data['addr'];
        $member_inf[$index]['tel'] = $data['tel'];
    }
    $response = $member_inf;

    return $response;
}


?>