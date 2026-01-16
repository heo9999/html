<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_user_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $params['user_id'] = (isset($_POST['user_id']) === true ? $_POST['user_id'] : '');
    $params['role_id'] = (isset($_POST['role_id']) === true ? $_POST['role_id'] : '');

    $result = setRoleUser($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"사용자별권한등록에 실패하였습니다."}');
    }

	$db->close();
?>
