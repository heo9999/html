<?php
    $GLOBAL['appPath'] = "S";
	include("{$_SERVER['DOCUMENT_ROOT']}/system/member/member_header.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/member_inf_dao.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/code_inf_dao.php");

    $db = new database();

    $params=[
        'where' => "code_kind = 'apikey' "
    ];
    $codeList = getListCodeInf($params);

    $params1=[
        'where' => "code_kind = 'broker_ty_cd' "
    ];
    $codeList1 = getListCodeInf($params1);

    $hospitalNo = (isset($_GET['hospitalNo']) === true ? $_GET['hospitalNo'] : '');
    error_log("aaa".$hospitalNo);
    $params2 = [
        'use_yn' => '',
        'hospitalNo' => $hospitalNo
    ];

    $member_inf = getListMemberInfWithDetail($params2);

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row row-cols-1">

                                <div class="p-5">
                                <div class="col">


                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-6">요양기관을 수정합니다.</h1>
                            </div>
                            <form name="frmData" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="hospitalNo" name="hospitalNo" value="<?=$member_inf[0]['hospitalNo']?>" readonly
                                            placeholder="요양기관No">
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="apikey" name="apikey"
                                            placeholder="분류코드">
                                            <label>API</label>
                                        <?php foreach ($codeList as $value): ?>
                                            <option value="<?= htmlspecialchars($value['etc_meta_1']) ?>"? placeholder="분류코드"
                                            <?php if( $value['etc_meta_1'] == $member_inf[0]['apikey'] ): ?> selected="selected"<?php endif; ?>
                                            >
                                            <?= htmlspecialchars($value['code_nm']) ?>:<?= htmlspecialchars($value['etc_meta_1']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="hospitalname" name="hospitalname" value="<?=$member_inf[0]['hospitalname']?>"
                                            placeholder="요양기관명">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="zipcode" name="zipcode" value="<?=$member_inf[0]['zipcode']?>"
                                            placeholder="우편번호">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="addr" name="addr" value="<?=$member_inf[0]['addr']?>"
                                            placeholder="주소">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="tel" name="tel" value="<?=$member_inf[0]['tel']?>"
                                            placeholder="전화번호">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="custom-select" id="broker_ty_cd" name="broker_ty_cd"
                                            placeholder="중개기관">
                                        <?php foreach ($codeList1 as $value1): ?>
                                            <option value="<?= htmlspecialchars($value1['code_id']) ?>"? placeholder="중개기관"
                                            <?php if( $value1['code_id'] == $member_inf[0]['broker_ty_cd'] ): ?> selected="selected"<?php endif; ?>
                                            >
                                            <?= htmlspecialchars($value1['code_nm']) ?>:<?= htmlspecialchars($value1['code_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="custom-select" id="use_yn" name="use_yn"
                                            placeholder="사용여부">
                                            <option value="Y" <?php if( 'Y' == $member_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>Y</option>
                                            <option value="N" <?php if( 'N' == $member_inf[0]['use_yn'] ): ?> selected="selected"<?php endif; ?>>N</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                </div>
                            </form>
                        <div class="row">
                        <div class="col-lg-6">

                            <!-- Image Upload1 -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <input type="file" id="image1" name="image" accept="image/*" required class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-xs font-weight text-primary text-uppercase mb-1">사인</a>
                                </div>
                                <div class="card-body">
                                    <a href="#" name="btnImage1_up" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="#" name="btnImage1_del" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <img id="preViewImage1" src="<?=$member_inf[0]['img1_path']?>" class="img-thumbnail">
                                    <input type="hidden" value="<?=$member_inf[0]['img1_id']?>" id="img1_id">
                                </div>
                            </div>

                        </div>
                        </div>
                                <div class="form-group">
                                </div>

                                <a href="#" name="btnModify" class="btn btn-primary btn-user btn-block">
                                    요양기관수정
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