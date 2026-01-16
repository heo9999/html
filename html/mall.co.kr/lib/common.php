<?
    // 세션의 파기 시간을 5시간으로 하고 세션 저장 경로를 files/session 으로 변경
    if(!ini_get('session.auto_start')) {
        session_cache_limiter('no-cache, must-revalidate');
        ini_set("session.cookie_domain", $_SERVER['HTTP_HOST']);
        ini_set("session.gc_maxlifetime", "18000");

        if(is_dir("{$_SERVER['DOCUMENT_ROOT']}/files/sessions")) session_save_path("{$_SERVER['DOCUMENT_ROOT']}/files/sessions");
        session_start();

    }
    define('GET_LOG', true);

    if (!defined('__E2MALL__')) {
        list($hostname,$x,$x) = explode('.',$_SERVER['HTTP_HOST']);

        if($hostname == 'dev-data'){
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
        }
        define('__E2MALL__', $hostname);
    }

    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/config.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/database.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/functions.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/environment.php");

?>
