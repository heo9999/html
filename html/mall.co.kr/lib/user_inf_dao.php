<?
include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

// 사용자 테이블
const USER_INF_TBL = 'user_inf';

/**
 * 사용자 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getUserInf(array $params)
{
    global $db;
    $response = [];

    $table = USER_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 사용자 데이터 조회
 *
 * @param array $params 조회 조건
 * @return array
 */
function getListUserInf(array $params)
{
    global $db;
    $response = [];

    $table = USER_INF_TBL;
    $sql = queryBuilder($table, $params);

    $response = $db->fetch_array($sql);

    return $response;
}


/**
 * 사용자 데이터 저장
 *
 * @param array
 * @return bool
 */
function setUserInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    //암호화
    $pwd = md5($params['pwd']);

    $table = USER_INF_TBL;
    $sql = 'INSERT INTO '.$table.' (user_id, pwd, user_nm, hospitalNo, job_nm, ';
    $sql .= 'tel, email, etc_meta_1, etc_meta_2, use_yn, ';
    $sql .=' reg_id, mod_id) VALUES ("';
    $sql .= $params['user_id'].'", "'.$pwd.'", "'.$params['user_nm'].'", "';
    $sql .= $params['hospitalNo'].'", "'.$params['job_nm'].'", "'.$params['tel'].'", "';
    $sql .= $params['email'].'", "'.$params['etc_meta_1'].'", "'.$params['etc_meta_2'].'", "Y", "';
    $sql .= $user_id.'", "'.$user_id.'")';

    $response['result'] = $db->query($sql);
    $response['user_id'] = $db->last_id();

    if (!empty($db->last_error())) {
        error_log("last error ".$db->last_error());
        $response['result'] = false;
        $response['user_id'] = $db->last_error();
    }

    return $response;
}


/**
 * 사용자 데이터 갱신
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function updateUserInf(array $params)
{
    global $db;
    $response = [];
    $user_id = $params['user_id'] ?? '';

    $table = USER_INF_TBL;
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
 * 사용자 삭제
 *
 * @param array 사용자 정보
 * @return bool
 */
function deleteUserInf(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $table = USER_INF_TBL;
    $sql = "DELETE FROM ".$table." WHERE user_id = '".$user_id."'";

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
 * 권한별 프로그램메뉴 가져오기
 *
 * @param array $params 갱신 조건
 * @return array
 */
function getListPgmWithRole(array $params)
{
    global $db;
    $response = false;

    $role = $params['role'] ?? '';

    $sql = "";
    $sql .= " with recursive cte as (";
	$sql .=	"  select a.*";
	$sql .=	"  from pgm_inf a";
	$sql .=	"  where 1=1";
	$sql .=	"  and a.use_yn = 'y'";
	$sql .=	"  and a.upper_pgm_id = 'MENU000000'";
	$sql .=	"  union all";
	$sql .=	"  select a.*";
	$sql .=	"  from pgm_inf a, cte b";
	$sql .=	"  where a.upper_pgm_id = b.pgm_id";
	$sql .=	" )";
	$sql .=	" select d.*";
	$sql .=	" from role_inf b, role_pgm c, pgm_inf d, cte x";
	$sql .=	" where b.role_id = '".$role."'";
	$sql .=	" and b.role_id = c.role_id";
	$sql .=	" and d.pgm_id = c.pgm_id";
	$sql .=	" and d.use_yn = 'y'";
	$sql .=	" and x.pgm_id = d.pgm_id";
	$sql .=	" order by pgm_ordr ";

    $result = $db->fetch_array($sql);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    //데이타 매핑
    foreach ($result as $index => $data) {
        $user_inf[$index] = $data;
        $user_inf[$index]['pgm_id'] = $data['pgm_id'];
        $user_inf[$index]['upper_pgm_id'] = $data['upper_pgm_id'];
        $user_inf[$index]['pgm_ordr'] = $data['pgm_ordr'];
        $user_inf[$index]['pgm_nm'] = $data['pgm_nm'];
        $user_inf[$index]['pgm_url'] = $data['pgm_url'];
    }
    $response = $user_inf;

    return $response;
}

/**
 * 사용자 비밀번호 초기화 저장
 *
 * @param array
 * @return bool
 */
function setUserPassword(array $params)
{
    global $db;

    $response = [];
    $userId = $params['user_id'];

    $pwd = md5("1234");
    $params = [
        'set' => "pwd = '{$pwd}', last_pwd_upd_dttm= now(), pwd_fail_ct = 0, mod_id = '{$userId}' ",
        'where' => "user_id = '{$userId}' ",
    ];

    $response = updateUserInf($params);

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
 * 사용자 주문자 정보및 배송지 정보 가져오기
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function getOrderInfoWithUser(array $params)
{
    global $db;
    $response = [];

    $user_id = $params['user_id'] ?? '';

    $sql = "";
    $sql .= " select a.user_id";
	$sql .= "  ,a.user_nm";
	$sql .= "  ,a.hospitalNo";
	$sql .= "  ,a.tel";
	$sql .= "  ,a.email";
	$sql .= "  ,b.zipcode";
	$sql .= "  ,b.addr";
	$sql .= "  ,a.reg_id";
	$sql .= "  ,a.reg_dttm";
	$sql .= "  ,a.mod_id";
	$sql .= "  ,a.mod_dttm";
    $sql .= " from user_inf a, member_inf b";
    $sql .= " where a.user_id = '".$user_id."'";
    $sql .= " and a.hospitalNo = b.hospitalNo";

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 사용자 목록 상세 데이터 조회
 * @return array
 */
function getListUserInfWithDetail(array $params)
{
    global $db;
    $result = [];
    $response = [];

    //문자열 길이
    $nameLimitLength = 100;
    $descLimitLength = 100;

    // 목록 조회 조건
    $use_yn = $params['use_yn'];
    $user_id = $params['user_id'];

error_log('xxx :'.$user_id);

    $where = '1=1';
    if($use_yn != ''){
        $where .= " and use_yn = '".$use_yn."'";
    }
    if($user_id != ''){
        $where .= " and user_id = '".$user_id."'";
    }

    // 목록 조회
    $select ='ROW_NUMBER() OVER(ORDER BY user_id ASC) AS row_num,  user_inf.* ';

    $params = [
        'select'  => $select,
        'where'   => $where,
        'orderby' => 'user_inf.user_id',
    ];
    $result = getListUserInf($params);

    if (empty($result) || count($result) < 1) {
        $response = 0;
        return $response;
    }

    $response = $result;

    return $response;
}


/**
 * 관리자 로그인시 권한및 정보 가져오기
 *
 * @param array $params 갱신 조건
 * @return bool
 */
function getLoginWithUserID(array $params)
{
    global $db;
    $response = [];
    $user_id = $params['user_id'] ?? '';
    $pwd = $params['pwd'] ?? '';

    $sql = "";
    $sql .= " select a.user_id";
	$sql .= "  ,a.user_nm";
	$sql .= "  ,a.hospitalNo";
	$sql .= "  ,a.job_nm";
	$sql .= "  ,a.tel";
	$sql .= "  ,a.email";
	$sql .= "  ,a.pwd";
	$sql .= "  ,a.pwd_fail_ct";
	$sql .= "  ,a.last_pwd_upd_dttm";
	$sql .= "  ,a.last_login_success_dttm";
	$sql .= "  ,a.login_ct";
	$sql .= "  ,a.reg_id";
	$sql .= "  ,a.reg_dttm";
	$sql .= "  ,a.mod_id";
	$sql .= "  ,a.mod_dttm";
	$sql .= "  ,b.apikey";
	$sql .= "  ,c.role_id";
    $sql .= " from user_inf a, member_inf b, role_user c";
    $sql .= " where a.user_id = '".$user_id."'";
    $sql .= " and a.pwd = '".$pwd."'";
    $sql .= " and a.hospitalNo = b.hospitalNo";
    $sql .= " and a.user_id = c.user_id";
    $sql .= " and coalesce(a.use_yn, 'Y') = 'Y' ";

    $response = $db->fetch_one($sql);

    return $response;
}


/**
 * 요양기관 로그인시 권한및 정보 가져오기
 * @return array
 */
function getLoginWithhospitalNo(array $params)
{
    global $db;
    $response = [];

    // 목록 조회 조건
    $user_id = $params['hospitalNo'];
    $apiKey = $params['apiKey'];

error_log('xxx :'.$user_id);

    $sql = "";
    $sql .= " select a.user_id";
	$sql .= "  ,a.user_nm";
	$sql .= "  ,a.hospitalNo";
	$sql .= "  ,a.job_nm";
	$sql .= "  ,a.tel";
	$sql .= "  ,a.email";
	$sql .= "  ,a.pwd";
	$sql .= "  ,a.pwd_fail_ct";
	$sql .= "  ,a.last_pwd_upd_dttm";
	$sql .= "  ,a.last_login_success_dttm";
	$sql .= "  ,a.login_ct";
	$sql .= "  ,a.reg_id";
	$sql .= "  ,a.reg_dttm";
	$sql .= "  ,a.mod_id";
	$sql .= "  ,a.mod_dttm";
	$sql .= "  ,b.apikey";
	$sql .= "  ,c.role_id";
    $sql .= " from user_inf a, member_inf b, role_user c";
    $sql .= " where a.user_id = '".$user_id."'";
    $sql .= " and b.apikey = '".$apiKey."'";
    $sql .= " and a.hospitalNo = b.hospitalNo";
    $sql .= " and a.user_id = c.user_id";
    $sql .= " and coalesce(a.use_yn, 'Y') = 'Y' ";

    $response = $db->fetch_one($sql);

    return $response;
}

/**
 * 정상적인 권한이 있는지 권한정보 가져오기
 * @return array
 */
function getCurrentRole(array $params)
{
    global $db;
    $response = [];

    // 목록 조회 조건
    $user_id = $params['user_id'];

error_log('xxx :'.$user_id);

    $sql = "";
    $sql .= " select a.user_id";
	$sql .= "  ,a.user_nm";
	$sql .= "  ,a.hospitalNo";
	$sql .= "  ,a.job_nm";
	$sql .= "  ,a.tel";
	$sql .= "  ,a.email";
	$sql .= "  ,a.pwd";
	$sql .= "  ,a.pwd_fail_ct";
	$sql .= "  ,a.last_pwd_upd_dttm";
	$sql .= "  ,a.last_login_success_dttm";
	$sql .= "  ,a.login_ct";
	$sql .= "  ,a.reg_id";
	$sql .= "  ,a.reg_dttm";
	$sql .= "  ,a.mod_id";
	$sql .= "  ,a.mod_dttm";
	$sql .= "  ,c.role_id";
    $sql .= " from user_inf a, role_user c";
    $sql .= " where a.user_id = '".$user_id."'";
    $sql .= " and a.user_id = c.user_id";
    $sql .= " and coalesce(a.use_yn, 'Y') = 'Y' ";

    $response = $db->fetch_one($sql);

    return $response;
}

?>