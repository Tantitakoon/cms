<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Potree Viewer</title>

	<link rel="stylesheet" type="text/css" href="../build/potree/potree.css">
	<link rel="stylesheet" type="text/css" href="../libs/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../libs/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="../libs/openlayers3/ol.css">
	<link rel="stylesheet" type="text/css" href="../libs/spectrum/spectrum.css">
	<link rel="stylesheet" type="text/css" href="../libs/jstree/themes/mixed/style.css">
	
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
	
    
	
</head>

<body>
	<script src="../libs/jquery/jquery-3.1.1.min.js"></script>
	<script src="../libs/spectrum/spectrum.js"></script>
	<script src="../libs/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	<script src="../libs/jquery-ui/jquery-ui.min.js"></script>
	<script src="../libs/three.js/build/three.min.js"></script>
	<script src="../libs/other/BinaryHeap.js"></script>
	<script src="../libs/tween/tween.min.js"></script>
	<script src="../libs/d3/d3.js"></script>
	<script src="../libs/proj4/proj4.js"></script>
	<script src="../libs/openlayers3/ol.js"></script>
	<script src="../libs/i18next/i18next.js"></script>
	<script src="../libs/jstree/jstree.js"></script>
	<script src="../build/potree/potree.js"></script>
	<script src="../libs/plasio/js/laslaz.js"></script>
	
	<!-- INCLUDE ADDITIONAL DEPENDENCIES HERE -->
	<!-- INCLUDE SETTINGS HERE -->
	
	<table>
		<tr>
			<td>
			
				<!--<input type="button" value="Click Me" onClick="loadPotree(2);" />-->
				
				<table cellpadding="5px" border="1" style="position: absolute; top:0; right:0; z-index: 9999;" bgcolor="#ffffff">
					<tr >
						<td align="center" style="background-color:#4682B4; color: white;">
							
							#
							
						</td>
						<td align="center" bgcolor="#4682B4" style=" color: white;">ชื่อสายทาง</td>
						<td align="center" bgcolor="#4682B4" style=" color: white;">ระยะทาง</td>
						<td align="center" bgcolor="#4682B4" style=" color: white;">วันที่สำรวจ</td>
						<td align="center" bgcolor="#4682B4" style=" color: white;"></td>
				  </tr>
				  
				  <?php
				  
					include "db_connect.php";
					
					
					$get_result_sql = "
					
						select
							*
						from
							mms_point_cloud
						order by
							pc_created_datetime desc
					
					";
					
					//echo $get_result_sql;
					
					$loop = mysqli_query($connect, $get_result_sql)
									or die (mysqli_error($connect));
   
					$total_records = 0;
				
					//while ($post_row = mysqli_fetch_array($the_result)) {
					while ($post_row = mysqli_fetch_array($loop)) {
						
						
						$total_records++;
				  
				  ?>
				  
				  
					<tr >
					  <td align="center" ><?php echo $total_records;?></td>
					  <td align="left" ><?php echo $post_row[pc_code] . ": " . $post_row[pc_name];?></td>
					  <td align="right" ><?php echo number_format($post_row[pc_distance],2) . "km";?></td>
					  <td align="left" ><?php echo $post_row[pc_created_datetime];//echo formatDateThai($post_row[pc_created_datetime],1,1);?></td>
					  <td align="center" >
						
						<a href='#' onClick="loadPotree('<?php echo $post_row[pc_point_path];?>'); return false;">
							<i class="fas fa-chevron-circle-right"></i>
						</a>
					  
					  </td>
					</tr>
					
					<?php }?>
					
				</table>
				
			</td>
			<td>
				<?php if(1==1){?>
				<div >
					<div id="potree_render_area"></div>
					<div id="potree_sidebar_container"> </div>
				</div>
				<?php }?>
			
			</td>
		</tr>
	</table>
	
	
	
	
	<script>
	
		
		
		function loadPotree(tree_path){
			
			
			console.log("loading point cloud: " + tree_path);
			
			var point_cloud_path;
			
			point_cloud_path = "../pointclouds/"+tree_path+"/cloud.js";
			
			window.viewer = new Potree.Viewer(document.getElementById("potree_render_area"));
		
			viewer.setEDLEnabled(true);
			viewer.setFOV(60);
			viewer.setPointBudget(1*1000*1000);
			viewer.loadSettingsFromURL();
			
			/*viewer.setDescription("Point cloud courtesy of <a target='_blank' href='https://www.sigeom.ch/'>sigeom sa</a>");*/
			
			viewer.loadGUI(() => {
				viewer.setLanguage('en');
				$("#menu_tools").next().show();
				$("#menu_clipping").next().show();
				
				
				//viewer.toggleSidebar();
			});
			
			// Load and add point cloud to scene
			
			
			Potree.loadPointCloud(point_cloud_path, "sigeom.sa", e => {
				//Potree.loadPointCloud("http://www.gnssthai.com/potree/pointclouds/f1519_0005_test/cloud.js", "sigeom.sa", e => {
				//Potree.loadPointCloud("../pointclouds/lion_takanawa_las/cloud.js", "lion", function(e){
				let scene = viewer.scene;
				let pointcloud = e.pointcloud;
				
				console.log(pointcloud.material);
				
				let material = pointcloud.material;
				material.size = 1;
				//material.pointColorType = Potree.PointColorType.INTENSITY;
				material.pointColorType = Potree.PointColorType.ELEVATION;
				//viewer.setMaterial("Intensity");
				//material.IntensityRange = [0, 600];
				//material.gradient = gradient;
				//material.elevationRange = [720, 800];
				material.pointSizeType = Potree.PointSizeType.SMALL;
				material.shape = Potree.PointShape.SQUARE;
				
				material.elevationRange = [0, 20];
				
				scene.addPointCloud(pointcloud);
				
				//scene.view.position.set(589974.341, 231698.397, 986.146);
				//scene.view.lookAt(new THREE.Vector3(589851.587, 231428.213, 715.634));
				 viewer.fitToScreen();
			});
			
			
		}
		
		
		//loadPotree(1);
		
	</script>
	
	
  </body>
</html>
