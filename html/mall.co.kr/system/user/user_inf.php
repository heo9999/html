<?php
    $GLOBAL['appPath'] = "S";
	include_once("{$_SERVER['DOCUMENT_ROOT']}/system/user/user_header.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/user_inf_dao.php");

    $db = new database();

    $params = [
        'use_yn' => '',
        'user_id' => ''
    ];

    $user_inf = getListUserInfWithDetail($params);
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">사용자관리</h1>
                    <!-- DataTales DATA -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">사용자</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" href="/system/user/user_inf_register.php">등록</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/user/user_inf_modify.php','user_id',1);">수정</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="getRowDataToURL('/system/user/user_inf_delete.php','user_id',1);">삭제</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="pwdReset(1);">비밀번호초기화</a>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th>사용자ID</th>
                                            <th scope="col">비밀번호</th>
                                            <th scope="col">비밀번호실패횟수</th>
                                            <th scope="col">마지막비밀번호수정일시</th>
                                            <th scope="col">마지막로그인일시</th>
                                            <th scope="col">로그인횟수</th>
                                            <th scope="col">사용자명</th>
                                            <th scope="col">요양병원NO</th>
                                            <th scope="col">직위명</th>
                                            <th scope="col">전화번호</th>
                                            <th scope="col">이메일</th>
                                            <th scope="col">기타1</th>
                                            <th scope="col">기타2</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>사용자ID</th>
                                            <th scope="col">비밀번호</th>
                                            <th scope="col">비밀번호실패횟수</th>
                                            <th scope="col">마지막비밀번호수정일시</th>
                                            <th scope="col">마지막로그인일시</th>
                                            <th scope="col">로그인횟수</th>
                                            <th scope="col">사용자명</th>
                                            <th scope="col">요양병원NO</th>
                                            <th scope="col">직위명</th>
                                            <th scope="col">전화번호</th>
                                            <th scope="col">이메일</th>
                                            <th scope="col">기타1</th>
                                            <th scope="col">기타2</th>
                                            <th scope="col">사용여부</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?

	if(!$user_inf){
?>
<?
	}else{
		foreach($user_inf as $list){
?>

                                        <tr>
                                            <td></td>
                                            <td><?=$list['user_id']?></td>
                                            <td><?=$list['pwd']?></td>
                                            <td><?=$list['pwd_fail_ct']?></td>
                                            <td><?=$list['last_pwd_upd_dttm']?></td>
                                            <td><?=$list['last_login_success_dttm']?></td>
                                            <td><?=$list['login_ct']?></td>
                                            <td><?=$list['user_nm']?></td>
                                            <td><?=$list['hospitalNo']?></td>
                                            <td><?=$list['job_nm']?></td>
                                            <td><?=$list['tel']?></td>
                                            <td><?=$list['email']?></td>
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