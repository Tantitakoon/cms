var myAccount = {}
$(document).ready(function () {
    $.fn.initUserPrfile();
});
$.fn.initUserPrfile = function (value) {
    $.get(`/cms/User/getCurrentUser`, function (response, status) {
        $("#usernameprofile").html(`<span>${response.data.user_name}</span>`);
        $("#emailprofile").html(`<span>${response.data.user_email}</span>`);
        $("#firstnameprofile").html(`<span>${response.data.user_firstname}</span>`);
        $("#lastnameprofile").html(`<span>${response.data.user_lastname}</span>`);
        $("#roleprofile").html(`<span>${response.data.user_role}</span>`);

        myAccount.user_name = response.data.user_name
        myAccount.user_email = response.data.user_email
        myAccount.user_firstname = response.data.user_firstname
        myAccount.user_lastname = response.data.user_lastname
        myAccount.user_role = response.data.user_role
    });
}


$.fn.EditAccount = function () {
    $("#editusername").val(myAccount.user_name)
    $("#editemail").val(myAccount.user_email)
    $("#editfirstname").val(myAccount.user_firstname)
    $("#editlastname").val(myAccount.user_lastname)


}

$("#saveEditAccount").click(function () {


    $.post("/cms/User/updateUser", { "user_name": $("#editusername").val(), "user_email": $("#editemail").val(), "user_firstname":$("#editfirstname").val(), "user_lastname":  $("#editlastname").val(), "user_role":  $("#editroleuser").val()}, function (result) {
        if (result.status == true) {
            $.fn.alertSuccess(result.message)
            myAccount.user_name = $("#editusername").val()
            myAccount.user_email = $("#editemail").val()
            myAccount.user_firstname = $("#editfirstname").val()
            myAccount.user_lastname = $("#editlastname").val()
            myAccount.user_role = $("#editroleuser").val()

            $("#usernameprofile").html(`<span>${$("#editusername").val()}</span>`);
            $("#emailprofile").html(`<span>${$("#editemail").val()}</span>`);
            $("#firstnameprofile").html(`<span>${$("#editfirstname").val()}</span>`);
            $("#lastnameprofile").html(`<span>${$("#editlastname").val()}</span>`);
            $("#roleprofile").html(`<span>${$("#editroleuser").val()}</span>`);


        } else {
            $.fn.alertFail(result.message)
        }
    });



})


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