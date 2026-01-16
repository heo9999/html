<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/board/board_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/board_inf_dao.php");

    $db = new database();

    $board_id = (isset($_GET['board_id']) === true ? $_GET['board_id'] : '');
    error_log("aaa".$board_id);
    $params2 = [
        'use_yn' => '',
        'board_id' => $board_id
    ];

    $board_inf = getListBoardInfWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">게시판을 수정합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="hidden" id="board_id" name="board_id" value="<?=$board_inf[0]['board_id']?>" >
                                        <input type="text" class="form-control form-control-user" id="title" name="title" value="<?=$board_inf[0]['title']?>" readonly placeholder="제목">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-user" id="board_ctnt" name="board_ctnt" value="<?=$board_inf[0]['board_ctnt']?>" readonly placeholder="내용">
                                    </div>
                                </div>
                                <div class="form-group">
                                </div>
                            </form>
                        <div class="row">
                        </div>
                                <div class="form-group">
                                </div>

                                <a href="#" name="btnDelete" class="btn btn-primary btn-user btn-block">
                                    게시판삭제
                                </a>
                                <a href="#" name="btnPrev" class="btn btn-info btn-user btn-block">
                                    이전화면
                                </a>
                                <hr>


                                </div>
                                <!-- col -->
                                </div>
                                <!-- p5 -->
                    </div>
                    <!-- Content Row -->

<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>