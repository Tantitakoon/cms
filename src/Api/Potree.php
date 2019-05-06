<?php 
 namespace App\Api;
 header('Content-Type: application/json');
class Potree {
    
    public function getView(){
         if(isset($_SESSION['viewPath']))
            echo json_encode((object) array('viewPath' => $_SESSION['viewPath'],'status'=>true));
         else 
            echo json_encode((object) array('status'=>false));
         
    }

    public function setView(){
        if(isset($_POST['namePath'])){
            $_SESSION['viewPath'] = $_POST['namePath'];
            echo json_encode((object) array('status'=>true));
        } else{
            echo json_encode((object) array('status'=>false));
        }    
    }

    public function search(){
        include "src/Db/connect.php";
        $get_result_sql = "
        
            select
                *
            from
                mms_point_cloud
            order by
                pc_created_datetime desc
        
        ";
        $results = array();
        
        $loop = mysqli_query($connect, $get_result_sql)
                        or die (mysqli_error($connect));

        $total_records = 0;
        while ($post_row = mysqli_fetch_array($loop)) {
            
            
            $total_records++;
            $results[$total_records] = array(
                                            'total_records' => $total_records,
                                            'pc_code' => $post_row[pc_code],
                                            'pc_name' =>  $post_row[pc_name],
                                            'pc_distance' =>  number_format($post_row[pc_distance],2),
                                            'pc_created_datetime'=>$post_row[pc_created_datetime],
                                            'pc_point_path'=>$post_row[pc_point_path]
            );   
      
        }
        mysqli_close($connect);
        echo json_encode($results);
    }

}

    


?>