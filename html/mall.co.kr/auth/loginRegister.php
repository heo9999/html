<?
    //header('Content-type: application/json');

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/role_user_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = (isset($_POST['UserId']) === true ? $_POST['UserId'] : '');

    if($user_id){
		print('{"result":false,"msg":"아이디가 올바르지 않습니다."}');
		exit;
	}
    $params['user_id'] = $user_id;
    $params['user_nm'] = (isset($_POST['UserName']) === true ? $_POST['UserName'] : '');
    $params['email'] = (isset($_POST['Email']) === true ? $_POST['Email'] : '');
    $params['tel'] = (isset($_POST['tel']) === true ? $_POST['tel'] : '');
    $params['hospitalNo'] = (isset($_POST['hospitalNo']) === true ? $_POST['hospitalNo'] : '');
    $tmpPwd = (isset($_POST['InputPassword']) === true ? $_POST['InputPassword'] : '');
    $params['pwd'] = md5($tmpPwd);

    $params['job_nm'] = (isset($_POST['job_nm']) === true ? $_POST['job_nm'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');

    $result = setUserInf($params);

    if ($result) {
        if (empty($result['error'])) {
            //권한
            $params1['role_id'] = 'ROLE_USER';
            $params1['user_id'] = $user_id;
            $result1 = setRoleUser($params1);

            if ($result) {
                if (empty($result['error'])) {
                    print('{"result":true, "msg":"정상처리했습니다."}');
                } else {
                    print('{"result":false, "msg":"'.$result['error'].'"}');
                }
            } else {
                print('{"result":false, "msg":"프로그램별권한등록에 실패하였습니다."}');
            }
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"사용자등록에 실패하였습니다."}');
    }

	$db->close();

?>
