
$(document).ready(function () {
   // $("#logoff").hide();

  
    // $('#loginSubmit').click(function () {
     
    //     let body = {username:$('#username').val(),password:$('#password').val()};//{ username: "auttapon", password: "tonstory" };
    //     console.log(body);
    //     if (body.username && body.password) {
    //         $.post("./User/login", body, (resp) => {
    //             let decodeJSON = JSON.parse(resp);
    //             let { status } = decodeJSON;
    //             console.log(decodeJSON)
    //             if (status) {
    //                 $.dreamAlert({
    //                     'type'      :   'success',
    //                     'message'   :   'Login Success',
    //                     'position'  :   'right'
    //                  });
    //                 createLogIn();
    //                 $("#logout").show();
    //                 $("#login").hide();
    //             } else {
    //                 $.dreamAlert({
    //                     'type'      :   'error',
    //                     'message'   :    decodeJSON.errorMessage,
    //                     'position'  :   'right'
    //                  });
               
    //             }
    //         })
    //     }
    // });

   
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

 
  // forgetPassword : when user click link forgetpassword
  $("#forgetPassword").click(function () {
    $("#informationUserLogin").empty();
    $("#forgetPassword").hide();
    $("#backTOLogin").show();
    $("#informationUserLogin").append(`
                                     <div class="form-group">
                                         <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="username" placeholder="E-mail" required="required">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" id="OTPLinkResetPass" class="btn btn-primary btn-block btn-lg"  >ยืนยันการขอเปลี่ยนรหัส</button>
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


 
//createFormLogin
$.fn.createFormLogin = function () {
    $("#informationUserLogin").empty();
    $("#forgetPassword").show();
    $("#backTOLogin").hide();
    $("#informationUserLogin").append(`<div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" id="username" placeholder="Username" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" class="form-control" id="password" placeholder="Password" required="required">
                                            </div>
                                        </div>
                                        <button type="button" id="loginSubmit" class="btn btn-primary btn-block btn-lg" onclick = "handleLogin()" >Sign In</button>
                                       
                                             
                                     `
   );
}

    



    


});

function linkToUrl(url){
 
    location.href = url;
 }
 

function handleLogin(){
   
    let body = {username:$('#username').val(),password:$('#password').val()};//{ username: "auttapon", password: "tonstory" };
        console.log(body);
        if (body.username && body.password) {
            console.log("TTT")
            $.post("./User/login", body, (resp) => {
                let decodeJSON = JSON.parse(resp);
                let { status } = decodeJSON;
                console.log(decodeJSON)
                if (status) {
                    $.dreamAlert({
                        'type'      :   'success',
                        'message'   :   'Login Success',
                        'position'  :   'right'
                     });
                    createLogIn();
                    $("#logout").show();
                    $("#login").hide();
                    $('#loginModal').modal('hide');
                } else {
                    $.dreamAlert({
                        'type'      :   'error',
                        'message'   :    decodeJSON.errorMessage,
                        'position'  :   'right'
                     });
               
                }
            })
        }
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