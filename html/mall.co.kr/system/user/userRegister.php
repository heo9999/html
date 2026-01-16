<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $params['user_id'] = (isset($_POST['user_id']) === true ? $_POST['user_id'] : '');
    $params['pwd'] = (isset($_POST['pwd']) === true ? $_POST['pwd'] : '');
    $params['user_nm'] = (isset($_POST['user_nm']) === true ? $_POST['user_nm'] : '');
    $params['hospitalNo'] = (isset($_POST['hospitalNo']) === true ? $_POST['hospitalNo'] : '');
    $params['job_nm'] = (isset($_POST['job_nm']) === true ? $_POST['job_nm'] : '');
    $params['tel'] = (isset($_POST['tel']) === true ? $_POST['tel'] : '');
    $params['email'] = (isset($_POST['email']) === true ? $_POST['email'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');

    $result = setUserInf($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"사용자등록에 실패하였습니다."}');
    }

	$db->close();
?>
