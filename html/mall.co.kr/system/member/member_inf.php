<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/member/member_header.php");
	include("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'hospitalNo' => ''
    ];

    $member_inf = getListMemberInfWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">요양기관관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">요양기관</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/system/member/member_inf_register.php">등록</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/member/member_inf_modify.php','hospitalNo',1);">수정</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/member/member_inf_delete.php','hospitalNo',1);">삭제</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>요양기관번호</th>
                                            <th scope="col" style="display: none;">Api키</th>
                                            <th scope="col">기관명</th>
                                            <th scope="col">우편번호</th>
                                            <th scope="col">전화번호</th>
                                            <th scope="col">중계기관</th>
                                            <th scope="col">사인</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>요양기관번호</th>
                                            <th scope="col" style="display: none;">Api키</th>
                                            <th scope="col">기관명</th>
                                            <th scope="col">우편번호</th>
                                            <th scope="col">전화번호</th>
                                            <th scope="col">중계기관</th>
                                            <th scope="col">사인</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$member_inf){
?>
<?
	}else{
		foreach($member_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['hospitalNo']?></td>
                                            <td style="display: none;"><?=$list['apikey']?></td>
                                            <td><?=$list['hospitalname']?></td>
                                            <td><?=$list['zipcode']?></td>
                                            <td><?=$list['tel']?></td>
                                            <td><?=$list['broker_ty_cd']?></td>
                                            <td><img src=<?=$list['img1_path']?> width=50 height=50></td>
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