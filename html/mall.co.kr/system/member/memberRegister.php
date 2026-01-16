<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['user_id'] = $user_id;
    $params['hospitalNo'] = (isset($_POST['hospitalNo']) === true ? $_POST['hospitalNo'] : '');
    $params['apikey'] = (isset($_POST['apikey']) === true ? $_POST['apikey'] : '');
    $params['hospitalname'] = (isset($_POST['hospitalname']) === true ? $_POST['hospitalname'] : '');
    $params['zipcode'] = (isset($_POST['zipcode']) === true ? $_POST['zipcode'] : '');
    $params['addr'] = (isset($_POST['addr']) === true ? $_POST['addr'] : 0);
    $params['tel'] = (isset($_POST['tel']) === true ? $_POST['tel'] : 0);
    $params['broker_ty_cd'] = (isset($_POST['broker_ty_cd']) === true ? $_POST['broker_ty_cd'] : 0);
    $params['img1_id'] = (int)(isset($_POST['img1_id']) === true ? $_POST['img1_id'] : '');


    $result = setMemberInf($params);

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
