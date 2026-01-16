<?
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

    $db = new database();

    error_log('environment start');

	//단독실행 방지
	if(!defined('__E2MALL__')) exit();

    $appPath = $GLOBAL['appPath'] ?? '';

    //path
    if ($appPath == 'A') { //admin
        $APP_PATH = "../";
    } else if ($appPath == 'S') { //shopping mall
        $APP_PATH = "../../";
    } else {
        $APP_PATH = "";
    }

    //사용자ID
    if(isset($_COOKIE['mallUserId'])){
		$mallUserId = $_COOKIE['mallUserId'] ?? 'GUEST';
	}
    else{
        $mallUserId = 'GUEST';
    }

    //사용자Role

    //접근권한 체크
    if(isset($_COOKIE['mallUserRole'])){
        $params = [
            'user_id' => $mallUserId
        ];
        $current_info = getCurrentRole($params);
        if ($current_info['role_id'] == $_COOKIE['mallUserRole']) {
            $mallUserRole = $current_info['role_id'];
        } else {
            $mallUserRole = 'ROLE_GUEST';
        }
	}
    else{
        $mallUserRole = 'ROLE_GUEST';
    }

    error_log('mallUserId :'.$mallUserId.' mallUserRole :'.$mallUserRole);
?>
