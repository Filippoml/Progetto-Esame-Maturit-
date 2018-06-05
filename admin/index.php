<?php


session_start();

if($_SESSION['user']==''){

 header("Location:login.php");

}
else if($_SESSION['level'] != 1)
{
	 header("Location: ../index.php");
}



include("config.php");


$sql = "SELECT * FROM markers";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // output data of each row

    $test = 0;

    

    while($row = mysqli_fetch_assoc($result)) {

$test++;

    }

}



$sql = "SELECT * FROM markers WHERE state=1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // output data of each row

  

    $test2 = 0;

    while($row = mysqli_fetch_assoc($result)) {

$test2++;

    

      

    }

}



$sql = "SELECT * FROM markers WHERE state=2";

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

$mediatempo = [];

$mese = [];

$mesi = array("Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott","Nov", "Dic");

setlocale(LC_TIME, 'it_IT');

    for($x = 5; $x > -1; $x--){



    $date = date("d-m-Y", strtotime(date( "d-m-Y", strtotime( date("d-m-Y"))) . "-".$x." month" ));


    $mon = date("m",strtotime($date));

    array_push($mese, $mesi[(int)$mon - 1]);

    $sql = "SELECT * FROM markers WHERE DATE_FORMAT(`date_deleted`, '%m') = '$mon'";
    


    $result = mysqli_query($conn, $sql);

    $test4 = 0;

    $test5 = 0;

    $test6 = 0;

    if (mysqli_num_rows($result) > 0) {



        while($row = mysqli_fetch_assoc($result)) {

            



            if($row["state"]==1){

            $test5++;

            }

            else if($row["state"]==2){

            $test6++;

            }

        }



    }

    $sql = "SELECT * FROM markers WHERE DATE_FORMAT(`date_created`, '%m') = '$mon'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {



        while($row = mysqli_fetch_assoc($result)) {

            $test4++;
        }
    }

    array_push($test9, $test4);

    array_push($test7, $test5);

    array_push($test8, $test6);

    $sql = "SELECT DATEDIFF(date_deleted, date_created) as tempo FROM markers WHERE DATE_FORMAT(`date_deleted`, '%m') = '$mon'";
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



    <title>Pannello di Controllo</title>

    <!-- Bootstrap Core CSS -->

    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
    <link href="../css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
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

                        

                    </ul>

                    <!-- User profile and search -->

                    <ul class="navbar-nav my-lg-0">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-user"></i></a>

                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">

                                <ul class="dropdown-user">

                                    <li><a href="dipendente.php"><i class="ti-user"></i> Nuovo Dipendente</a></li>
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

        <div style="margin-left: 0;" class="respons">

            <!-- Bread crumb -->

            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Pannello di Controllo</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="../">Home</a></li>

                        <li class="breadcrumb-item active">Pannello di Controllo</li>

                    </ol>

                </div>

            </div>

            <!-- End Bread crumb -->

            <!-- Container fluid  -->

            <div class="container-fluid">

                <!-- Start Page Content -->

                <div class="row">

                    <div class="col-md-3">

                        <div class="card p-30">

                            <div class="media">

                                <div class="media-left meida media-middle">

                                    <span><i class="fa fa-flag f-s-40 color-primary"></i></span>

                                </div>

                                <div class="media-body media-text-right">

                                    <h2><?php echo $test ?></h2>

                                    <p class="m-b-0">Segnalazioni Totali</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card p-30">

                            <div class="media">

                                <div class="media-left meida media-middle">

                                    <span><i class="fa fa-envelope f-s-40 color-success"></i></span>

                                </div>

                                <div class="media-body media-text-right">

                                    <h2><?php echo $test3 ?></h2>

                                    <p class="m-b-0">Segnalazioni Cancellate</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card p-30">

                            <div class="media">

                                <div class="media-left meida media-middle">

                                    <span><i class="fa fa-trash f-s-40 color-warning"></i></span>

                                </div>

                                <div class="media-body media-text-right">

                                    <h2><?php echo $test2 ?></h2>

                                    <p class="m-b-0">Segnalazioni Risolte</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card p-30">

                            <div class="media">

                                <div class="media-left meida media-middle">

                                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>

                                </div>

                                <div class="media-body media-text-right">

                                    <h2>5</h2>

                                    <p class="m-b-0">Numero Dipendenti</p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row bg-white m-l-0 m-r-0 box-shadow ">



                    <!-- column -->

                    <div class="col-lg-8">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Grafico Segnalazioni</h4>

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

                                <h4 class="card-title">Grafico Tempistiche Risoluzione</h4>

                                <div id="extra-area-chart2"></div>

                            </div>

                        </div>

                    </div>

                    <!-- column -->



                    


                    <!-- column -->

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card" style="padding: 0px;">

                            <div class="card-title">

                                <h4 style="margin:10px;">Lista Dipendenti</h4>

                            </div>

                            <div class="card-body">

                                <div style="max-height:500px;" class="table-responsive">

                                    <table class="table">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Nome</th>

                                                <th>Funzione</th>

                                                <th>Segnalazioni Risolte</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                        $sql = "SELECT *, COUNT(markers.id_user) as total FROM users LEFT JOIN markers ON users.id = markers.id_user GROUP BY (users.id) ORDER BY total DESC";

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {

                                            // output data of each row

                                        

                       

                                            while($row = mysqli_fetch_assoc($result)) {



                                             

                                                echo '<tr style="cursor: pointer;" class="clickable-row" data-href="user.php?id='.$row["id"].'">';

                                                echo '<td>';

                                                echo '<div class="round-img">';

                                                echo '<i class="ti-user"></i>';

                                                echo '</div>';

                                                echo '</td>';

                                                echo '<td>'.$row["name"].'</td>';

                                                echo '<td><span>'.$row["type"].'</span></td>';

                                                echo '<td><span>'.$row["total"].'</span></td>';

                                                echo '</tr>';

                                           

                                            }

                                        }



                                        mysqli_close($conn);



                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

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

		data: [ {

			label: "Segnalazioni Totali",

			value: <?php echo $test ?>,



        }, {

			label: "Segnalazioni Risolte",

			value:  <?php echo $test2 ?>

        },

        {

			label: "Segnalazioni Cancellate",

			value:  <?php echo $test3 ?>

        }],

		resize: true,

		colors: [ '#4680ff', '#ffb64d', '#26DAD2' ]
      
	} );





    

	// Extra chart

	Morris.Area( {

		element: 'extra-area-chart',

		data: [ {

				period: "<?php echo $mese[0] ?>",

				totali: <?php echo $test9[0] ?>,

				risolte: <?php echo $test7[0] ?>,

				cancellate: <?php echo $test8[0] ?>

        }, {

				period: "<?php echo $mese[1] ?>",

				totali: <?php echo $test9[1] ?>,

				risolte: <?php echo $test7[1] ?>,

				cancellate: <?php echo $test8[1] ?>

        }, {

				period: "<?php echo $mese[2] ?>",

				totali: <?php echo $test9[2] ?>,

				risolte: <?php echo $test7[2] ?>,

				cancellate: <?php echo $test8[2] ?>

        }, {

				period: "<?php echo $mese[3] ?>",

				totali: <?php echo $test9[3] ?>,

				risolte: <?php echo $test7[3] ?>,

				cancellate : <?php echo $test8[3] ?>

        }, {

				period: "<?php echo $mese[4] ?>",

				totali: <?php echo $test9[4] ?>,

				risolte: <?php echo $test7[4] ?>,

				cancellate: <?php echo $test8[4] ?>

        }, {

				period: "<?php echo $mese[5] ?>",

				totali: <?php echo $test9[5] ?>,

				risolte: <?php echo $test7[5] ?>,

				cancellate: <?php echo $test8[5] ?>

        }




        ],
        
		lineColors: [ '#4680ff', '#ffb64d', '#26DAD2', ''],

		xkey: 'period',

		ykeys: [ 'totali', 'risolte', 'cancellate'],

		labels: [ 'totali', 'risolte','cancellate'],

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
