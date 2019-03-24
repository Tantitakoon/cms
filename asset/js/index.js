
$(document).ready(function () {
    $("#logoff").hide();
    
  
     $("#loginSubmit").click(function () {
        createLogIn();
        $("#logoff").show();
        $("#login").hide();
    });

     $("#logoff").click(function () {
        $("#userLoginAlready").empty();
        $("#logoff").hide();
        $("#login").show();
     });

    

    function createLogIn() {
        var bodyLogin = document.createElement("div");
        bodyLogin.innerHTML = `<div class="row justify-content-md-center" >
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark">การจัดการ File สำรวจ</button>
            </div>
        </div>
         <div class="row justify-content-md-center"  style="padding-top: 15px;" >
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark" onclick="linkToUrl('./view/handleBatchSystem.html')">การจัดการระบบ Batch</button>
            </div>
        </div>
         <div class="row justify-content-md-center" style="padding-top: 15px;" >
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark"  onclick="linkToUrl('./view/listProcessBatch.html')">รายงานการทำงานระบบ Batch</button>
            </div>
        </div>
         <div class="row justify-content-md-center" style="padding-top: 15px;" >
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark" onclick="linkToUrl('./resource/templates/adminManage/HTML/index.html')">การจัดการเนื้อหา</button>
            </div>
        </div>
         <div class="row justify-content-md-center" style="padding-top: 15px;" >
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark" onclick="linkToUrl('./resource/templates/adminManage/HTML/index.html')">จัดการผู้ใช้งานระบบ</button>
            </div>
        </div>
        <hr>`
        $("#userLoginAlready").append(bodyLogin);
    }

  


});

function linkToUrl(url){
    location.href = url;
 }
