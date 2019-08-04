<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.8">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>3D Panorama System</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="asset/css/simple-sidebar.css" rel="stylesheet">
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB2go0vTmolhjUXN4nCTcAZe9-9afNqR8">
  //<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB2go0vTmolhjUXN4nCTcAZe9-9afNqR8&callback=displayMap">
  </script>
  
</head>


<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <b>POINT COULD MAP</b>
      </div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">CITY</span>
            </div>
            <select class="form-control" id="province">
              <option>select</option>
              <?php
                 use App\Api\Map;
                 $provinces = Map::getAllProvince();
                 if(is_array($provinces)){
                    foreach ($provinces as $value){ 
                        echo "<option>$value</option>";
                    }
                 }
               
              ?>
            </select>
          </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">File Name</span>
            </div>
            <select class="form-control" id="fileName">
              <option>select</option>
            </select>
          </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Pano ID</span>
            </div>
            <select class="form-control" id="panoID">
              <option>205</option>
            </select>
          </div>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-md-3">
              latitude
            </div>
            <div class="col-md-6" id="latitude">

            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              longitude
            </div>
            <div class="col-md-6" id="longitude">

            </div>
          </div>

        </a>
        <a href="#" class="list-group-item list-group-item-action">
         <!-- <div class="row" style="text-align:center;">
            <button style="position:absolute;" type="button" class="btn btn-dark ml-3" id="btMultiple">Open multiple</button>
            <button type="button" class="btn btn-dark  ml-3" id="btPointCloud">POINT COULD</button> 
          </div>-->

        </a>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a href="#" id="menu-toggle">
          <i class="material-icons" style="font-size:36px">view_list</i>
        </a>
        <!--button class="btn btn-primary" >Toggle Menu</button-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="/cms"><i class="material-icons" style="font-size:30px;color: blue">keyboard_backspace</i>
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>


      <div class="container-fluid" id="map" style="width: 100%; height:90%;float:left"></div>
      <div class="container-fluid" id="pano" style="width: 0%; height: 0%;float:left"></div>

    </div>
    <!-- /#page-content-wrapper -->

  </div>

  <script>
    let markers = []
    let isDisplayMulti = false;
    $( "#province" ).change(function() {
          let provinceName = $("#province").val();
          if(![null,undefined,"select"].includes(provinceName)){
            $.get(`./map/getByProvince?provinceName=${provinceName}`,cbSelectProvince)
          }
    });
 


    $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $('#btMultiple').click(() => {
      //displayMap();
      if (isDisplayMulti) {
        hideMulti();
      } else {
        displayMulti();
      }


    })
    $('#btPointCloud').click(() => {
      $("#map").html(` <div class="embed-responsive embed-responsive-16by9 ">
               <iframe class="embed-responsive-item" src="./viewPotree?path=f1519_0005_test" allowfullscreen></iframe>
           </div>`)

    })

    function cbSelectProvince(resp){
        let optionsTxt = "<option>select</option>"
        if(![null,undefined].includes(resp)){
           optionsTxt += resp.reduce((accumulator, currentValue) => accumulator + `<option>${currentValue}</option>`,"");
           displayMap(resp);
        }
        $('#fileName').html(optionsTxt);
    }

    function hideMulti() {
      let mapDom = $('#map');
      let panoDom = $('#pano');
      let btDisplayMulti = $('#btMultiple');
      btDisplayMulti.html("Open multiple")
      mapDom.css('width', '100%');
      panoDom.css('width', '0%');
      panoDom.css('height', '0%');
      isDisplayMulti = false;
    }
    function displayMulti() {
      let mapDom = $('#map');
      let panoDom = $('#pano');
      let latitude = $("#latitude").html();
      let longitude = $("#longitude").html();
      let btDisplayMulti = $('#btMultiple');
      let isValuable = (val) => !isNaN(parseFloat(val));
      if (isValuable(latitude) && isValuable(longitude)) {
        let streetViewService = new google.maps.StreetViewService();
        let latLng = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
        streetViewService.getPanoramaByLocation(latLng, 100, function (streetViewPanoramaData, status) {
          if (status === google.maps.StreetViewStatus.OK) {
            mapDom.css('width', '50%');
            panoDom.css('width', '50%');
            panoDom.css('height', '100%');
            var panorama = new google.maps.StreetViewPanorama(
              document.getElementById('pano'), {
                position: { lat: parseFloat(latitude), lng: parseFloat(longitude) }
              });
            btDisplayMulti.html("Close multiple")
            isDisplayMulti = true;
          } else {
            alert(`it dosen't avaliable !!!`);
          }
        });

      } else {
        alert("Click on a map");
      }
    }



    function displayMap(nameFiles=[]) {
      let map = new google.maps.Map(document.getElementById('map'), {});
      /*let nameFiles = [
                      'test.kml','newkml.kml','test2.kml','test3.kml','test4.kml',
                      'test5.kml' ,'test6.kml','test7.kml','test8.kml','test9.kml',
                      'test10.kml'"testNonthaburi.kml","testNonthaburi1.kml"
                      ];*/
      domainName = "http://demo-thaiwatertool.online/"
      console.log(nameFiles)
      console.log(domainName);
      for(let nameFile of nameFiles){
        let src = joinUrl(domainName, `/cms/file/download?name=${nameFile}`);//'http://localhost/cms/file/download?name=air_traffic.kml';


          map.addListener('click', (mapEvent) => {
            clearMarkers();
            changeTextLatLng(mapEvent.latLng);
            placeMarker(map, mapEvent.latLng);
          })

          let kmlLayer = new google.maps.KmlLayer({ url: src, map: map });
          kmlLayer.addListener('click', (kmlEvent) => {
            clearMarkers();
            changeTextLatLng(kmlEvent.latLng);
            kmlEvent.featureData.infoWindowHtml = `${createBt3DMAP(kmlEvent.latLng)}   ${createBtPointCould(kmlEvent.latLng)}`;

            placeMarker(map, kmlEvent.latLng);

          });

          function placeMarker(map, location) {
            var marker = new google.maps.Marker({
              position: location,
              map: map
            });
            markers.push(marker)

            // var infowindow = new google.maps.InfoWindow({
            //   content: `${createBt3DMAP(location)}   ${createBtPointCould(location)}`
            // });

            // infowindow.open(map, marker);
          }
      }
        
    }

    function clearMarkers() {
      for (let markerr of markers) markerr.setMap(null)
      markers = []
    }
    function createBt3DMAP(location) {
      return `<button class ="btn btn-info" onclick = "window.open('/cms/panoView?lat=${location.lat()}&lng=${location.lng()}')" >3D MAP</button>`
    }

    function createBtPointCould(location) {
      return `<button class ="btn btn-info" onclick = "window.open('./viewPotree?path=f1519_0005_test&lat=${location.lat()}&lng=${location.lng()}')" >POINT CLOUD</button>`
    }

    function changeTextLatLng(location) {
      document.getElementById("latitude").innerHTML = location.lat();
      document.getElementById("longitude").innerHTML = location.lng();
    }

    function joinUrl(text1, text2) {
      let result = "";
      text1 = text1.trim();
      text2 = text2.trim();
      if (text1.endsWith("/")) {
        result = (text2.startsWith("/")) ? text1 + text2.substring(1, text2.length) : text1 + text2;
      } else result = (text2.startsWith("/")) ? text1 + text2 : text1 + "/" + text2;
      return result;
    }

    function pathJoin(parts, sep) {
      var separator = sep || '/';
      var replace = new RegExp(separator + '{1,}', 'g');
      return parts.join(separator).replace(replace, separator);
    }
  </script>

</body>

</html>