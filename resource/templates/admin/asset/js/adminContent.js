$(document).ready(function () {


  $.fn.contentStaff = function () {
    $("#menu-addUser").show()
    //$(".container-fluid").remove()
    $("#page-content-wrapper").load("resource/templates/admin/views/manageUser.html"); 
  }

  $.fn.contentAccount = function () {
    $("#page-content-wrapper").load("resource/templates/admin/views/accountUser.html"); 
   /* $(".container-fluid").remove()
    $("#page-content-wrapper").append(
      `<div class="container-fluid">
       <div class="row">
         <label for="staticEmail" class="col-sm-12">MY ACCOUNT<a  class="ml-1"href="#"><span class="glyphicon glyphicon-edit"></span></a></label>
       </div>
       <div class="row ml-5 col-sm-12 col-md-12">
           <label for="staticEmail" class="col-sm-3 col-md-3">FIRST NAME</label>
           <label for="staticEmail" class="col-sm-3 col-md-3">Amin01</label>
       </div>
       <div class="row ml-5 col-sm-12 col-md-12">
         <label for="staticEmail" class="col-sm-3 col-md-3">LAST NAME</label>
         <label for="staticEmail" class="col-sm-6 col-md-6">CMS01</label>
       </div>
       <div class="row ml-5 col-sm-12 col-md-12">
          <label for="staticEmail" class="col-sm-3 col-md-3">E-MAIL</label>
          <label for="staticEmail" class="col-sm-6 col-md-6">Amin01@gmail.com</label>
       </div>
       </div>
       `
    );*/
  }
});



