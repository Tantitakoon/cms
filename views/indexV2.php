<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- css login IndexV2-->
    <link rel="stylesheet" type="text/css" href="./asset/css/indexV2.css">
    <!-- end-->
    <!--dream alert-->
    <script src="./asset/alert/jquery.dreamalert.js" type="text/javascript"></script>
    <link href="./asset/alert/jquery.dreamalert.css" media="screen" rel="stylesheet" type="text/css" /> 
    <!--end -->
  
   
    
</head>
<body>
	<div class="limiter">
    
        <!--div class="container-login100" style="background-image: url('./asset/img/background01.jpg');"-->
        
        <div class="container-login100 animated fadeInDown slower-8s"  >
            
            <a id="backToLogin" href="#"><i  class="backToLogin material-icons">reply</i></a>
            
			<div class="wrap-login100">
                 
				<form class="login100-form validate-form">
              
					<span class="login100-form-logo">
						<img src="./asset/img/index.jpg">
					</span>
                     <div id="contentLogin">
                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100 shadow-sm bg-white rounded" type="text" name="username" id="username" placeholder="Username">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100 shadow-sm bg-white rounded" type="password" name="pass" id="password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                        <!--div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div-->
                    
					<div class="container-login100-form-btn">
                    <button type="button" class="login btn btn-primary btn-lg btn-block" onclick="$.fn.loginSubmit()">เข้าสู่ระบบ</button>
					</div>
					<div class="text-center p-t-90">
						<a class="forgotpassword" onclick="$.fn.forgotpassword()" href="#">
							Forgot Password?
						</a>
                    </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="dropDownSelect1"></div>
	  <!-- JS login IndexV2-->
      <script src="./asset/js/indexV2.js"></script>
        <!-- end-->
</body>
</html>