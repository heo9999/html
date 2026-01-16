<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/role_pgm/role_pgm_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/role_pgm_dao.php");

    $db = new database();

    $params = [
        'pgm_id' => '',
        'role_id' => ''
    ];

    $role_pgm = getListRolePgmWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">프로그램별권한관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">프로그램별권한</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/system/role_pgm/role_pgm_register.php">등록</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL2('/system/role_pgm/role_pgm_delete.php','pgm_id',1,'role_id',2);">삭제</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">프로그램ID</th>
                                            <th scope="col">권한ID</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">프로그램ID</th>
                                            <th scope="col">권한ID</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$role_pgm){
?>
<?
	}else{
		foreach($role_pgm as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['pgm_id']?></td>
                                            <td><?=$list['role_id']?></td>
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