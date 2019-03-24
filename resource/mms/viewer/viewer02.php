<!DOCTYPE html>
<html lang="en">
    <?php session_start()?>
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
	<div >
			<div id="potree_render_area"></div>
			<div id="potree_sidebar_container"> </div>
	</div>
	
	
	
	
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
        $.post("../services/getview.php",{},(resp)=>{
            console.log(resp)
            let {status,viewPath} =  JSON.parse(resp);
            if(status) loadPotree(`${viewPath}`)
        })
		 
		//loadPotree(1);
		
	</script>
	
	
  </body>
</html>
