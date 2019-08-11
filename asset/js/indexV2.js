$(document).ready(function () {
    $("#backToLogin").hide()
 
    $("#backToLogin").click(function () {
        $.fn.createFormLogin()

    });




    $.fn.createFormLogin = function () {
        $("#backToLogin").hide()
        $("#contentLogin").empty();
        $("#contentLogin").append(`
        <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input class="input100" type="text" name="username" id="username" placeholder="Username">
                <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
                <input class="input100" type="password" name="pass" id="password"  placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                            Remember me
                 </label>
        </div>
        <div class="container-login100-form-btn">
                <button type="button" class="login btn btn-primary btn-lg btn-block"  onclick="$.fn.loginSubmit()">เข้าสู่ระบบ</button>
        </div>

        <div class="text-center p-t-90">
                        <a class="forgotpassword" onclick="$.fn.forgotpassword()" href="#">
                            Forgot Password?
                       </a>
        </div>
        `);
    }

    
    $.fn.forgotpassword = function () {
        $("#backToLogin").show();
        $("#contentLogin").empty();
        $("#contentLogin").append(` <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                      <input class="input100" type="text" name="username" id = "emailUser" placeholder="Email">
                                      <span class="focus-input100" data-placeholder="&#xf207;"></span>
                                    </div>
                                    <div class="container-login100-form-btn">
                                       <button type="button" class="login btn btn-primary btn-lg btn-block" onclick="$.fn.handleResetPassword()" >ยืนยันขอเปลี่ยนรหัสผ่าน</button>
                                    </div>  
                                    `)

    }

    $.fn.loginSubmit = function () {
        let body = { username: $('#username').val(), password: $('#password').val() };
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
                    setTimeout(function(){
                        window.location.replace("/cms/allPage");
                    }, 500);
                   
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

    $.fn.handleResetPassword = function(){
        let emailUser =  $('#emailUser').val()
        console.log(emailUser)
        if(emailUser){
            $.post("./User/resetPassword",{email:emailUser},(resp)=>{
                let decodeJSON = resp;
                let {status} = decodeJSON;
                if(status){
                    $.dreamAlert({
                        'type': 'success',
                        'message': 'Send Email Success',
                        'position': 'right'
                    });
                    window.location.href = '/cms/';
                  //  $('#loginModal').modal('toggle');
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



  
});