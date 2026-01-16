<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/board/board_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/board_inf_dao.php");

    $db = new database();

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">게시판정보를 등록합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-user" id="title" name="title"
                                            placeholder="제목">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-user" id="board_ctnt" name="board_ctnt"
                                            placeholder="내용">
                                    </div>
                                </div>
                            </form>
                        <div class="row">
                        </div>
                                <div class="form-group">
                                </div>

                                <a href="#" name="btnRegister" class="btn btn-primary btn-user btn-block">
                                    게시판등록
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