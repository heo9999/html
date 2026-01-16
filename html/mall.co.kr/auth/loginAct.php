<?
    //header('Content-type: application/json');

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

	if(isset($_COOKIE['mallUserId'])){
		print('{"result":false,"msg":"이미 로그인 되었습니다.\n새로고침 해 주세요."}');
		exit;
	}

    // 입력 데이터 수신
	$user_id = addslashes($_POST['UserId']);
	$pwd = md5($_POST['UserPwd']);

	$db = new database();

    $params = [
        'user_id' => $user_id,
        'pwd' => $pwd
    ];
    $login_info = getLoginWithUserID($params);

	if(empty($login_info)){
		print('{"result":false,"msg":"아이디 또는 비밀번호가 올바르지 않습니다."}');
        $db->close();
        exit;
	}else{
        $mallUserId = $login_info['user_id'];
        $mallUserRole = $login_info['role_id'];
        $mallApikey = $login_info['apikey'];

		//로그인 시간 기록
        $params1 = [
            'user_id' => $mallUserId,
            'set' => "last_login_success_dttm = now(), pwd_fail_ct = 0, login_ct = login_ct + 1 ",
            'where' => "user_id = '".$mallUserId."'",
        ];

        $result = updateUserInf($params1);

        if ($result) {
            if (empty($result['error'])) {
                $autoLogin = false;

                //쿠키 유효기간 설정
                //자동 로그인의 경우 24시간 동안 로그인 유지
                $expire = $autoLogin ? time()+60*60*24 : 0;

                $hash = md5($mallUserId.$mallApikey);

                //쿠키 등록
                setcookie("mallUserId", $mallUserId, $expire, "/");
                setcookie("mallUserRole", $mallUserRole, $expire, "/"); //권한정보
                setcookie("hash", $hash, $expire, "/");

                print('{"result":true, "msg":"정상처리했습니다."}');
            } else {
                print('{"result":false, "msg":"'.$result['error'].'"}');
            }
        } else {
            print('{"result":false, "msg":"로그인에 실패하였습니다."}');
        }
	}

	$db->close();
?>
