<?

    // DOMAIN
    define('DOMAIN', "{$_SERVER['DOCUMENT_ROOT']}");
    // 공용 resource 폴더
    define('PATH_COMMON_RESOURCE', '/image');
    //이미지 저장 폴더
    define('FILES_IMG_PATH', DOMAIN."/files/image/");
    //이미지 조회 폴더
    define('READ_IMG_PATH', "/files/image/");
    //파일 폴더 - 파일저장은 full path
	define('FILES_PATH', DOMAIN.'/files');
    //log 폴더 - 파일저장은 full path
    define('LOG_PATH', DOMAIN."/files/log/");

?>
