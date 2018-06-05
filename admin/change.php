



<html>

    <head>



        <meta charset="utf-8">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />



    <meta name="description" content="">

    <meta name="author" content="">



    <title>Reimposta Password</title>



    

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

                            <li class="nav-item">

                            <a class="nav-link js-scroll-trigger" href="login.php">Login</a>

                            </li>

                        </ul>

                    </div>

                </div>

            </nav>

            <div class="container" style="top: 20%; position: relative;">

                <div class="row">

                    <div class="col-md-8 mx-auto">

                        <h2 class="section-heading">Reimposta Password</h2>

                        <form method="POST" id="form">

                            <div class="form-group">

                                <label for="input_address">Email</label>

                                <input name="mail" autocomplete="on" type="text" class="form-control" id="input_address" required>

                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6LcgPVoUAAAAAGY31Rv30bTT82RX6oKdboU35twG"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Reimposta</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
        <script src="../vendor/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../js/new-age.min.js"></script>
    <body>

</html>





<?php

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



if(isset($_POST["mail"])){


    $result = CheckCaptcha($_POST['g-recaptcha-response']);
    if ($result['success']) {
    $email = mysqli_real_escape_string($conn,$_POST["mail"]);


    $sql = "SELECT email FROM users WHERE email ='".$email."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {

     




        $hash = md5( rand(0,1000)); 



 

        $sql = "UPDATE users SET hash='$hash' WHERE email='$email'";



        if ($conn->query($sql) === TRUE) {



     

    


        $subject = "Reimposta Password";

        



        

        $htmlContent = '

        



        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

            <meta name="viewport" content="width=device-width"/>



        </head>

        <body>

        

        <style type="text/css">

        

        * { margin: 0; padding: 0; font-size: 100%; font-family: Avenir Next, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; line-height: 1.65; }



        img { max-width: 100%; margin: 0 auto; display: block; }

        

        body, .body-wrap { text-align: center; width: 100% !important; height: 100%; background: #f8f8f8; }

        

        a { color: #fdcc52; text-decoration: none; }

        

        a:hover { text-decoration: underline; }

        

        .text-center { text-align: center; }

        

        .text-right { text-align: right; }

        

        .text-left { text-align: left; }

        

        .button { display: inline-block; color: white; background: #fdcc52; border: solid  #fdcc52; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }

        

        .button:hover { text-decoration: none; }

        

        h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

        

        h1 { font-size: 32px; }

        

        h2 { font-size: 28px; }

        

        h3 { font-size: 24px; }

        

        h4 { font-size: 20px; }

        

        h5 { font-size: 16px; }

        

        p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

        

        .container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important; }

        

        .container table { width: 100% !important; border-collapse: collapse; }

        

        .container .masthead { padding: 80px 0; background: #fdcc52; color: white; }

        

        .container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

        

        .container .content { background: white; padding: 30px 35px; }

        

        .container .content.footer { background: none; }

        

        .container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

        

        .container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

        

        .container .content.footer a:hover { text-decoration: underline; }

        </style>

        <table class="body-wrap">

            <tr>

                <td class="container">

        

                    <!-- Message start -->

                    <table>

                        <tr>

                            <td align="center" class="masthead">

        

                                <h1>Progetto Esame</h1>

        

                            </td>

                        </tr>

                        <tr>

                            <td class="content">

    
                                <p>Clicca il bottone sottostante per reimpostare la password del tuo account</p>

                                <table>

                                    <tr>

                                        <td align="center">

                                            <p>

                                                <a href="https://filippoleonardi.altervista.org/progetto/admin/password.php?code='.$hash.'" class="button">Reimposta Password</a>

                                            </p>

                                        </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                    </table>

        

                </td>

            </tr>

            <tr>

            

            </tr>

        </table>

        </body>

        </html>



';







        // Set content-type header for sending HTML email

        $headers = "MIME-Version: 1.0" . "\r\n";

        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



        // Additional headers

        $headers .= 'From: Progetto Esame<no-reply@progettoesame.com>' . "\r\n";

        $headers .= 'Cc: no-reply@progettoesame.com' . "\r\n";





        // Send email

        if(mail($email,$subject,$htmlContent,$headers)){

            echo "<script>swal('Email Inviata', 'Riceverai a breve una email per cambiare la password del tuo account', 'success'); </script>";

        }

        else{

            echo "<script>swal('Errore', 'Errore nell'inviare l'email, 'error');

            </script>";







        }

        

    

    }



}

else{

    echo "<script>swal('Email Inviata', 'Riceverai a breve una email per cambiare la password del tuo account', 'success'); </script>";

}

    }
    else{  
        echo "<script>swal('Errore', 'Verifica di essere umano', 'error'); </script>";
    }

}
    

?>