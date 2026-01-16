<?
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");

	$expire = time()-60*60*24;

	//쿠키 삭제
	setcookie("mallUserId", "", $expire, "/");
	setcookie("mallUserRole", "", $expire, "/");
	setcookie("hash", "", $expire, "/");
    setcookie("hospitalNo", "", $expire, "/");

	header("Location: /index.php");
?>