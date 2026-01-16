<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/pgm_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['pgm_id'] = (isset($_POST['pgm_id']) === true ? $_POST['pgm_id'] : '');

    if (empty($params['pgm_id'])) {
        print('{"result":false, "msg":"프로그램ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['upper_pgm_id'] = (isset($_POST['upper_pgm_id']) === true ? $_POST['upper_pgm_id'] : '');
    $params['pgm_ordr'] = (isset($_POST['pgm_ordr']) === true ? $_POST['pgm_ordr'] : '');
    $params['pgm_nm'] = (isset($_POST['pgm_nm']) === true ? $_POST['pgm_nm'] : '');
    $params['pgm_url'] = (isset($_POST['pgm_url']) === true ? $_POST['pgm_url'] : '');
    $params['pgm_ty_cd'] = (isset($_POST['pgm_ty_cd']) === true ? $_POST['pgm_ty_cd'] : '');
    $params['etc_meta_1'] = (isset($_POST['etc_meta_1']) === true ? $_POST['etc_meta_1'] : '');
    $params['etc_meta_2'] = (isset($_POST['etc_meta_2']) === true ? $_POST['etc_meta_2'] : '');
    $params['use_yn'] = (isset($_POST['use_yn']) === true ? $_POST['use_yn'] : '');

    $updateSql  = "  upper_pgm_id = '".$params['upper_pgm_id']."'";
    $updateSql .= ", pgm_ordr = '".$params['pgm_ordr']."'";
    $updateSql .= ", pgm_nm = '".$params['pgm_nm']."'";
    $updateSql .= ", pgm_url = '".$params['pgm_url']."'";
    $updateSql .= ", pgm_ty_cd = '".$params['pgm_ty_cd']."'";
    $updateSql .= ", etc_meta_1 = '".$params['etc_meta_1']."'";
    $updateSql .= ", etc_meta_2 = '".$params['etc_meta_2']."'";
    $updateSql .= ", use_yn = '".$params['use_yn']."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "pgm_id ='".$params['pgm_id']."'",
        'set' => $updateSql
    ];

    $result = updatePgmInf($params1);

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
