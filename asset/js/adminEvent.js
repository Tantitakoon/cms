
$(document).ready(function () {
    $("#menu-addUser").hide()

    $("#managementLink").click(function () {
        if ($('#adminManagement ul').length == 0) {
            $("#adminManagement").append(`<ul id="childAdminManagement"class="sub-nav-link">
            <a href="#" id="staff" onclick="$.fn.contentStaff()">STAFF</a>
            </ul>`);
         
        }else{
            $("#childAdminManagement").remove()
        }
    });
    
    $("#accountLink").click(function(){
        $("#menu-addUser").hide()
        $.fn.contentAccount()
    });

});