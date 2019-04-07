
$(document).ready(function () {
   // $("#logoff").hide();

  
    $('#loginSubmit').click(function () {
        let body = {username:$('#username').val(),password:$('#password').val()};//{ username: "auttapon", password: "tonstory" };
        console.log(body);
        if (body.username && body.password) {
            $.post("./User/login", body, (resp) => {
                let decodeJSON = JSON.parse(resp);
                let { status } = decodeJSON;
                if (status) {
                    $.dreamAlert({
                        'type'      :   'success',
                        'message'   :   'Login Success',
                        'position'  :   'right'
                     });
                    createLogIn();
                    $("#logout").show();
                    $("#login").hide();
                } else {
                    $.dreamAlert({
                        'type'      :   'error',
                        'message'   :    decodeJSON.errorMessage,
                        'position'  :   'right'
                     });
               
                }
            })
        }
    });
     $("#logout").click(function () {
        $.post("./User/logout", {}, (resp) => {
            let decodeJSON = JSON.parse(resp);
            let { status } = decodeJSON;
            if (status) {
                $.dreamAlert({
                    'type'      :   'success',
                    'message'   :    decodeJSON.message,
                    'position'  :   'right'
                 });
                $("#userLoginAlready").empty();
                $("#logout").hide();
                $("#login").show();
            } else {
                $.dreamAlert({
                    'type'      :   'error',
                    'message'   :    decodeJSON.message,
                    'position'  :   'right'
                 });
           
            }
        })
    
      
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
                <button type="button" class="btn btn-dark" onclick="linkToUrl('handleBatchSystem')">การจัดการระบบ Batch</button>
            </div>
        </div>
         <div class="row justify-content-md-center" style="padding-top: 15px;" >
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark"  onclick="linkToUrl('listProcessBatch')">รายงานการทำงานระบบ Batch</button>
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
