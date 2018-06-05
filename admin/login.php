<?php


session_start();
if($_SESSION['user']!=''){

    if($_SESSION['level'] == 0){
        header("Location:../index.php");
    }
    if($_SESSION['level'] == 1){
        header("Location:index.php");
    }
}

?>

<html>

    <head>



        <meta charset="utf-8">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />



    <meta name="description" content="">

    <meta name="author" content="">



    <title>Login</title>  

        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
        <link href="../vendor/lato-font.css" rel="stylesheet">
        <link href="../vendor/catamaran-font.css" rel="stylesheet">
        <link href="../vendor/moli-font.css" rel="stylesheet">
        <script src="../vendor/sweetalert.min.js"></script>
        <link href="../css/new-age.min.css" rel="stylesheet">
        <script src='../vendor/recaptcha.js'></script>
    </head>



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
                        <h2 class="section-heading">Login</h2>
                        <form method="POST"  id="form">
                            <div class="form-group">
                                <label for="input_address">Email</label>
                                <input name="mail" autocomplete="on" type="text" class="form-control" id="input_address" required>
                            </div>
                            <div class="form-group">
                                <label for="input_civic">Password</label>
                                <input name="pass" autocomplete="on" type="password" class="form-control" id="input_civic" required>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6LcgPVoUAAAAAGY31Rv30bTT82RX6oKdboU35twG"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <div class="form-group">
                                <a href="change.php" style="margin-top: 10; color: rgba(255,255,255,.7); float:left;">Password Dimenticata?</a>
                            </div>
                        </form>
                    </div>
                </div
            </div>
        </div>
        <script src="../vendor/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../js/new-age.min.js"></script>
    <body>
</html>





<?

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

$email=mysqli_real_escape_string($conn, $_POST['mail']);

$password=mysqli_real_escape_string($conn, $_POST['pass']);

if(isset($_POST) && $email!='' && $password!='') {
    $result = CheckCaptcha($_POST['g-recaptcha-response']);
    if ($result['success']) {

 $sql = "SELECT * FROM users WHERE email='$email'";

 $result = mysqli_query($conn, $sql);

 while($row = mysqli_fetch_assoc($result)){

  $p=$row['password'];

  $p_salt=$row['psalt'];

  $id=$row['id'];

  $level = $row['level'];

 }

 $site_salt="subinsblogsalt";

 $salted_hash = hash('sha256',$password.$site_salt.$p_salt);

 if($p==$salted_hash){

    $_SESSION['level'] = $level;

    $_SESSION['user']=$id;

  if($level == 0){
    echo "<script type='text/javascript'>window.location.href = '../';</script>";
  }

  else if($level == 1){
    echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
  }



  exit();

 }else{



    echo "<script>swal('Password incorretta', 'Accedi con la corretta password', 'error')</script>";

 }

}
else{
    echo "<script>swal('Errore', 'Verifica di essere umano', 'error'); </script>";
}
}

?>