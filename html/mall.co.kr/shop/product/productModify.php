<?
    //header('Content-type: application/json');

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/product_inf_dao.php");

	$db = new database();

    // 입력 데이터 수신
    $user_id = $mallUserId;
    $params['product_id'] = (isset($_POST['product_id']) === true ? $_POST['product_id'] : '');

    if (empty($params['product_id'])) {
        print('{"result":false, "msg":"상품ID가 없습니다."}');
        $db->close();
        exit;
    }

    $params['product_nm'] = (isset($_POST['product_nm']) === true ? $_POST['product_nm'] : '');
    $params['category_cd'] = (isset($_POST['category_cd']) === true ? $_POST['category_cd'] : '');
    $params['product_ctnt'] = (isset($_POST['product_ctnt']) === true ? $_POST['product_ctnt'] : '');
    $params['product_price'] = (float)(isset($_POST['product_price']) === true ? $_POST['product_price'] : 0);
    $params['product_cnt'] = (float)(isset($_POST['product_cnt']) === true ? $_POST['product_cnt'] : 0);
    $params['sale_price'] = (float)(isset($_POST['sale_price']) === true ? $_POST['sale_price'] : 0);
    $params['sale_ratio'] = (float)(isset($_POST['sale_ratio']) === true ? $_POST['sale_ratio'] : 0);
    $params['sale_cnt'] = (float)(isset($_POST['sale_cnt']) === true ? $_POST['sale_cnt'] : 0);
    $params['sale_end_date'] = (isset($_POST['sale_end_date']) === true ? $_POST['sale_end_date'] : '');
    $params['product_stat_cd'] = (isset($_POST['product_stat_cd']) === true ? $_POST['product_stat_cd'] : '');
    $params['img1_id'] = (int)(isset($_POST['img1_id']) === true ? $_POST['img1_id'] : '');
    $params['img2_id'] = (int)(isset($_POST['img2_id']) === true ? $_POST['img2_id'] : '');
    $params['img3_id'] = (int)(isset($_POST['img3_id']) === true ? $_POST['img3_id'] : '');
    $params['img4_id'] = (int)(isset($_POST['img4_id']) === true ? $_POST['img4_id'] : '');


    $updateSql  = "  product_nm = '".$params['product_nm']."'";
    $updateSql .= ", category_cd = '".$params['category_cd']."'";
    $updateSql .= ", product_ctnt = '".$params['product_ctnt']."'";
    $updateSql .= ", product_price = '".$params['product_price']."'";
    $updateSql .= ", product_cnt = '".$params['product_cnt']."'";
    $updateSql .= ", sale_price = '".$params['sale_price']."'";
    $updateSql .= ", sale_ratio = '".$params['sale_ratio']."'";
    $updateSql .= ", sale_cnt = '".$params['sale_cnt']."'";
    $updateSql .= ", sale_end_date = '".$params['sale_end_date']."'";
    $updateSql .= ", product_stat_cd = '".$params['product_stat_cd']."'";
    $updateSql .= ", img1_id = '".$params['img1_id']."'";
    $updateSql .= ", img2_id = '".$params['img2_id']."'";
    $updateSql .= ", img3_id = '".$params['img3_id']."'";
    $updateSql .= ", img4_id = '".$params['img4_id']."'";
    $params1 = [
        'user_id' => $user_id,
        'where' => "product_id ='".$params['product_id']."'",
        'set' => $updateSql
    ];

    $result = updateProductInf($params1);

    if ($result) {
        if (empty($result['error'])) {
            print('{"result":true, "msg":"정상처리했습니다."}');
        } else {
            print('{"result":false, "msg":"'.$result['error'].'"}');
        }
    } else {
        print('{"result":false, "msg":"상품수정에 실패하였습니다."}');
    }

	$db->close();
?>
