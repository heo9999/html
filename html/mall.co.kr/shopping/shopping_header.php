<?
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

	$db = new database();

    $role = $mallUserRole;

    //권한으로 기본메뉴 가져오기
    $params = [
        'role' => $role,
    ];
    $pgm_inf = getListPgmWithRole($params);

?>
<!doctype html>
<html lang="ko">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>e2web 쇼핑몰</title>

    <!-- Custom fonts for this template-->
    <link href="<?=$APP_PATH?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=$APP_PATH?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?=$APP_PATH?>vendor/datatables/datatables.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="<?=$APP_PATH?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=$APP_PATH?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$APP_PATH?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- jquery confirm -->
    <link rel="stylesheet" href="<?=$APP_PATH?>vendor/jquery-confirm/css/jquery-confirm.css">
    <script src="<?=$APP_PATH?>vendor/jquery-confirm/js/jquery-confirm.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$APP_PATH?>js/sb-admin-2.min.js"></script>
    <script src="<?=$APP_PATH?>js/e2web.js"></script>
    <script src="<?=$APP_PATH?>js/common.js"></script>
    <script src="<?=$APP_PATH?>js/shopping.js"></script>

    <!-- Page level plugins -->
    <script src="<?=$APP_PATH?>vendor/datatables/datatables.min.js"></script>

</head>
<body id="page-top">

    <!-- login user -->
    <input type="hidden" id= "mallUserId" name="mallUserId" value="<?=$mallUserId ?>">
    <!-- login role -->
    <input type="hidden" id= "mallUserRole" name="mallUserRole" value="<?=$mallUserRole ?>">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?
	include("{$_SERVER['DOCUMENT_ROOT']}/sidebar.php");
?>

            <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

<?
	include("{$_SERVER['DOCUMENT_ROOT']}/topbar.php");

?>