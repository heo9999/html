<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['user_id'] = $user_id;
    $params['code_id'] = (isset($_POST['code_id']) === true ? $_POST['code_id'] : '');
    $params['code_list'] = (isset($_POST['code_list']) === true ? $_POST['code_list'] : '');
    $params['code_kind'] = (isset($_POST['code_kind']) === true ? $_POST['code_kind'] : '');
    $params['code_nm'] = (isset($_POST['code_nm']) === true ? $_POST['code_nm'] : '');
    $params['sort_ordr'] = (isset($_POST['sort_ordr']) === true ? $_POST['sort_ordr'] : '');
    $params['code_desc'] = (isset($_POST['code_desc']) === true ? $_POST['code_desc'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');

    $result = setCodeInf($params);

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
