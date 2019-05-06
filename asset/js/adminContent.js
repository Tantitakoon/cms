$(document).ready(function () {


  $.fn.contentStaff = function () {
    $("#menu-addUser").show()
    $(".container-fluid").remove()
    $("#page-content-wrapper").append(`<div class="container-fluid ">
        <div class="row">
                <div class="col-lg-12">        
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>NO</th>
                                      <th>NAME</th>
                                      <th>EMAIL</th>
                                      <th>ROLE</th>
                                      <th>STATUS</th>
                                      <th>ONLINE</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td>Doe</td>
                                      <td>john@example.com</td>
                                      <td>Admin</td>
                                      <td>Joined</td>
                                      <td>online</td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td>Moe</td>
                                      <td>mary@example.com</td>
                                      <td>Admin</td>
                                      <td>Joined</td>
                                      <td>online</td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td>Dooley</td>
                                      <td>july@example.com</td>
                                      <td>Admin</td>
                                      <td>Joined</td>
                                      <td>online</td>
                                    </tr>
                                  </tbody>
                                </table>
                </div>
            </div>
       </div>`);
  }

  $.fn.contentAccount = function () {
    $(".container-fluid").remove()
    $("#page-content-wrapper").append(
      `<div class="container-fluid">
       <div class="form-group row">
         <label for="staticEmail" class="col-sm-2 col-form-label">MY ACCOUNT   <a  class="ml-1"href="#"><span class="glyphicon glyphicon-edit"></span></a></label>
       </div>
       <div class="form-group row ml-5">
           <label for="staticEmail" class="col-sm-2 col-form-label">FIRST NAME</label>
           <label for="staticEmail" class="col-sm-2 col-form-label">Amin01</label>
       </div>
       <div class="form-group row ml-5">
         <label for="staticEmail" class="col-sm-2 col-form-label">LAST NAME</label>
         <label for="staticEmail" class="col-sm-2 col-form-label">CMS01</label>
       </div>
       <div class="form-group row ml-5">
          <label for="staticEmail" class="col-sm-2 col-form-label">E-MAIL</label>
          <label for="staticEmail" class="col-sm-2 col-form-label">Amin01@gmail.com</label>
       </div>
       </div>
       `
    );
  }
});



