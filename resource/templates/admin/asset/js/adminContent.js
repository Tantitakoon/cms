$(document).ready(function () {


  $.fn.contentStaff = function () {
    $("#menu-addUser").show()
    $("#page-content-wrapper").load("resource/templates/admin/views/manageUser.html"); 
  }

  $.fn.contentAccount = function () {
    $("#page-content-wrapper").load("resource/templates/admin/views/accountUser.html"); 
  }
});



