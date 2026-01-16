//화면내 버튼 접근권한 체크
//체크하고픈 권한보다 같거나 높으면 true 낮으면 false
function checkRole(CHKRole)
{
	var UserRole = $("#mallUserRole").val();
	console.log(CHKRole+":"+UserRole);
	//ROLE_GUEST > ROLE_USER > ROLE_ADMIN
	switch (CHKRole)
	{
	case 'ROLE_GUEST':
		console.log('GUEST');
		return true;
		break;
	case 'ROLE_USER':
		if (UserRole == 'ROLE_GUEST')
		{
			console.log('USER_GUEST');
			return false;
		} else {
			return true;
		}
		break;
	case 'ROLE_ADMIN':
		if (UserRole == 'ROLE_GUEST' || UserRole == 'ROLE_USER')
		{
			console.log('ADMIN_GUEST_USER');
			return false;
		} else {
			return true;
		}
		break;
	default:
		return false;
		break;
	}

}

//dataTable 컬럼접근함수
function getRowDataToURL(url, val, key)
{
    var table = $('#dataTable').DataTable();
    if (table.row('.selected').selected()) {
        console.log('Row is selected');
        var rVal = table.row('.selected').data();
        if (url != "")
        {
            var ids = $.map(table.rows('.selected').data(), function (item) {
                return item[key];
            });
            console.log(rVal);
            var retUrl = url + '?'+val+"="+ids;
						console.log(retUrl);
						document.location.href=retUrl;
        }
    }
    else {
        console.log('Row is not selected');
        alert("데이터를 선택해야 합니다.");
    }
}

//dataTable 컬럼접근함수2
function getRowDataToURL2(url, val, key, val2, key2)
{
    var table = $('#dataTable').DataTable();
    if (table.row('.selected').selected()) {
        console.log('Row is selected');
        var rVal = table.row('.selected').data();
        if (url != "")
        {
            var ids = $.map(table.rows('.selected').data(), function (item) {
                return item[key];
            });
            var ids2 = $.map(table.rows('.selected').data(), function (item) {
                return item[key2];
            });
            console.log(rVal);
            var retUrl = url + '?'+val+"="+ids+"&"+val2+"="+ids2;
						console.log(retUrl);
						document.location.href=retUrl;
        }
    }
    else {
        console.log('Row is not selected');
        alert("데이터를 선택해야 합니다.");
    }
}

/**
 * Convert FormData to a JSON object, supporting array fields.
 * Example: field[] -> array
 */
function formDataToJson(formData) {
    const json = {};

    for (const [key, value] of formData.entries()) {
        // Detect array-like keys (e.g., "items[]")
        if (key.endsWith("[]")) {
            const cleanKey = key.slice(0, -2);
            if (!Array.isArray(json[cleanKey])) {
                json[cleanKey] = [];
            }
            json[cleanKey].push(value);
        }
        // Handle repeated keys (non [] syntax)
        else if (json.hasOwnProperty(key)) {
            if (!Array.isArray(json[key])) {
                json[key] = [json[key]];
            }
            json[key].push(value);
        }
        // Normal key-value
        else {
            json[key] = value;
        }
    }

    return json;
}

/*
*  이미지 업로드
*/
function fn_submitUp(param){
    var form = new FormData();
    switch (param) {
        case 1:
            if ($("#image1").val() == '')
            {
                alert("이미지를 선택하세요.");
                return false;
            }
            form.append("image", $("#image1")[0].files[0]);
            break;
        case 2:
            if ($("#image2").val() == '')
            {
                alert("이미지를 선택하세요.");
                return false;
            }
            form.append("image", $("#image2")[0].files[0]);
            break;
        case 3:
            if ($("#image3").val() == '')
            {
                alert("이미지를 선택하세요.");
                return false;
            }
            form.append("image", $("#image3")[0].files[0]);
            break;
        case 4:
            if ($("#image4").val() == '')
            {
                alert("이미지를 선택하세요.");
                return false;
            }
            form.append("image", $("#image4")[0].files[0]);
            break;
        default:
    }

    $.ajax({
        url : "/lib/image_upload.php", // 파일을 업로드할 서버 URL
        type : "POST",
        processData : false,
        contentType : false,
        data : form,
        success:function(objData) {
            console.log(objData);
            const resData = JSON.parse(objData);
            if(resData.result == true){
                alert("이미지 등록에 성공했습니다.");
                switch (param)
                {
                    case 1:
                        $("#preViewImage1").attr("src", resData.img_path);
                        $("#img1_id").val(resData.img_id);
                        break;
                    case 2:
                        $("#preViewImage2").attr("src", resData.img_path);
                        $("#img2_id").val(resData.img_id);
                        break;
                    case 3:
                        $("#preViewImage3").attr("src", resData.img_path);
                        $("#img3_id").val(resData.img_id);
                        $("#image3").val("");
                        break;
                    case 4:
                        $("#preViewImage4").attr("src", resData.img_path);
                        $("#img4_id").val(resData.img_id);
                        break;
                }
            }else{
                alert(resData.msg);
                return false;
            }
        },
        error: function (objData) {
            alert("네트워크 연결이 원활하지 않습니다.");
        }
    });
}


/*
*  이미지 다운로드
*/
function fn_submitDel(param){
    var form = new FormData();
    switch (param) {
        case 1:
            if ($("#img1_id").val() == '')
            {
                alert("등록된 이미지가 없습니다.");
                return false;
            }
            form.append("img_id", $("#img1_id").val());
            break;
        case 2:
            if ($("#img2_id").val() == '')
            {
                alert("등록된 이미지가 없습니다.");
                return false;
            }
            form.append("img_id", $("#img2_id").val());
            break;
        case 3:
            if ($("#img3_id").val() == '')
            {
                alert("등록된 이미지가 없습니다.");
                return false;
            }
            form.append("img_id", $("#img3_id").val());
            break;
        case 4:
            if ($("#img4_id").val() == '')
            {
                alert("등록된 이미지가 없습니다.");
                return false;
            }
            form.append("img_id", $("#img4_id").val());
            break;
        default:
    }

    $.ajax({
        url : "/lib/image_delete.php", // 파일을 삭제할 서버 URL
        type : "POST",
        processData : false,
        contentType : false,
        data : form,
        success:function(objData) {
            console.log(objData);
            const resData = JSON.parse(objData);
            if(resData.result == true){
                alert("이미지 삭제에 성공했습니다.");
                switch (param)
                {
                    case 1:
                        $("#preViewImage1").attr("src", "");
                        $("#img1_id").val("");
                        break;
                    case 2:
                        $("#preViewImage2").attr("src", "");
                        $("#img2_id").val("");
                        break;
                    case 3:
                        $("#preViewImage3").attr("src", "");
                        $("#img3_id").val("");
                        break;
                    case 4:
                        $("#preViewImage4").attr("src", "");
                        $("#img4_id").val("");
                        break;
                }
            }else{
                alert(resData.msg);
                return false;
            }
        },
        error: function (objData) {
            alert("네트워크 연결이 원활하지 않습니다.");
        }
    });
}

// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#frmData input').attr('readonly', 'readonly');
    $('#frmData select').attr("disabled", true);

		$('#dataTable').DataTable( {
			columnDefs: [
					{
							orderable: false,
							className: 'select-checkbox',
							targets: 0
					}
			],
			select: {
					style: 'os',
					selector: 'td:first-child'
			},
			order: [[1, 'asc']],
			lengthMenu: [30, 50, 100, -1]
		});

});
