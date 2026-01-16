<?
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

    error_log('hospitalLogin start :');

	//전달받은 데이터
	$hospitalNo = $_REQUEST['hospitalNo'] ?? '';
	$apiKey = $_REQUEST['apiKey'] ?? '';

	if(GET_LOG){
		$filename = LOG_PATH."hospitalLogin_".date("Ymd", time());
		if(defined('HOSTNAME')) $filename.= "_".HOSTNAME;
		$filename.= ".log";

		$msg = chr(13).chr(10)."[".date("Y-m-d H:i:s")." - ".$_SERVER['REMOTE_ADDR']."] {$hospitalNo}".chr(13).chr(10);
		file_put_contents($filename, $msg, FILE_APPEND);
	}

	//md5('아름누리결과지') = 'ec7328884ee1b0c8d961839f4f0e72e7';
	//md5('새롬소프트결과지') = '2423924a32bfbcec19766ac46966d5f0';
	//md5('다인소프트결과지') = 'ed324598f068c209187c0964d06acc26';
	//md5('세나클소프트결과지') = '6f7f56b34a5fface4f31abfead44b954';
	//md5('피어나인결과지') = '273162d92afc9d26b70577facfde6805';
	$apiKeys = array('ec7328884ee1b0c8d961839f4f0e72e7','2423924a32bfbcec19766ac46966d5f0','ed324598f068c209187c0964d06acc26','6f7f56b34a5fface4f31abfead44b954','273162d92afc9d26b70577facfde6805');

	if(!in_array($apiKey, $apiKeys)){
		$msg = 'apiKey 값이 올바르지 않습니다. - '.$apiKey;
		file_put_contents($filename, $msg, FILE_APPEND);

		echo $msg;
		exit;
	}

	$db = new database();

    //로그인 정보 확인
    $params = [
        'hospitalNo' => $hospitalNo,
        'apiKey' => $apiKey,
    ];
    $login_info = getLoginWithhospitalNo($params);

    error_log('3 :');

	if(empty($login_info)){
		echo "등록된 사용자가 아닙니다.";
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
            print('{"result":false, "msg":"상품수정에 실패하였습니다."}');
        }

	}

	$db->close();

    error_log('hospitalLogin end :');
	goto_url("/index.php");
?>