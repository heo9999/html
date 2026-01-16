<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['code_id'] = (isset($_POST['code_id']) === true ? $_POST['code_id'] : '');

    if (empty($params['code_id'])) {
        print('{"result":false, "msg":"코드ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['code_list'] = (isset($_POST['code_list']) === true ? $_POST['code_list'] : '');
    $params['code_kind'] = (isset($_POST['code_kind']) === true ? $_POST['code_kind'] : '');
    $params['code_nm'] = (isset($_POST['code_nm']) === true ? $_POST['code_nm'] : '');
    $params['sort_ordr'] = (isset($_POST['sort_ordr']) === true ? $_POST['sort_ordr'] : '');
    $params['code_desc'] = (isset($_POST['code_desc']) === true ? $_POST['code_desc'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');
    $params['use_yn'] = (isset($_POST['use_yn']) === true ? $_POST['use_yn'] : '');

    $updateSql  = "  code_list = '".$params['code_list']."'";
    $updateSql .= ", code_kind = '".$params['code_kind']."'";
    $updateSql .= ", code_nm = '".$params['code_nm']."'";
    $updateSql .= ", sort_ordr = '".$params['sort_ordr']."'";
    $updateSql .= ", code_desc = '".$params['code_desc']."'";
    $updateSql .= ", etc_meta_1 = '".$params['etc_meta_1']."'";
    $updateSql .= ", etc_meta_2 = '".$params['etc_meta_2']."'";
    $updateSql .= ", use_yn = '".$params['use_yn']."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "code_id ='".$params['code_id']."'",
        'set' => $updateSql
    ];

    $result = updateCodeInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"코드등록에 실패하였습니다."}');
    }

	$db->close();
?>
