<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_pgm_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['user_id'] = $user_id;
    $params['pgm_id'] = (isset($_POST['pgm_id']) === true ? $_POST['pgm_id'] : '');
    $params['role_id'] = (isset($_POST['role_id']) === true ? $_POST['role_id'] : '');

    $result = setRolePgm($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"프로그램별권한등록에 실패하였습니다."}');
    }

	$db->close();
?>
