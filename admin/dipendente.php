<?php


session_start();

if($_SESSION['user']==''){

 header("Location:login.php");

}
else if($_SESSION['level'] != 1)
{
	 header("Location: ../index.php");
}



?>



<html>

    <head>



        <meta charset="utf-8">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />



    <meta name="description" content="">

    <meta name="author" content="">



    <title>Nuovo Dipendente</title>



    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">

    <link href="../vendor/lato-font.css" rel="stylesheet">

    <link href="../vendor/catamaran-font.css" rel="stylesheet">

    <link href="../vendor/moli-font.css" rel="stylesheet">

    <script src='../vendor/recaptcha.js'></script>

    <script src="../vendor/sweetalert.min.js"></script>

    <link href="../css/new-age.min.css" rel="stylesheet">



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

                            <a class="nav-link js-scroll-trigger" href="index.php">Admin</a>

                            </li>

                        </ul>

                    </div>

                </div>

            </nav>

            <div class="container" style="top: 20%; position: relative;">

                <div class="row">

                    <div class="col-md-8 mx-auto">

                        <h2 class="section-heading">Nuovo Dipendente</h2>

                        <form method="POST" id="form">

                            <div class="form-group">

                                <label for="input_address">Nome</label>

                                <input name="name" autocomplete="on" type="text" class="form-control" id="input_address" required>

                            </div>

                            <div class="form-group">

                                <label for="input_civic">Email</label>

                                <input name="mail" autocomplete="on" type="email" class="form-control" id="input_civic" required>

                            </div>

                            <div class="form-group">

                                <label for="input_civic">Tipo</label>

                                <input name="type" autocomplete="on" type="text" class="form-control" id="input_civic" required>

                            </div>

                            <div class="form-group">

                                <label for="input_civic">Livello</label>

                            

                                <select class="form-control" name="level">

                                    <option value="0">0</option>

                                    <option value="1">1</option>

                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary">Crea</button>

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



include("config.php");



if(isset($_POST["mail"])){
    $email = mysqli_real_escape_string($conn,$_POST["mail"]);


    $sql = "SELECT email FROM users WHERE email ='".$email."'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {



        $name = mysqli_real_escape_string($conn,$_POST["name"]); 


        $level = mysqli_real_escape_string($conn, $_POST["level"]); 

        $type = mysqli_real_escape_string($conn, $_POST["type"]); 

        $hash = md5( rand(0,1000)); 





        $sql = "INSERT INTO users (email, level, name, type, hash)

        VALUES ('$email', '$level', '$name', '$type','$hash')";



        if ($conn->query($sql) === TRUE) {



     

    



        $subject = "Attiva Account";

        



        

        $htmlContent = '

        



        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

            <meta name="viewport" content="width=device-width"/>



        </head>

        <body>

        

        <table class="body-wrap" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;text-align:center;width:100% !important;height:100%;background-color:#f8f8f8;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;" >

            <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                <td class="container" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;display:block !important;clear:both !important;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;" >

        

                    <!-- Message start -->

                    <table style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >

                        <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                            <td align="center" class="masthead" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;padding-top:80px;padding-bottom:80px;padding-right:0;padding-left:0;background-color:#fdcc52;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:white;" >

        

                                <h1 style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.25;font-size:32px;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:90%;text-transform:uppercase;" >Progetto Esame</h1>

        

                            </td>

                        </tr>

                        <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                            <td class="content" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:30px;padding-bottom:30px;padding-right:35px;padding-left:35px;" >

        

                                <h2 style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;margin-bottom:20px;line-height:1.25;font-size:28px;" >'.$_POST["name"].'</h2>

        

                                <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >Benvenuto!</p>

                                <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >Clicca il bottone sottostante per impostare la password e attivare il tuo account</p>

                                <table style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >

                                    <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                                        <td align="center" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                                            <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >

                                                <a href="https://filippoleonardi.altervista.org/progetto/admin/password.php?code='.$hash.'" class="button" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;text-decoration:none;display:inline-block;color:white;background-color:#fdcc52;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;border-style:solid;border-color:#fdcc52;border-width:10px 20px 8px;font-weight:bold;border-radius:4px;" >Attiva Account</a>

                                            </p>

                                        </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                    </table>

        

                </td>

            </tr>

            <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

            

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
            echo "<script>swal('Dipendente Creato', 'Riceverà a breve una email per attivare il suo account', 'success'); </script>";
        }

        else{
            echo "<script>swal('Errore', 'Errore nell'inviare l'email, 'error');
                </script>";
        }

        



}

        }

        else{

            echo "<script>swal('Errore', 'Email già esistente', 'error');

            </script>";

        }

    }

?>