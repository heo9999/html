<?
    //header('Content-type: application/json');

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = (isset($_POST['UserId']) === true ? $_POST['UserId'] : '');

    error_log('user id :'.$user_id);
    if(!check_id($user_id)){
		print('{"result":false,"msg":"아이디가 올바르지 않습니다."}');
		exit;
	}
    $params['user_id'] = $user_id;

    $result = setUserPassword($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"사용자비밀번호 초기화에 실패하였습니다."}');
    }

	$db->close();
?>
