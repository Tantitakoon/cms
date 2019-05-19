




$(document).ready(function () {
    $.fn.initUserInformation()
});





$.fn.editUserInformation = function (value) {
    $.get(`/cms/User/getUser?userName=${value}`, function (response, status) {
        $("#editusername").val(response.data[0].user_name)
        $("#editemail").val(response.data[0].user_email)
        $("#editfirstname").val(response.data[0].user_firstname)
        $("#editlastname").val(response.data[0].user_lastname)

        /*$(`#${value}`).empty();
        $(`#${value}`).append(` 
        <td>${response.data[0].user_id}</td>
        <td> <input type="text" class="editUser" id="user_name" value="${response.data[0].user_name}" size="6"required="required"></td>
        <td> <input type="text" class="editUser" id="user_firstname" value="${response.data[0].user_firstname} ${response.data[0].user_lastname}" size="15"required="required"></td>
        <td> <input type="text" class="editUser" id="user_email" value="${response.data[0].user_email}"size="26" required="required"></td>
        <td>  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
        <option selected>Choose...</option>
        <option value="admin">admin</option>
        <option value="user">user</option>
      </select></td>
        <td><a href="#">save</a> <a href="#"  onclick="$.fn.userCancel('${response.data[0].user_name}')">cancel</a></span></td>
        `)*/
    });
}




$.fn.initUserInformation = function () {
    $.get("/cms/User/getUser", function (response, status) {
        if (status == "success") {
            $.each(response.data, function (key, value) {
                $("#userTable").append(`
                    <tr id=${value.user_name}>
                      <td>${value.user_id}</td>
                      <td>${value.user_name}</td>
                      <td>${value.user_firstname} ${value.user_lastname}</td>
                      <td>${value.user_email}</td>
                      <td>${value.user_role}</td>
                      <td><a href="#" onclick="$.fn.editUserInformation('${value.user_name}')"><span class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#editModal"></span></td></a>
                    </tr>`
                );
            });

        }
    });
}

$.fn.userCancel = function (value) {
    $.get(`/cms/User/getUser?userName=${value}`, function (response, status) {
        $(`#${value}`).empty();
        $(`#${value}`).append(` 
        <td>${response.data[0].user_id}</td>
        <td>${response.data[0].user_name}</td>
        <td>${response.data[0].user_firstname} ${response.data[0].user_lastname}</td>
        <td>${response.data[0].user_email}</td>
        <td>${response.data[0].user_role}</td>
        <td><a href="#" onclick="$.fn.editUserInformation('${response.data[0].user_name}')"><span class="glyphicon glyphicon-pencil"></span></td></a>
        `)
    });
}

$.fn.userSave = function (value) {

}