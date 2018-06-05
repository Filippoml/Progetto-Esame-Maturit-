

<?php 


session_start();

?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'/>
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home</title>

    <script src="vendor/jquery.min.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link href="vendor/lato-font.css" rel="stylesheet">
    <link href="vendor/catamaran-font.css" rel="stylesheet">
    <link href="vendor/moli-font.css" rel="stylesheet">
    <script src='vendor/recaptcha.js'></script>
    <script src="vendor/sweetalert.min.js"></script>
    <link href="css/new-age.min.css" rel="stylesheet">
    <script src='vendor/mapbox/mapbox-gl.js'></script>
    <link href='vendor/mapbox/mapbox-gl.css' rel='stylesheet'>
    <script src='vendor/mapbox/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='vendor/mapbox/mapbox-gl-geocoder.css' type='text/css'>
    <script src='vendor/mapbox/leaflet-pip.js'></script>
    <script src="vendor/mapbox/leaflet.js"></script>
    <script src='vendor/mapbox/turf.min.js'></script>
    <script type="text/javascript" src="js/geojson.min.js"></script>
    
    <link rel="stylesheet" href="https://daneden.github.io/animate.css/animate.min.css">


    <style>

    body{
      overflow:hidden;
    }

    input,select, button, textarea,a {
      outline: none;
      box-shadow:none !important;
      border:0px solid #ccc;
    }

    .map-overlay {
      font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
      position: absolute;
      width: 200px;
      cursor: -webkit-grab;
      right: 0;
      padding: 10px;
      z-index: 10;
    }
    
    .btn-circle {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      line-height: 1.428571429;
      border-radius: 15px;
    }

    .btn-circle.btn-lg {
      width: 50px;
      height: 50px;
      padding: 10px 16px;
      font-size: 18px;
      line-height: 1.33;
      border-radius: 25px;
      float: right;
      margin: 5px;
    }

    .btn-circle.btn-xl {
      width: 70px;
      height: 70px;
      padding: 10px 16px;
      font-size: 24px;
      line-height: 1.33;
      border-radius: 35px;
    }
    
    </style>

  </head>
  
  <body>
<?php 



include("admin/config.php");

$code = mysqli_real_escape_string($conn,$_GET['code']);

if(!empty($_GET['code']))

{



  $sql = "UPDATE markers SET state = '2', date_deleted=NOW() WHERE hashcode='$code' AND state = '0'";
 
  
  $result  = mysqli_query($conn, $sql);
  if ($result === TRUE) {
    
    if (mysqli_affected_rows($conn) > 0){
      echo "<script>swal('Segnalazione Cancellata', 'Grazie per cercare di rendere Roma più pulita!', 'success');</script>";
    }
    else{
      echo "<script>swal('Errore', 'Segnalazione Non Trovata', 'error');</script>";
    }

} else {
  echo "<script>swal('Errore', 'Riprova più tardi', 'error');</script>";

}



}

?>
    <link rel="stylesheet" type="text/css" href="jquery.fullPage.css" />
    <script type="text/javascript" src="jquery.fullPage.js"></script>
    
    <script type="text/javascript">
		  $(document).ready(function() {
			  $('#fullpage').fullpage({
          sectionsColor: ['#f2f2f2', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff'],
          onLeave: function(index, nextIndex, direction){
            if(nextIndex == 3){
            $.fn.fullpage.setAllowScrolling(false, 'up');
            }  
            else{
              $.fn.fullpage.setAllowScrolling(true, 'up');
            }
          }
        });
		  });
    </script>

    <div id="fullpage" class="animated fadeIn">
      <div class="section active" id="section0">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">Progetto Esame</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fa fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#" onClick="$.fn.fullpage.moveTo(2);">Segnala</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#" onClick="$.fn.fullpage.moveTo(3);">Mappa</a>
            </li>  
            
            <?php
            
              if($_SESSION['level'] == 1){
                  echo '<li class="nav-item">';
                  echo '<a class="nav-link js-scroll-trigger" href="/progetto/admin">Admin</a>';
                  echo '</li>';
                }
              if($_SESSION['user'] != ''){
                echo '<li class="nav-item">';
                echo '<a class="nav-link js-scroll-trigger" href="/progetto/admin/logout.php">Logout</a>';
                echo '</li>';
              }
              else{
                echo '<li class="nav-item">';
                echo '<a class="nav-link js-scroll-trigger" href="/progetto/admin">Login</a>';
                echo '</li>';
              }
            ?>
          
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead" style="height: 100%;" >
      <div class="container h-100" >
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">Invia segnalazioni sulla raccolta dei rifiuti e la pulizia delle strade, indicando l'indirizzo preciso del luogo dove si richiede l'intervento</h1>
              <a href="#" onClick="$.fn.fullpage.moveSectionDown();" class="btn btn-outline btn-xl js-scroll-trigger">Segnala</a>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>
  <div class="section download bg-primary text-center" id="section1">
  <div class="container responsive2" style="top: 10%; position: relative;">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2 class="section-heading h2reponsive" style="margin-bottom: 35px;">Indica l'indirizzo preciso del luogo dove si richiede l'intervento</h2>
          <form id="form">
            <div class="form-group">
              <label for="input_address">Nome Via</label>
              <input autocomplete="off" type="text" class="form-control" id="input_address" required>
            </div>
            <div class="form-group">
              <label for="input_civic">Numero Civico</label>
              <input autocomplete="off" type="number" class="form-control" id="input_civic" required>
            </div>
            <div class="form-group">
              <label for="input_email">Indirizzo Email</label>
              <input autocomplete="off" type="email" class="form-control" id="input_email" required>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6LcgPVoUAAAAAGY31Rv30bTT82RX6oKdboU35twG"></div>
            </div>
            <button type="submit" class="btn btn-primary">Segnala</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="section" id="section2">
    <div id='geocoder' style="display:none;" class='geocoder'></div>
    
    <?php

    if($_SESSION['user']!=''){
      echo '<div  style="top: 10%" class="map-overlay top">';
      echo '<button id="bottone_cancella" onclick="bottone_cancella_click();" style="display:none; background-color: #ffc107;" type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-trash"></i></button>';
      echo '<button id="button_confirm_deleting" style="display:none; background-color: #ffc107; display:none;" onclick="confirm_deleting_click();" type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-check"></i></button>';
      echo '</div>';
    }

    ?>

    <div  style="top: 40%" class='map-overlay top'>
      <button style="background-color: #ffc107; display:none;" id="bottone_up" onclick="$.fn.fullpage.moveSectionUp();" type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-arrow-up"></i></button>
    </div>
    <div id="map" style="height: 100%; width: 100%;"></div>
    <script>
      mapboxgl.accessToken = 'pk.eyJ1IjoiZmlsaXBwb21sIiwiYSI6ImNqZ2d3bzhncjAydmEyd255OGdscnY1MjMifQ.-6txUZG9lC85tPkfJEKtcw';
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v10',
        center: [12.5033694, 41.8945083],
        zoom: 11
      });
    </script>
  </div>
</div>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/new-age.min.js"></script>
<script>
  //Global Variables
  var geocoder;
  var layer;
  var debug;
  var data = [];
  var leftButtonDown = false;
  var id = [];
  var to_delete = [];
  var test =$.getJSON("rome.json");
  map.on('load', function() {
    $('#bottone_cancella').css('display','');
    $('#bottone_up').css('display','');
    geocoder = new MapboxGeocoder({
      accessToken: mapboxgl.accessToken,
    });
    test = JSON.parse (test.responseText);
    layer = map.addLayer({
      'id': 'rome',
      'type': 'fill',
      'source': {
        'type': 'geojson',
         "data": test
      },
      'layout': {},
      'paint': {
        'fill-color': '#088',
        'fill-opacity': 0.4
      }
    });
    map.addLayer({
      'id': 'rome_heatmap',
      'type': 'heatmap',
      'source': {
        'type': 'geojson',
        "data":{
          "type": "FeatureCollection",
          "features": []
          }
        },
        'layout': {},
        'paint': {
          "heatmap-color": [
            "interpolate",
            ["linear"],
            ["heatmap-density"],
            0, "rgba(33,170,33,0)",
            0.2, "rgb(103,169,33)",
            0.4, "rgb(209,229,33)",
            0.6, "rgb(253,219,33)",
            0.8, "rgb(239,138,98)",
            1, "rgb(178,24,43)"
          ]
        }
      });
      
      var gjLayer = L.geoJson(test);
      document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
      geocoder.on('result', function(ev) {
        var lat = ev.result.geometry.coordinates[1];
        var lng = ev.result.geometry.coordinates[0];
        var results = leafletPip.pointInLayer([lng, lat], gjLayer);
        if(results.length >= 1){
          if(ev.result.place_name != "Roma, Roma, Italy"){
            $.ajax({
              url:'insert.php',
              type:'POST',
              data:{
                mode: 1,
                lat: lat,
                lng: lng,
                email: document.getElementById('input_email').value,
                street_name : ev.result.place_name,
                recaptcha: grecaptcha.getResponse()
              },
              success: function(done){
                if(done != "error"){
                  $.fn.fullpage.moveTo(3);
                  console.log(done);
                  data.push({lat: lat, lng: lng, id:Number(done)});
                  update_heatmap();
                  swal('Segnalazione Riuscita', 'Grazie per cercare di rendere Roma più pulita!', 'success');
				  grecaptcha.reset();
                }
                else{
                  swal("Errore", "Verifica di essere umano", "error");
                  geocoder.query("Roma"); 
                }
              }
              });
            }
          }
          else{
            swal("Nessuno Risultato", "Questa strada non esiste a Roma", "info")
            geocoder.query("Roma"); 
          }
        });
        map.on('touchmove', function (e) {
          if(cancellare){
            for(var i=0; i<data.length; i++){
              var geojson = {
                "type": "FeatureCollection",
                "features": []
              };
              var linestring = {
                "type": "Feature",
                "geometry": {
                  "type": "LineString",
                  "coordinates": []
                }
              };
              var point = {
                "type": "Feature",
                "geometry": {
                  "type": "Point",
                   "coordinates": [
                     e.lngLat.lng,
                     e.lngLat.lat
                    ]
                },
                "properties": {}
              };
              geojson.features.push(point);
              point = {
                "type": "Feature",
                "geometry": {
                  "type": "Point",
                  "coordinates": [
                    data[i].lng,
                    data[i].lat
                  ]
                },
                "properties": {}
              };
              geojson.features.push(point);
              linestring.geometry.coordinates = geojson.features.map(function(point) {
                return point.geometry.coordinates
              });
              if(turf.lineDistance(linestring).toLocaleString() < 0.009){
                to_delete.push(data[i].id);
                data.splice(i, 1);
                update_heatmap();
              }
            }
          }
        });
        map.on('mousemove', function (e) {
          if(leftButtonDown){
            if(cancellare){
              for(var i=0; i<data.length; i++){
                var geojson = {
                  "type": "FeatureCollection",
                  "features": []
                };
              var linestring = {
                "type": "Feature",
                "geometry": {
                  "type": "LineString",
                  "coordinates": []
                }
              };
              var point = {
                "type": "Feature",
                "geometry": {
                  "type": "Point",
                  "coordinates": [
                    e.lngLat.lng,
                    e.lngLat.lat
                    ]
                },
                "properties": {}
              };
              
              geojson.features.push(point);
              
              point = {
                "type": "Feature",
                "geometry": {
                  "type": "Point",
                  "coordinates": [
                    data[i].lng,
                    data[i].lat
                  ]
                },
                "properties": {}
              };
              
              geojson.features.push(point);
              linestring.geometry.coordinates = geojson.features.map(function(point) {
                return point.geometry.coordinates;
              });
              
              if(turf.lineDistance(linestring).toLocaleString() < 0.009){
                to_delete.push(data[i].id);
                data.splice(i, 1);
                update_heatmap();
              }
            }
          }
        }
      });











            var json_heatmap = GeoJSON.parse(data, {Point: ['lat', 'lng']});

            map.getSource('rome_heatmap').setData(json_heatmap);



            $('#map').circursor();



          

        });



            $("#map").mousedown(function(e){

        // Left mouse button was pressed, set flag

        if(e.which === 1) leftButtonDown = true;

    });

    $("#map").mouseup(function(e){

        // Left mouse button was released, clear flag

        if(e.which === 1) leftButtonDown = false;

    });

    







        function update_heatmap(){



          var json_heatmap = GeoJSON.parse(data, {Point: ['lat', 'lng']});

          map.getSource('rome_heatmap').setData(json_heatmap);

         

        }



        $("#form").submit(function(e) {

          e.preventDefault();

          var address = document.getElementById("input_address").value;

          var civic = document.getElementById("input_civic").value;

          var complete_address = address + " " + civic + ", Roma Roma";

          console.log(complete_address);

          geocoder.query(complete_address); 
        });









        function bottone_cancella_click()

        {

    

            

            var button_confirm_deleting= document.getElementById('button_confirm_deleting');

            if(cancellare)

            {





                cancellare = false;

                document.getElementById("circle_cursor").style.display = 'none';

                map["dragPan"].enable();

                map.getCanvas().style.cursor = "";

                button_confirm_deleting.style.display = "none";

            }

            else 

            {

                cancellare = true;

                document.getElementById("circle_cursor").style.display = 'block';

                map["dragPan"].disable();

                map.getCanvas().style.cursor = "none";

                button_confirm_deleting.style.display = "";

            }

            

        }





        

        function confirm_deleting_click(){



          var user_id_var = <?php if($_SESSION['user']!=''){echo $_SESSION['user'];} else {echo "null";}?>;

          if(user_id_var != null){



            for(var i=0; i<to_delete.length;i++){

              var index = to_delete[i];



              $.ajax({

                url:'insert.php',

                type:'POST',

                data: {

                  mode: 2,

                  id: index,

                  user_id: user_id_var,

                  success: function(data){

                    swal('Bel Lavoro!', 'Pulizia Effettuata Correttamente', 'success');

                  }

                        }

              });

  }

 

  bottone_cancella_click();

          }

ì

}

        var cancellare = false;





        (function ( $ ) {

        

          

        $.fn.circursor = function(  ) {



            

          return this.each(function() {



            var container = $(this);



              $(this).css("cursor", "none");



              $(this).append("<div id='circle_cursor'  style='cursor:none;position: fixed; display:none; pointer-events:none; overflow: visible;'><div style='position: absolute; top: 0px; left: 0px; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); border-radius: 1000px; width: 50px; height: 50px; background-color: cornflowerblue;opacity: 0.3;'></div></div>")

              $(this).mousemove(function (event) {

                if(cancellare)

                {

                $(this).find("#circle_cursor").css('left', event.clientX).css('top', $("#section0").height() + $("#section1").height() + event.clientY  );





                }

                });

                $(this).on('touchmove',function(event){

                if(cancellare)

                {

                  

                  

                $(this).find("#circle_cursor").css('left', event.originalEvent.touches[0].pageX).css('top', $("#section0").height() + $("#section1").height() + event.originalEvent.touches[0].pageY);

                }

                });





          });



        };



        }( jQuery ));





    </script>

  </body>



</html>



<?php 



    

    $sql = "SELECT id_marker, lat, lng FROM markers WHERE state=0";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        // output data of each row

        while($row = mysqli_fetch_assoc($result)) {

          echo"<script>



          

        data.push({lat: ".$row["lat"].", lng: ".$row["lng"].", id : ".$row["id_marker"]."});



          </script>

          

         ";

        

          

        }

    } 

    

    

    

    mysqli_close($conn);

    

    





?>



