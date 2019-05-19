




$(document).ready(function () {
    $.fn.initUserInformation()
});





$.fn.editUserInformation = function (value) {
    $.get(`/cms/User/getUser?userName=${value}`, function (response, status) {
        $("#editusername").val(response.data[0].user_name)
        $("#editemail").val(response.data[0].user_email)
        $("#editfirstname").val(response.data[0].user_firstname)
        $("#editlastname").val(response.data[0].user_lastname)
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

$("#saveEditUser").click(function(){
   let user_name = $("#editusername").val()
   let user_email = $("#editemail").val()
   let user_firstname = $("#editfirstname").val()
   let user_lastname = $("#editlastname").val()
   let role = $("#editroleuser").val()

   /*$.post("/cms/User/updateUser", { "user_name": user_name, "user_email": user_email, "user_firstname": user_firstname, "user_lastname": user_lastname,"user_role": role }, function (result) {
           
   });*/

});