<?php
	include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/common.php");
    include_once("{$_SERVER['DOCUMENT_ROOT']}/lib/img_inf_dao.php");

    $db = new database();

    $upload_max_filesize = ini_parse_quantity(ini_get('upload_max_filesize')); //2M
    $msg = "이미지등록에 실패하였습니다.";
    $res = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = FILES_IMG_PATH;
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageTmp = $_FILES['image']['tmp_name'];
            $imageSize = $_FILES['image']['size'];
            $imgType = explode("/", $_FILES['image']['type']);
            $imageType = $imgType[1];
            $imageName = $_FILES['image']['name'];

            $uploadOk = 1;

            // 이미지 파일인지 확인
            $check = getimagesize($imageTmp);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $msg = "File is not an image";
                $uploadOk = 0;
            }

            // 서버에 설정된 값보다 큰파일을 업로드 한다면
            if($imageSize > $upload_max_filesize){
                $msg = $imageName." 파일의 용량(".$imageSize.")이 서버에 설정(".$upload_max_filesize.")된 값보다 크므로 업로드 할 수 없습니다.";
                $uploadOk = 0;
            }

            // 허용되는 파일 형식 확인
            if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
                $uploadOk = 0;
            }

            // 파일이 이미 존재하는지 확인
            if (file_exists($targetFile)) {
                $msg = "Sorry, file already exists";
                $uploadOk = 0;
            }

            // 파일 업로드 시도
            if ($uploadOk == 1) {
                if(is_uploaded_file($imageTmp)){
                    $dt = date('YmdHis');
                    $fileName = $dt."_".$imageName;
                    $destFile = FILES_IMG_PATH.$fileName;
                    $destReadFile = READ_IMG_PATH.$fileName;

                    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
                    $error_code = move_uploaded_file($imageTmp, $destFile) or die($_FILES['image']['error']);
                }else{
                    $msg = $imageName." 파일이 업로드 되지 않았습니다.";
                }

                // 파일 정보 DB 추가
                $params = [];
                $params['img_path'] = $destReadFile;
                $params['img_ext'] = $imageType;
                $params['img_fnm'] = $fileName;
                $params['img_size'] = $imageSize;
                $params['user_id'] = $mallUserId;

                $res = setImgInf($params);

            } else {
                $res = false;
            }

        }
    }

    $db->close();

    if ($res) {
        print('{"result":true, "img_id":"'.$res['img_id'].'","img_path":"'.$destReadFile.'"}');
    } else {
        print('{"result":false, "msg":"'.$msg.'"}');
    }

?>