
// var resizeHandle = document.getElementById('handle');
//     var box = document.getElementById('box');
//     var box2 = document.getElementById('box2');
//     resizeHandle.addEventListener('mousedown', initialiseResize, false);

//     function initialiseResize(e) {
//         window.addEventListener('mousemove', startResizing, false);
//         window.addEventListener('mouseup', stopResizing, false);
//     }

//     function startResizing(e) {
//         let calculate = (e.clientY - box.offsetTop)-50 
        
//         let result = 1000 - calculate
//         if (result > 0 && calculate > 0) {
//             console.log(e.clientY ,box.offsetTop)
//             box.style.height = calculate + 'px';
           
//         }
//     }
//     function stopResizing(e) {
//         window.removeEventListener('mousemove', startResizing, false);
//         window.removeEventListener('mouseup', stopResizing, false);
//     }

$(document).ready(function(){
    $('#slider').on('mousedown',function(e){
      $('.column').on('mousemove',function(e){
          diff = $('#slider').offset().top + 5 - e.pageY ;
          $('.top').height($('.top').height()-diff);
          $('.bottom').height($('.bottom').height()+diff);
      });
    });
    $('.column').on('mouseup',function(){
        $('.column').off('mousemove');
    });
  });