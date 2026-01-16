<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['role_id'] = (isset($_POST['role_id']) === true ? $_POST['role_id'] : '');

    if (empty($params['role_id'])) {
        print('{"result":false, "msg":"권한ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['role_nm'] = (isset($_POST['role_nm']) === true ? $_POST['role_nm'] : '');
    $params['role_ordr'] = (isset($_POST['role_ordr']) === true ? $_POST['role_ordr'] : '');
    $params['role_desc'] = (isset($_POST['role_desc']) === true ? $_POST['role_desc'] : '');
    $params['use_yn'] = (isset($_POST['use_yn']) === true ? $_POST['use_yn'] : '');

    $updateSql  = "  role_nm = '".$params['role_nm']."'";
    $updateSql .= ", role_ordr = '".$params['role_ordr']."'";
    $updateSql .= ", role_desc = '".$params['role_desc']."'";
    $updateSql .= ", use_yn = '".$params['use_yn']."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "role_id ='".$params['role_id']."'",
        'set' => $updateSql
    ];

    $result = updateRoleInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"권한수정에 실패하였습니다."}');
    }

	$db->close();
?>
