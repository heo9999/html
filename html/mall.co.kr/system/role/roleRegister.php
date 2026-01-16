<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['user_id'] = $user_id;
    $params['role_id'] = (isset($_POST['role_id']) === true ? $_POST['role_id'] : '');
    $params['role_nm'] = (isset($_POST['role_nm']) === true ? $_POST['role_nm'] : '');
    $params['role_ordr'] = (isset($_POST['role_ordr']) === true ? $_POST['role_ordr'] : '');
    $params['role_desc'] = (isset($_POST['role_desc']) === true ? $_POST['role_desc'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');

    $result = setRoleInf($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"권한등록에 실패하였습니다."}');
    }

	$db->close();
?>
