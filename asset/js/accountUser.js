var myAccount = {}
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
           myAccount.user_name = response.data.user_name
           myAccount.user_email = response.data.user_email
           myAccount.user_firstname = response.data.user_firstname
           myAccount.user_lastname = response.data.user_lastname
           myAccount.user_role = response.data.user_role
    });
}


$.fn.EditAccount = function () {
    $("#editAccount").empty();
    $("#editAccount").append(`
            <input type="button" onclick=$.fn.cancelEdit() value="CANCEL"/>
            <input type="button" onclick=$.fn.saveEdit() value="SAVE"/>
    `)
    $("#emailprofile").removeAttr("readonly")
    $("#lastnameprofile").removeAttr( "readonly")
    $("#firstnameprofile").removeAttr("readonly")
    $("#usernameprofile").removeAttr("readonly")
    $("#selectRoleProfile").empty()
    $("#selectRoleProfile").append(`
       <select id="roleuser" class="form-control form-control-lg">
       <option value="admin">Admin</option>
       <option value="user">User</option>
     </select>`)
}

$.fn.cancelEdit = function () {
    $("#editAccount").empty();
    $("#editAccount").append(`
            <input type="button" onclick=$.fn.EditAccount() value="EDIT"/>    
    `)
    $("#usernameprofile").val(myAccount.user_name)
    $("#emailprofile").val(myAccount.user_email)
    $("#firstnameprofile").val(myAccount.user_firstname)
    $("#lastnameprofile").val(myAccount.user_lastname)
    $("#roleprofile").val(myAccount.user_role)
    $("#usernameprofile").attr('readonly', true)
    $("#emailprofile").attr('readonly', true)
    $("#firstnameprofile").attr('readonly', true)
    $("#lastnameprofile").attr('readonly', true)
    $("#selectRoleProfile").empty()
    $("#selectRoleProfile").append(`
    <input type="text" class="form-control" id="roleprofile" placeholder="ROLE" required="required" value=${myAccount.user_role} readonly>
     </select>`)
}


$.fn.saveEdit = function () {
    let user_name =$("#usernameprofile").val()
    let user_email =  $("#emailprofile").val()
    let user_firstname =   $("#firstnameprofile").val()
    let user_lastname =     $("#lastnameprofile").val()
    let role =$("#roleprofile").val()
    $.post("/cms/User/updateUser", { "user_name": user_name, "user_email": user_email, "user_firstname": user_firstname, "user_lastname": user_lastname, "user_role": role }, function (result) {
        if (result.status == true) {
            $.fn.alertSuccess(result.message)
            $("#usernameprofile").val(user_name)
            $("#emailprofile").val(user_email)
            $("#firstnameprofile").val(user_firstname)
            $("#lastnameprofile").val(user_lastname)
            $("#roleprofile").val(role)
            $("#editAccount").empty();
            $("#editAccount").append(`
                    <input type="button" onclick=$.fn.EditAccount() value="EDIT"/>    
            `)
            $("#usernameprofile").attr('readonly', true)
            $("#emailprofile").attr('readonly', true)
            $("#firstnameprofile").attr('readonly', true)
            $("#lastnameprofile").attr('readonly', true)
            $("#selectRoleProfile").empty()
            $("#selectRoleProfile").append(`
            <input type="text" class="form-control" id="roleprofile" placeholder="ROLE" required="required" value=${myAccount.user_role} readonly>
             </select>`)
        } else {
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