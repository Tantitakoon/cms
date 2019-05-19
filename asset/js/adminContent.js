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
    $("#username").css("background-color", "white")
    $("#email").css("background-color", "white")
    $("#firstname").css("background-color", "white")
    $("#lastname").css("background-color", "white")
    $("#password").css("background-color", "white")
    $("#confirmpassword").css("background-color", "white")
    let username = $("#username").val()
    let email = $("#email").val()
    let firstname = $("#firstname").val()
    let lastname = $("#lastname").val()
    let password = $("#password").val()
    let confirmpassword = $("#confirmpassword").val()
    let role = $("#roleuser").val()
    let flag = true;

    if (username == '') {
      $("#username").css("background-color", "#FFCCCC")
      flag = false
    }
    if (email == '') {
      $("#email").css("background-color", "#FFCCCC")
      flag = false
    }
    if (firstname == '') {
      $("#firstname").css("background-color", "#FFCCCC")
      flag = false
    }
    if (lastname == '') {
      $("#lastname").css("background-color", "#FFCCCC")
      flag = false
    }
    if (password == '') {
      $("#password").css("background-color", "#FFCCCC")
      flag = false
    }
    if (confirmpassword == '') {
      $("#confirmpassword").css("background-color", "#FFCCCC")
      flag = false
    }

    if (password != confirmpassword) {
      $("#noticeInsert").html("<b>password not match</b>");
      flag = false
    }
    if (flag) {
      $.post("/cms/User/insertUser", { "user_name": username, "user_email": email, "user_firstname": firstname, "user_lastname": lastname, "user_password": password, "user_role": role }, function (result) {
        if (result.status == true) {
          $.dreamAlert({
            'type': 'success',
            'message': result.message,
            'position': 'right'
          });
          $("#userTable").append(`
          <tr id=${username}>
            <td>${$("#userTable").children().length+1}</td>
            <td>${username}</td>
            <td>${firstname} ${lastname}</td>
            <td>${email}</td>
            <td>${role}</td>
            <td><a href="#" onclick="$.fn.editUserInformation('${username}')"><span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#editModal"></span></td></a>
          </tr>`
      );
        }else{
          $.dreamAlert({
            'type': 'error',
            'message': result.message,
            'position': 'right'
          });
        }
      });
    }


  }
});



