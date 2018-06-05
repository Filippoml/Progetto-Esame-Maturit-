<?php

session_start();


if($_SESSION['user']==''){

 header("Location:login.php");

}

if(!isset($_GET["id"])){
    header("Location:./not_found.html");
}

include("config.php");


$id = mysqli_real_escape_string($conn,$_GET['id']);





$sql = "SELECT name FROM users WHERE id =".$id;

$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result) > 0) {

    // output data of each row



    while($row = mysqli_fetch_assoc($result)) {

        $name = $row['name'];        

    }

}
else{
    header("Location:./not_found.html");
}



$sql = "SELECT * FROM markers id_user =".$id;

$result = mysqli_query($conn, $sql);

$test = 0;

if (mysqli_num_rows($result) > 0) {

    // output data of each row



    while($row = mysqli_fetch_assoc($result)) {

  

$test++;

    }

}



$sql = "SELECT * FROM markers WHERE state=1 AND id_user =".$id;

$result = mysqli_query($conn, $sql);

$test2 = 0;

if (mysqli_num_rows($result) > 0) {

    // output data of each row

  



    while($row = mysqli_fetch_assoc($result)) {

        

$test2++;

    

      

    }

}



$sql = "SELECT * FROM markers WHERE state=2 AND id_user =".$id;

$result = mysqli_query($conn, $sql);

$test3 = 0;

if (mysqli_num_rows($result) > 0) {

    // output data of each row

  



    while($row = mysqli_fetch_assoc($result)) {

$test3++;



    }

}

$test9 = [];

$test7 = [];

$test8 = [];

$mese = [];

$mediatempo = [];

$mesi = array("Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott","Nov", "Dic");

setlocale(LC_TIME, 'it_IT');

for($x = 5; $x > -1; $x--){



    $date = date("d-m-Y", strtotime(date( "d-m-Y", strtotime( date("d-m-Y"))) . "-".$x." month" ));

    $mon = date("m",strtotime($date));

    array_push($mese, $mesi[(int)$mon - 1]);

    $sql = "SELECT * FROM markers WHERE DATE_FORMAT(`date_created`, '%m') = '$mon' AND id_user =".$id;



    $result = mysqli_query($conn, $sql);

    $test4 = 0;

    $test5 = 0;

    $test6 = 0;

    if (mysqli_num_rows($result) > 0) {



        while($row = mysqli_fetch_assoc($result)) {

            

            $test4++;

            if($row["state"]==1){

            $test5++;

            }

            else if($row["state"]==2){

            $test6++;

            }

        }



    }

    array_push($test9, $test4);

    array_push($test7, $test5);

    array_push($test8, $test6);


    $sql = "SELECT DATEDIFF(date_deleted, date_created) as tempo FROM markers WHERE DATE_FORMAT(`date_deleted`, '%m') = '$mon'AND id_user =".$id;
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    if ($numrows > 0) {


        $accomulatore = 0;
        while($row = mysqli_fetch_assoc($result)) {

            $accomulatore = $accomulatore + $row["tempo"];
        }
        array_push($mediatempo, round($accomulatore/$numrows));
    }
    else{
        array_push($mediatempo, "null");
    }
}



    ?>





<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <title>Utente</title>

    <!-- Bootstrap Core CSS -->

    <link href="../css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom CSS -->



    <link href="../css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">

    <link href="../css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">

    <link href="../css/lib/owl.carousel.min.css" rel="stylesheet" />

    <link href="../css/lib/owl.theme.default.min.css" rel="stylesheet" />

    <link href="../css/helper.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">



</head>



<body class="fix-header fix-sidebar">

    <!-- Preloader - style you can find in spinners.css -->

    <div class="preloader">

        <svg class="circular" viewBox="25 25 50 50">

			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>

    </div>

    <!-- Main wrapper  -->

    <div id="main-wrapper">

        <!-- header header  -->

        <div class="header">

            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <!-- Logo -->

                <div class="navbar-header">

                <a style="width: 100%;" class="navbar-brand" href="../">

                    <!-- Logo icon -->

                    <b style="text-align: left;

    padding-left: 25px;width: 100%;" >Progetto Esame</b>

                </a>

            </div>

                <!-- End Logo -->

                <div class="navbar-collapse">

                    <!-- toggle and nav items -->

                    <ul class="navbar-nav mr-auto mt-md-0">

                        <!-- This is  -->

                        

                        <!-- Messages -->

                       

                        <!-- End Messages -->

                    </ul>

                    <!-- User profile and search -->

                    <ul class="navbar-nav my-lg-0">



                        

                        <!-- End Messages -->

                        <!-- Profile -->

                        <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-user"></i></a>

                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">

                                <ul class="dropdown-user">

                                    <li><a href="index.php"><i class="ti-dashboard"></i> Pannello di Controllo</a></li>

                                     <li><a href="register2.php"><i class="ti-user"></i> Nuovo Dipendente</a></li>
                                     <li><a href="change.php"><i class="fa fa-key"></i> Reimposta Password</a></li>
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>

                                </ul>

                            </div>

                        </li>

                    </ul>

                </div>

            </nav>

        </div>

        <!-- End header header -->

        <!-- Left Sidebar  -->

        

        <!-- Page wrapper  -->

        <div style="margin-left: 0;">

            <!-- Bread crumb -->

            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Visuale Dipendente: <?php echo $name; ?></h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="../">Home</a></li>

                        <li class="breadcrumb-item"> <a href="index.php">Pannello di Controllo</a></li>

                        <li class="breadcrumb-item active">Visuale Dipendente</li>

                    </ol>

                </div>

            </div>

            <!-- End Bread crumb -->

            <!-- Container fluid  -->

            <div class="container-fluid">





                <div class="row bg-white m-l-0 m-r-0 box-shadow ">



                    <!-- column -->

                    <div class="col-lg-8">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Grafico Segnalazioni Dipendente</h4>

                                <div id="extra-area-chart"></div>

                            </div>

                        </div>

                    </div>

                    <!-- column -->



                    <!-- column -->

                    <div class="col-lg-4">

                    

                        <div style="width: 100%; text-align: center;" class="card-body">



                            <div style="margin-top:50px;" id="morris-donut-chart"/>

                        </div>

                    </div>

                    </div>

                    <!-- column -->

                </div>


                <div class="row bg-white m-l-0 m-r-0 box-shadow ">



                    <!-- column -->

                    <div class="col-lg-8">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Grafico Tempistiche Risoluzione Dipendente</h4>

                                <div id="extra-area-chart2"></div>

                            </div>

                        </div>

                    </div>

                    <!-- column -->



                    


                    <!-- column -->

                </div>







                <!-- End PAge Content -->

            </div>

            <!-- End Container fluid  -->

            <!-- footer -->

            

            <!-- End footer -->

        </div>

        <!-- End Page wrapper  -->

    </div>

    <!-- End Wrapper -->

    <!-- All Jquery -->

    <script src="../js/lib/jquery/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->

    <script src="../js/lib/bootstrap/js/popper.min.js"></script>

    <script src="../js/lib/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->

    <script src="../js/jquery.slimscroll.js"></script>

    <!--Menu sidebar -->

    <script src="../js/sidebarmenu.js"></script>

    <!--stickey kit -->

    <script src="../js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>

    <!--Custom JavaScript -->





    <!-- Amchart -->

     <script src="../js/lib/morris-chart/raphael-min.js"></script>







	<script src="../js/lib/calendar-2/moment.latest.min.js"></script>

    <!-- scripit init-->

    <script src="../js/lib/calendar-2/semantic.ui.min.js"></script>

    <!-- scripit init-->

    <script src="../js/lib/calendar-2/prism.min.js"></script>

    <!-- scripit init-->

    <script src="../js/lib/calendar-2/pignose.calendar.min.js"></script>

    <!-- scripit init-->

    <script src="../js/lib/calendar-2/pignose.init.js"></script>



    <script src="../js/lib/owl-carousel/owl.carousel.min.js"></script>

    <script src="../js/lib/owl-carousel/owl.carousel-init.js"></script>

    <script src="../js/scripts.js"></script>

    <!-- scripit init-->



    <script src="../js/lib/morris-chart/morris.js"></script>

    

        <script>





Morris.Donut( {

		element: 'morris-donut-chart',

		data: [{

			label: "Segnalazioni Risolte Totali",

			value:  <?php echo $test2 ?>

        }],

		resize: true,

		colors: [ '#4680ff' ]

	} );





    

	// Extra chart

	Morris.Area( {

		element: 'extra-area-chart',

		data: [ {

				period: "<?php echo $mese[0] ?>",

				risolti: <?php echo $test9[0] ?>

        }, {

				period: "<?php echo $mese[1] ?>",

				risolti: <?php echo $test9[1] ?>

        }, {

				period: "<?php echo $mese[2] ?>",

				risolti: <?php echo $test9[2] ?>

        }, {

				period: "<?php echo $mese[3] ?>",

				risolti: <?php echo $test9[3] ?>

        }, {

				period: "<?php echo $mese[4] ?>",

				risolti: <?php echo $test9[4] ?>

        }, {

				period: "<?php echo $mese[5] ?>",

				risolti: <?php echo $test9[5] ?>

        }





        ],

		lineColors: [ '#4680ff', '#4680ff'],

		xkey: 'period',

		ykeys: [ 'risolti'],

		labels: [ 'risolti' ],

		pointSize: 0,

		lineWidth: 0,

        parseTime: false,

		resize: true,

		fillOpacity: 0.8,

		behaveLikeLine: true,

		gridLineColor: '#e0e0e0',

		hideHover: 'auto'



	} );



    Morris.Area( {

element: 'extra-area-chart2',

data: [ {

        period: "<?php echo $mese[0] ?>",

        giorni: <?php echo $mediatempo[0] ?>

}, {

        period: "<?php echo $mese[1] ?>",

        giorni: <?php echo $mediatempo[1] ?>

}, {

        period: "<?php echo $mese[2] ?>",

        giorni: <?php echo $mediatempo[2] ?>

}, {

        period: "<?php echo $mese[3] ?>",

        giorni: <?php echo $mediatempo[3] ?>

}, {

        period: "<?php echo $mese[4] ?>",

        giorni: <?php echo $mediatempo[4] ?>

}, {

        period: "<?php echo $mese[5] ?>",

        giorni: <?php echo $mediatempo[5] ?>

}




],

lineColors: [ '#4680ff', '#ffb64d'],

xkey: 'period',

ykeys: [ 'giorni'],

labels: [  'giorni'],

pointSize: 0,

lineWidth: 0,

parseTime: false,

resize: true,

fillOpacity: 0.8,

behaveLikeLine: true,

gridLineColor: '#e0e0e0',

hideHover: 'auto'



} );



jQuery(document).ready(function($) {

    $(".clickable-row").click(function() {

        window.location = $(this).data("href");

    });

});

        </script>

    <script src="../js/custom.min.js"></script>







</body> 

</html>