$(document).ready(function () {
    
    $.fn.logout = function(){
        $.post("./user/logout", {}, (resp) => {
        
            let decodeJSON = resp;
            let { status } = decodeJSON;
            if (status) {
                $.dreamAlert({
                    'type'      :   'success',
                    'message'   :    decodeJSON.message,
                    'position'  :   'right'
                 });
                 setTimeout(function(){
                    window.location.href = "/cms";
                }, 500);
            } else {
                $.dreamAlert({
                    'type'      :   'error',
                    'message'   :    decodeJSON.message,
                    'position'  :   'right'
                 });
           
            }
            
           
         
        })
    }
 
    
   
  
});