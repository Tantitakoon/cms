$(document).ready(function () {
  $("#page-content-wrapper").load("/cms/views/manageUser.html");
  $.fn.contentAccount = function () {
    $("#page-content-wrapper").load("/cms/views/accountUser.html");
  }
  $.fn.contentMangement = function () {
    $("#page-content-wrapper").load("/cms/views/manageUser.html");
  }

  $.fn.validateInsertUser = function () {
    $("#noticeInsert").html("");
    $("#nameUser").css("background-color", "white")
    $("#emailUser").css("background-color", "white")
    $("#passwordUser").css("background-color", "white")
    $("#confirmPasswordUser").css("background-color", "white")
    
    
    if ($("#nameUser").val() == '') {
      $("#nameUser").css("background-color", "#FFCCCC")
    }
    if ($("#emailUser").val() == '') {
      $("#emailUser").css("background-color", "#FFCCCC")
    }
    if ($("#passwordUser").val() == '') {
      $("#passwordUser").css("background-color", "#FFCCCC")
    }

    if($("#passwordUser").val()!=$("#confirmPasswordUser").val()){
      $("#noticeInsert").html("<b>password not match</b>");
    }

    if ($("#confirmPasswordUser").val() == '') {
      $("#confirmPasswordUser").css("background-color", "#FFCCCC")
    } 

  }
});



