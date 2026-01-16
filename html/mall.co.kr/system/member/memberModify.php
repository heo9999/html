<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['hospitalNo'] = (isset($_POST['hospitalNo']) === true ? $_POST['hospitalNo'] : '');

    if (empty($params['hospitalNo'])) {
        print('{"result":false, "msg":"요양기관ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['apikey'] = (isset($_POST['apikey']) === true ? $_POST['apikey'] : '');
    $params['hospitalname'] = (isset($_POST['hospitalname']) === true ? $_POST['hospitalname'] : '');
    $params['zipcode'] = (isset($_POST['zipcode']) === true ? $_POST['zipcode'] : '');
    $params['addr'] = (isset($_POST['addr']) === true ? $_POST['addr'] : 0);
    $params['tel'] = (isset($_POST['tel']) === true ? $_POST['tel'] : 0);
    $params['broker_ty_cd'] = (isset($_POST['broker_ty_cd']) === true ? $_POST['broker_ty_cd'] : 0);
    $params['img1_id'] = (int)(isset($_POST['img1_id']) === true ? $_POST['img1_id'] : '');


    $updateSql  = "  apikey = '".$params['apikey']."'";
    $updateSql .= ", hospitalname = '".$params['hospitalname']."'";
    $updateSql .= ", zipcode = '".$params['zipcode']."'";
    $updateSql .= ", addr = '".$params['addr']."'";
    $updateSql .= ", tel = '".$params['tel']."'";
    $updateSql .= ", broker_ty_cd = '".$params['broker_ty_cd']."'";
    $updateSql .= ", img1_id = '".$params['img1_id']."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "hospitalNo ='".$params['hospitalNo']."'",
        'set' => $updateSql
    ];

    $result = updateMemberInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"요양기관등록에 실패하였습니다."}');
    }

	$db->close();
?>
