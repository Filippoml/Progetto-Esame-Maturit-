


<html>

    <head>



        <meta charset="utf-8">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />



    <meta name="description" content="">

    <meta name="author" content="">



    <title>Crea Password</title>



    

        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
        <link href="../vendor/lato-font.css" rel="stylesheet">
        <link href="../vendor/catamaran-font.css" rel="stylesheet">
        <link href="../vendor/moli-font.css" rel="stylesheet">
        <script src="../vendor/sweetalert.min.js"></script>
        <link href="../css/new-age.min.css" rel="stylesheet">
        <script src='../vendor/recaptcha.js'></script>
        <script src="../vendor/jquery.min.js"></script>

    <head>

    <body>



    

        <div class="text-center" style="background-color:#03A9F4; height: 100%; width: 100%;" id="fullpage">

            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">

                <div class="container">

                    <a class="navbar-brand js-scroll-trigger" href="../">Progetto Esame</a>

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

                    Menu

                    <i class="fa fa-bars"></i>

                    </button>

                    <div class="collapse navbar-collapse" id="navbarResponsive">

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item">

                            <a class="nav-link js-scroll-trigger" href="../">Home</a>

                            </li>

                        </ul>

                    </div>

                </div>

            </nav>

            <div class="container" style="top: 20%; position: relative;">

                <div class="row">

                    <div class="col-md-8 mx-auto">

                        <h2 class="section-heading">Crea Password</h2>

                        <form method="POST" id="form" novalidate="novalidate">

                            <div class="form-group">

                                <label for="input_address">Password</label>

                                <input name="password" autocomplete="off" type="password" class="form-control" id="password" required>

                            </div>
                            
                            <div class="form-group">

                                <label for="input_address">Conferma Password</label>

                                <input name="confirmPassword" autocomplete="off" type="password" class="form-control" id="password2" required>

                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6LcgPVoUAAAAAGY31Rv30bTT82RX6oKdboU35twG"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Crea</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../js/new-age.min.js"></script>

    <body>

          <script>
       $("#form").submit(function(e) {
           if($("#password").val() != $("#password2").val()){
            swal('Errore', 'Le passowrd non corrispondono', 'error');
            e.preventDefault();
           }
        });

              </script>
</html>




<?php

if(!isset($_GET["code"]) && (!isset($_POST["password"]))){
    
    header("Location:./not_found.html");
}

function CheckCaptcha($userResponse) {

    $fields_string = '';

    $fields = array(

        'secret' => '6LcgPVoUAAAAALEQ0sG83hVdfj2X9G4u8bhh23Mu',

        'response' => $userResponse

    );

    foreach($fields as $key=>$value)

    $fields_string .= $key . '=' . $value . '&';

    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');

    curl_setopt($ch, CURLOPT_POST, count($fields));

    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $res = curl_exec($ch);

    curl_close($ch);

    return json_decode($res, true);

}



        include("config.php");

    $code = mysqli_real_escape_string($conn,$_GET["code"]);

    if(isset($_GET["code"])){




        $sql = "SELECT * FROM users WHERE hash ='".$code."'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0){

            header("Location:./not_found.html");

        }

    }



    if(isset($_POST["password"])){

        $result = CheckCaptcha($_POST['g-recaptcha-response']);

        if ($result['success']) {
        $password = mysqli_real_escape_string($conn,$_POST["password"]);



        function rand_string($length) {

            $str="";

            $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            $size = strlen($chars);

            for($i = 0;$i < $length;$i++) {

            $str .= $chars[rand(0,$size-1)];

            }

            return $str;

        }

        $p_salt = rand_string(20); 

        $site_salt="subinsblogsalt";

        $salted_hash = hash('sha256', $password.$site_salt.$p_salt);



        $sql= "UPDATE users SET password='$salted_hash', psalt='$p_salt', hash=NULL WHERE hash ='". $code."'";

        if ($conn->query($sql) === TRUE) {
            session_destroy();
            echo "<script>swal('Password Creata', 'Ora accedi con i nuovi dati di accesso', 'success').then( function(val) {document.location.href = 'login.php';}); </script>";
            } else {
                echo "<script>swal('Errore', 'Riprova più tardi', 'error'); </script>";
            } 
    }
    else{  
        echo "<script>swal('Errore', 'Verifica di essere umano', 'error'); </script>";
    }
    
}



?>