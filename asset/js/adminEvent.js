
$(document).ready(function () {
    $("#managementLink").click(function () {
        $.fn.contentMangement()
    });
    
    $("#accountLink").click(function(){
        $.fn.contentAccount()
    });

    $("#addNewUser").click(function(){
        $.fn.validateInsertUser()
    });
  
});