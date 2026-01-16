<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/menu/menu_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/pgm_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'pgm_id' => ''
    ];

    $pgm_inf = getListPgmInfWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">프로그램관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">프로그램</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/system/menu/menu_inf_register.php">등록</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/menu/menu_inf_modify.php','pgm_id',1);">수정</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/menu/menu_inf_delete.php','pgm_id',1);">삭제</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>프로그램ID</th>
                                            <th scope="col">상위프로그램ID</th>
                                            <th scope="col">프로그램순서</th>
                                            <th scope="col">프로그램명</th>
                                            <th scope="col">프로그램URL</th>
                                            <th scope="col">프로그램형태</th>
                                            <th scope="col">기타1</th>
                                            <th scope="col">기타2</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>프로그램ID</th>
                                            <th scope="col">상위프로그램ID</th>
                                            <th scope="col">프로그램순서</th>
                                            <th scope="col">프로그램명</th>
                                            <th scope="col">프로그램URL</th>
                                            <th scope="col">프로그램형태</th>
                                            <th scope="col">기타1</th>
                                            <th scope="col">기타2</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$pgm_inf){
?>
<?
	}else{
		foreach($pgm_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['pgm_id']?></td>
                                            <td><?=$list['upper_pgm_id']?></td>
                                            <td><?=$list['pgm_ordr']?></td>
                                            <td><?=$list['pgm_nm']?></td>
                                            <td><?=$list['pgm_url']?></td>
                                            <td><?=$list['pgm_ty_cd']?></td>
                                            <td><?=$list['etc_meta_1']?></td>
                                            <td><?=$list['etc_meta_2']?></td>
                                            <td><?=$list['use_yn']?></td>
                                        </tr>
<?
		}
	}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


<?
	include("{$_SERVER['DOCUMENT_ROOT']}/footer.php");
?>