<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/role/role_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'role_id' => ''
    ];

    $role_inf = getListRoleInfWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">권한관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">권한</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/system/role/role_inf_register.php">등록</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/role/role_inf_modify.php','role_id',1);">수정</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/role/role_inf_delete.php','role_id',1);">삭제</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>권한ID</th>
                                            <th scope="col">권한명</th>
                                            <th scope="col">순서</th>
                                            <th scope="col">설명</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>권한ID</th>
                                            <th scope="col">권한명</th>
                                            <th scope="col">순서</th>
                                            <th scope="col">설명</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$role_inf){
?>
<?
	}else{
		foreach($role_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['role_id']?></td>
                                            <td><?=$list['role_nm']?></td>
                                            <td><?=$list['role_ordr']?></td>
                                            <td><?=$list['role_desc']?></td>
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