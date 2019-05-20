$(document).ready(function () {
    $.fn.initUserPrfile();
});




$.fn.initUserPrfile = function (value) {
    $.get(`/cms/User/getCurrentUser`, function (response, status) {
       
           $("#usernameprofile").val(response.data.user_name)
           $("#emailprofile").val(response.data.user_email)
           $("#firstnameprofile").val(response.data.user_firstname)
           $("#lastnameprofile").val(response.data.user_lastname)
           $("#roleprofile").val(response.data.user_role)
    });
}