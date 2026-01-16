<?php
    $GLOBAL['appPath'] = "S";
	include_once("{$_SERVER['DOCUMENT_ROOT']}/board/board_header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/board_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'board_id' => ''
    ];

    $board_inf = getListBoardInfWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">게시판</h1>
<?

	if(!$board_inf){
?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl col-md-6 mb-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                제목</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">내용</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?
	}else{
		foreach($board_inf as $list){
?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl col-md-6 mb-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <input type="hidden" value="<?=$list['board_id']?>">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <?=$list['title']?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$list['board_ctnt']?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?
		}
	}
?>


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>