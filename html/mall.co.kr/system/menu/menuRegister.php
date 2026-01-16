<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/pgm_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['user_id'] = $user_id;
    $params['pgm_id'] = (isset($_POST['pgm_id']) === true ? $_POST['pgm_id'] : '');
    $params['upper_pgm_id'] = (isset($_POST['upper_pgm_id']) === true ? $_POST['upper_pgm_id'] : '');
    $params['pgm_ordr'] = (isset($_POST['pgm_ordr']) === true ? $_POST['pgm_ordr'] : '');
    $params['pgm_nm'] = (isset($_POST['pgm_nm']) === true ? $_POST['pgm_nm'] : '');
    $params['pgm_url'] = (isset($_POST['pgm_url']) === true ? $_POST['pgm_url'] : '');
    $params['pgm_ty_cd'] = (isset($_POST['pgm_ty_cd']) === true ? $_POST['pgm_ty_cd'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');

    $result = setPgmInf($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"프로그램등록에 실패하였습니다."}');
    }

	$db->close();
?>
