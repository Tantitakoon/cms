
$(document).ready(function () {
    $.fn.initUserInformation()
});

$.fn.editUserInformation = function (value,row) {
  
    $.get(`/cms/User/getUser?userName=${value}`, function (response, status) {

        $("#editusername").val(response.data[0].user_name)
        $("#editemail").val(response.data[0].user_email)
        $("#editfirstname").val(response.data[0].user_firstname)
        $("#editlastname").val(response.data[0].user_lastname)
        $("#editID").val(row)
    });
}

$.fn.initUserInformation = function () {
    let row = 1 ;
    $.get("/cms/User/getUser", function (response, status) {
        if (status == "success") {
            $.each(response.data, function (key, value) {
                $("#userTable").append(`
                    <tr id=${value.user_name}>
                      <td>${row}</td>
                      <td>${value.user_name}</td>
                      <td>${value.user_firstname} ${value.user_lastname}</td>
                      <td>${value.user_email}</td>
                      <td>${value.user_role}</td>
                      <td><a href="#"  class="ml-2" onclick="$.fn.editUserInformation('${value.user_name}','${row++}')"><span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#editModal"></a><a href="#" onclick="$.fn.createRemoveUserInformation('${value.user_name}')" class="ml-2"></span> <span data-toggle="modal" data-target="#removeModal" class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>`
                );
            });

        }
    });
}


$("#saveEditUser").click(function () {
    let user_name = $("#editusername").val()
    let user_email = $("#editemail").val()
    let user_firstname = $("#editfirstname").val()
    let user_lastname = $("#editlastname").val()
    let role = $("#editroleuser").val()
    let ID = $("#editID").val()

    $.post("/cms/User/updateUser", { "user_name": user_name, "user_email": user_email, "user_firstname": user_firstname, "user_lastname": user_lastname, "user_role": role }, function (result) {
        if (result.status == true) {
            $.fn.alertSuccess(result.message)
            $(`#${user_name}`).empty();
            $(`#${user_name}`).append(`
            <td>${ID}</td>
            <td>${user_name}</td>
            <td>${user_firstname} ${user_lastname}</td>
            <td>${user_email}</td>
            <td>${role}</td>
            <td><a href="#"  class="ml-2" onclick="$.fn.editUserInformation('${user_name}','${ID}')"><span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#editModal"></a><a href="#" onclick="$.fn.createRemoveUserInformation('${user_name}')" class="ml-2"></span> <span data-toggle="modal" data-target="#removeModal" class="glyphicon glyphicon-remove"></span></a></td>
            `)
        } else {
            $.fn.alertFail(result.message)
        }
    });

});

$.fn.createRemoveUserInformation = function (value) {
    $(`#removeInformation`).empty();
    $(`#removeInformation`).append(`
    <div class="form-group">
        <button type="submit" data-dismiss="modal" class="btn btn-primary btn-block btn-lg" onclick="$.fn.removeUserInformation('${value}')">REMOVE</button>
    </div>
    <div class="form-group">
        <button type="submit"  data-dismiss="modal" class="btn btn-primary btn-block btn-lg">CANCEL</button>
    </div>
    `)

}
$.fn.removeUserInformation = function (value) {
    $.post("/cms/User/deleteUser", { "user_name": value }, function (result) {
        if (result.status == true) {
            $.fn.alertSuccess(result.message)
            $(`#${value}`).empty();
        }else{
          $.fn.alertFail(result.message)
        }
      });
    
}

$.fn.alertSuccess = function (message) {
    $.dreamAlert({
        'type': 'success',
        'message': message,
        'position': 'right'
    });
}

$.fn.alertFail = function (message) {
    $.dreamAlert({
        'type': 'error',
        'message': message,
        'position': 'right'
    });
}