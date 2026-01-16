<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/board_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['board_id'] = (isset($_POST['board_id']) === true ? $_POST['board_id'] : '');

    if (empty($params['board_id'])) {
        print('{"result":false, "msg":"게시판ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['title'] = (isset($_POST['title']) === true ? $_POST['title'] : '');
    $params['board_ctnt'] = (isset($_POST['board_ctnt']) === true ? $_POST['board_ctnt'] : '');

    $updateSql  = "  title = '".$params['title']."'";
    $updateSql .= ", board_ctnt = '".$params['board_ctnt']."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "board_id ='".$params['board_id']."'",
        'set' => $updateSql
    ];

    $result = updateBoardInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"게시판수정에 실패하였습니다."}');
    }

	$db->close();
?>
