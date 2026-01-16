<?
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/member_dao.php");

    $db = new database();

    error_log('checklogin start');
	//단독실행 방지
	if(!defined('__E2MALL__')) exit();

	if(!isset($_COOKIE['mallmemId'])){
		header("Location: /login.php");
		exit;
	}

	$mallmemId = $_COOKIE['mallmemId'] ?? '';
	$mallmemRole = $_COOKIE['mallmemRole'] ?? '';

	if(in_array($mallmemRole, array('A','9'))){
		//아이디 검증
		if(!check_id($mallmemId)){ ?>
			<script>
			alert("해당아이디는 접근 권한이 없습니다.");
			document.location.href="/logout.php";
			</script><?
			exit;
		}

		//관리자 인지 체크
        $params = [
            'where' => "memid = '{$mallmemId}' and Role in ('A','9') and md5(concat(memid, password)) = '{$_COOKIE['hash']}' ",
        ];
        $user = getManager($params,0);
		if(!isset($user)){ ?>
			<script>
			alert("해당아이디는 관리자 접근 권한이 없습니다.");
			document.location.href="/";
			</script><?
			exit;
		}
	}else{
		//apiKey 조회
		$apiKey = getApiKey();

		$chk = md5($mallmemId.$apiKey);

		if($chk != $_COOKIE['hash']){ ?>
			<script>
			alert("해당 API는 접근 권한이 없습니다.");
			document.location.href="/logout.php";
			</script><?
			exit;
		}
	}
    error_log('checklogin end');

?>
