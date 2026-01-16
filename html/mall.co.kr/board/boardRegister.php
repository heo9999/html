<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/board_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['user_id'] = $user_id;
    $params['title'] = (isset($_POST['title']) === true ? $_POST['title'] : '');
    $params['board_ctnt'] = (isset($_POST['board_ctnt']) === true ? $_POST['board_ctnt'] : '');

    $result = setBoardInf($params);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"게시판등록에 실패하였습니다."}');
    }

	$db->close();
?>
