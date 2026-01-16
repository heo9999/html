$(function(){
  $("a.btn").on("click", function(event){
    event.preventDefault ? event.preventDefault() : event.returnValue = false;
    switch(this.name){
      case 'btnRegister' :
        if($.trim($("input[name=product_nm]").val()) == ''){
          alert("상품명을 입력해 주세요.");
          return false;
        }
        var category_cd = document.getElementById("category_cd").value;
        if(category_cd == ''){
          alert("분류코드를 입력해 주세요.");
          return false;
        }
        if($.trim($("input[name=product_ctnt]").val()) == ''){
          alert("상품설명을 입력해 주세요.");
          return false;
        }
        if($.trim($("input[name=product_price]").val()) == ''){
          alert("가격을 입력해 주세요.");
          return false;
        }
        if($.trim($("input[name=product_cnt]").val()) == ''){
          alert("수량을 입력해 주세요.");
          return false;
        }
        var product_stat_cd = document.getElementById("product_stat_cd").value;
        if(product_stat_cd == ''){
          alert("상태코드를 입력해 주세요.");
          return false;
        }
        var use_yn = document.getElementById("use_yn").value;
        if(use_yn == ''){
          alert("사용여부를 입력해 주세요.");
          return false;
        }
        if(confirm("상품 등록 하시겠습니까?")){
          let formData = new Object();
          formData['product_nm'] = $("input[name=product_nm]").val();
          formData['category_cd'] = category_cd;
          formData['product_ctnt'] = $("input[name=product_ctnt]").val();
          formData['product_price'] = $("input[name=product_price]").val();
          formData['product_cnt'] = $("input[name=product_cnt]").val();
          formData['sale_price'] = $("input[name=sale_price]").val();
          formData['sale_ratio'] = $("input[name=sale_ratio]").val();
          formData['sale_cnt'] = $("input[name=sale_cnt]").val();
          formData['sale_end_date'] = $("input[name=sale_end_date]").val();
          formData['product_stat_cd'] = product_stat_cd;
          formData['use_yn'] = use_yn;
          formData['img1_id'] = $("#img1_id").val();
          formData['img2_id'] = $("#img2_id").val();
          formData['img3_id'] = $("#img3_id").val();
          formData['img4_id'] = $("#img4_id").val();

          $.post("/shop/product/productRegister.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
                document.location.href="/shop/product/product_inf.php";
              }else{
                alert(resData.msg);
                false;
              }
          }).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
        }
        break;

      case 'btnModify' :
        if($.trim($("input[name=product_nm]").val()) == ''){
          alert("상품명을 입력해 주세요.");
          return false;
        }
        var category_cd = document.getElementById("category_cd").value;
        if(category_cd == ''){
          alert("분류코드를 입력해 주세요.");
          return false;
        }
        if($.trim($("input[name=product_ctnt]").val()) == ''){
          alert("상품설명을 입력해 주세요.");
          return false;
        }
        if($.trim($("input[name=price]").val()) == ''){
          alert("가격을 입력해 주세요.");
          return false;
        }
        if($.trim($("input[name=product_cnt]").val()) == ''){
          alert("수량을 입력해 주세요.");
          return false;
        }
        var product_stat_cd = document.getElementById("product_stat_cd").value;
        if(product_stat_cd == ''){
          alert("상태코드를 입력해 주세요.");
          return false;
        }
        var use_yn = document.getElementById("use_yn").value;
        if(use_yn == ''){
          alert("사용여부를 입력해 주세요.");
          return false;
        }
        if(confirm("상품 수정 하시겠습니까?")){
          let formData = new Object();
          formData['product_id'] = $("input[name=product_id]").val();
          formData['product_nm'] = $("input[name=product_nm]").val();
          formData['category_cd'] = category_cd;
          formData['product_ctnt'] = $("input[name=product_ctnt]").val();
          formData['price'] = $("input[name=price]").val();
          formData['product_cnt'] = $("input[name=product_cnt]").val();
          formData['sale_price'] = $("input[name=sale_price]").val();
          formData['sale_ratio'] = $("input[name=sale_ratio]").val();
          formData['sale_cnt'] = $("input[name=sale_cnt]").val();
          formData['sale_end_date'] = $("input[name=sale_end_date]").val();
          formData['product_stat_cd'] = product_stat_cd;
          formData['use_yn'] = use_yn;
          formData['img1_id'] = $("#img1_id").val();
          formData['img2_id'] = $("#img2_id").val();
          formData['img3_id'] = $("#img3_id").val();
          formData['img4_id'] = $("#img4_id").val();

          $.post("/shop/product/productModify.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
                document.location.href="/shop/product/product_inf.php";
              }else{
                alert(resData.msg);
                return false;
              }
          }).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
        }
        break;

      case 'btnDelete' :
        if(confirm("상품을 삭제 하시겠습니까?")){
          let formData = new Object();
          formData['product_id'] = $("input[name=product_id]").val();
          formData['img1_id'] = $("#img1_id").val();
          formData['img2_id'] = $("#img2_id").val();
          formData['img3_id'] = $("#img3_id").val();
          formData['img4_id'] = $("#img4_id").val();

          $.post("/shop/product/productDelete.php", $.param(formData), function(objData){
              console.log(objData);
              const resData = JSON.parse(objData);
              if(resData.result == true){
                document.location.href="/shop/product/product_inf.php";
              }else{
                alert(resData.msg);
                return false;
              }
          }).fail(function(){ alert("네트워크 연결이 원활하지 않습니다."); });
        }
        break;
      case 'btnPrev' :
        document.location.href="/shop/product/product_inf.php";
        break;
      case 'btnImage1_up' :
        fn_submitUp(1);
        break;
      case 'btnImage2_up' :
        fn_submitUp(2);
        break;
      case 'btnImage3_up' :
        fn_submitUp(3);
        break;
      case 'btnImage4_up' :
        fn_submitUp(4);
        break;
      case 'btnImage1_del' :
        fn_submitDel(1);
        break;
      case 'btnImage2_del' :
        fn_submitDel(2);
        break;
      case 'btnImage3_del' :
        fn_submitDel(3);
        break;
      case 'btnImage4_del' :
        fn_submitDel(4);
        break;

    }
  });


});

