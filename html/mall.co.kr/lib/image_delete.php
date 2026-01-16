<?php
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/img_inf_dao.php");

    $db = new database();

    $img_id = $_POST['img_id'] ?? '';

    error_log("aa1 :".$_POST['img_id']);
    error_log("aa2 :".$img_id);

    $params = [
        'where' => "img_id = ".$img_id
    ];

    //정보조회
    $res = getImgInf($params);

    $fileData['path']  = $res['img_path'];

    // 실물 파일 삭제
    $result = delete_file($fileData);

    // DB 데이터 삭제
    if ($result['result'] === true) {
        $params1['img_id'] = $img_id;
        $params1['user_id'] = $mallUserId;
        $res = deleteImgInf($params1);
	    $msg = " 파일이 정상적으로 삭제 되었습니다.";
    } else {
        $res = false;
	    $msg = " 파일삭제를 실패 하였습니다.";
    }

    $db->close();

    if ($res) {
        print('{"result":true, "msg":"'.$msg.'"}');
    } else {
        print('{"result":false, "msg":"'.$msg.'"}');
    }

?>
