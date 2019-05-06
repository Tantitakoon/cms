
$(document).ready(function () { 
     $("#logout").click(function () {
        $.post("./User/logout", {}, (resp) => {

            let decodeJSON = resp;
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

 
  // forgetPassword : when user click link forgetpassword
  $("#forgetPassword").click(function () {
    $("#informationUserLogin").empty();
    $("#forgetPassword").hide();
    $("#backTOLogin").show();
    $("#informationUserLogin").append(`
                                     <div class="form-group">
                                         <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" id="emailUser" placeholder="E-mail" required="required">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" id="OTPLinkResetPass" class="btn btn-primary btn-block btn-lg"  onclick = "handleResetPassword()"  >ยืนยันการขอเปลี่ยนรหัส</button>
                                      </div>
                                      
                                      `
    );

});


$("#login").click(function () {
    $.fn.createFormLogin()
});


$("#backTOLogin").click(function () {
    $.fn.createFormLogin()
});

$.fn.loginSubmit = function () {
        let body = { username: $('#username').val(), password: $('#password').val() };//{ username: "auttapon", password: "tonstory" };
      //  console.log(body);
        if (body.username && body.password) {
            $.post("./User/login", body, (resp) => {
                let decodeJSON = resp;
                let { status } = decodeJSON;
                if (status) {
                    $.dreamAlert({
                        'type': 'success',
                        'message': 'Login Success',
                        'position': 'right'
                    });
                    $('#loginModal').modal('toggle');
                    createLogIn();
                    $("#logout").show();
                    $("#login").hide();
                } else {
                    $.dreamAlert({
                        'type': 'error',
                        'message': decodeJSON.errorMessage,
                        'position': 'right'
                    });

                }
            })
        }
    }

 
});

  //createFormLogin
  $.fn.createFormLogin = function () {
    $("#informationUserLogin").empty();
    $("#forgetPassword").show();
    $("#backTOLogin").hide();
    $("#informationUserLogin").append(`<div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="loginSubmit" onclick=" $.fn.loginSubmit()" class="btn btn-primary btn-block btn-lg">Sign In</button>
                                        </div>
                                             
                                      `
    );



}


function linkToUrl(url){
 
    location.href = url;
 }
 
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


function handleResetPassword(){
    let emailUser =  $('#emailUser').val()
    if(emailUser){
        $.post("./User/resetPassword",{email:emailUser},(resp)=>{
         //   console.log(resp)
            let decodeJSON = resp;
            let {status} = decodeJSON;
            if(status){
                $.dreamAlert({
                    'type': 'success',
                    'message': 'Send Email Success',
                    'position': 'right'
                });
                $('#loginModal').modal('toggle');
            }else{
                $.dreamAlert({
                    'type': 'error',
                    'message': 'Error',
                    'position': 'right'
                });
            }
        })
    }else{
        $.dreamAlert({
            'type': 'error',
            'message': 'Fill Email !!',
            'position': 'right'
        });
    }
}


