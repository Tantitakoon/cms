$(document).ready(function () {
    function getContentTableSearch(row){
        return `<tr style ="font-size:10px"><td>${row['total_records']}</td>
                <td>${row['pc_code']} : ${row['pc_name']}</td>
                <td>${row['pc_distance']}km</td>
                <td>${row['pc_created_datetime']}</td>
                <td><a  href='#' onClick = 'handleClickSearch("${row['pc_point_path']}")'  ><i class="fas fa-chevron-circle-right"><span id = 'valPath' style ='display:none'>${row['pc_point_path']}</span></i></a></td></tr>`
    }
   

    $("#btSearch").click(function () {
        $.get("./Potree/search",{},(resp)=>{
            try{
                let results = JSON.parse(resp);
               // console.log(results);
                let values = Object.values(results)
                let count =0;
                if(values.length > 0){
                    let rows = [];
                    result = "";
                    for(let row of values) result += getContentTableSearch(row);
                    if(document.getElementById("contentSearch")== null)
                        $('#tableSearch').append(`<tbody id = "contentSearch">${result}</tbody>`);
                    else $('#contentSearch').html(result)
                    $('#tableSearch').show();
                }
            }catch(err){
                console.log(err.message)
            }
        })
        // $('#topFrame').html(`<div class="embed-responsive embed-responsive-16by9 ">
        //         <iframe class="embed-responsive-item" src="./mms/viewer/viewer02.php"></iframe>
        //     </div>`)
        // $('#bottomFrame').html(`<div class="embed-responsive embed-responsive-16by9 ">
        //         <iframe class="embed-responsive-item" src="https://www.7mscorethai.com/"></iframe>
        //     </div>`)
        // $('#slider').show();
    });
});