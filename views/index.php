
<html>
 
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./asset/css/index.css">
    <script src="./asset/js/index.js"></script>

    <script src="./asset/alert/jquery.dreamalert.js" type="text/javascript"></script>
    <link href="./asset/alert/jquery.dreamalert.css" media="screen" rel="stylesheet" type="text/css" />
    <script>

        function show_code(obj) {
            $(obj).parent().next().slideDown();
        }

       
    </script>


</head>

<body>


  
    <div class="container">
        <div class="row justify-content-md-center" style="padding-top: 15px;">
            <img src="./asset/img/index.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="row justify-content-md-center" style="padding-top: 25px;">
            <h1>HAll Online Post Processing System </h1>
        </div>
        <div class="row justify-content-md-center" style="padding-top: 25px;">
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark">แผนที่ OrbitGT</button>
            </div>
        </div>
        <div class="row justify-content-md-center" style="padding-top: 15px;">
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark" onclick="linkToUrl('./downLoadWork')">Download Program การใช้งาน</button>
            </div>
        </div>
        <hr>
    </div>
 

    <div class="container" id="userLoginAlready">
        <?php
           
         
            if(isset($_SESSION['login'])){
           echo '<div class="row justify-content-md-center" >
                <div class="col-md-auto">
                    <button type="button" class="btn btn-dark">การจัดการ File สำรวจ</button>
                </div>
            </div>
             <div class="row justify-content-md-center"  style="padding-top: 15px;" >
                <div class="col-md-auto">
                    <button type="button" class="btn btn-dark" onclick="linkToUrl('.'handleBatchSystem'.')">การจัดการระบบ Batch</button>
                </div>
            </div>
             <div class="row justify-content-md-center" style="padding-top: 15px;" >
                <div class="col-md-auto">
                    <button type="button" class="btn btn-dark"  onclick="linkToUrl('.'listProcessBatch'.')">รายงานการทำงานระบบ Batch</button>
                </div>
            </div>
             <div class="row justify-content-md-center" style="padding-top: 15px;" >
                <div class="col-md-auto">
                    <button type="button" class="btn btn-dark" onclick="linkToUrl('.'./resource/templates/adminManage/HTML/index.html'.')">การจัดการเนื้อหา</button>
                </div>
            </div>
             <div class="row justify-content-md-center" style="padding-top: 15px;" >
                <div class="col-md-auto">
                    <button type="button" class="btn btn-dark" onclick="linkToUrl('.'./resource/templates/adminManage/HTML/index.html'.')">จัดการผู้ใช้งานระบบ</button>
                </div>
            </div>
            <hr>';
            }
        ?>
        
    </div>




    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <button type="button" class="btn btn-dark " onclick="linkToUrl('./contact')">ติดต่อเจ้าหน้าที่</button>
            </div>
        </div>
        <?php
           $state = (isset($_SESSION['login']))?["login"=>"none","logout"=>"show"]:["login"=>"show","logout"=>"none"];
     
            echo '<div class="row justify-content-md-center"  style="padding-top: 15px;">
                <div class="col-md-auto">
                    <button type="button" id="logout" class="btn btn-dark" style="display:'.$state['logout'].'">Logout ออกจากระบบ</button>
                </div>
            </div>';
           
            echo '<div class="row justify-content-md-center" >
                <div class="col-md-auto">
                    <button type="button" id="login" class="btn btn-dark" data-toggle="modal" data-target="#loginModal" style="display:'.$state['login'].'">Login เข้าสู่ระบบ</button>
                </div>
            </div>';
            
        ?>
     

    </div>




    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="validationCustom01">Username or Email</label>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="text" class="form-control" id="username" placeholder="">
                        </div>
                    </div>
                    <label for="validationCustom01">Password</label>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="password" class="form-control" id="password" placeholder="">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="form-check col">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                remember me
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="loginSubmit" data-dismiss="modal" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>