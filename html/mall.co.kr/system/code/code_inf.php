<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/code/code_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'code_id' => ''
    ];

    $code_inf = getListCodeInfWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">코드관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">코드</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/system/code/code_inf_register.php">등록</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/code/code_inf_modify.php','code_id',1);">수정</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/code/code_inf_delete.php','code_id',1);">삭제</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>코드ID</th>
                                            <th scope="col">코드값</th>
                                            <th scope="col">코드종류</th>
                                            <th scope="col">코드명</th>
                                            <th scope="col">순서</th>
                                            <th scope="col">설명</th>
                                            <th scope="col">기타1</th>
                                            <th scope="col">기타2</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>코드ID</th>
                                            <th scope="col">코드값</th>
                                            <th scope="col">코드종류</th>
                                            <th scope="col">코드명</th>
                                            <th scope="col">순서</th>
                                            <th scope="col">설명</th>
                                            <th scope="col">기타1</th>
                                            <th scope="col">기타2</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$code_inf){
?>
<?
	}else{
		foreach($code_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['code_id']?></td>
                                            <td><?=$list['code_list']?></td>
                                            <td><?=$list['code_kind']?></td>
                                            <td><?=$list['code_nm']?></td>
                                            <td><?=$list['sort_ordr']?></td>
                                            <td><?=$list['code_desc']?></td>
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