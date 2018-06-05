<?php



session_start();


include("admin/config.php");

$mode = mysqli_real_escape_string($conn,$_POST['mode']);




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



switch ($mode){

    case 1:



        $result = CheckCaptcha($_POST['recaptcha']);

        if ($result['success']) {

        $lat = mysqli_real_escape_string($conn,$_POST['lat']);

        $lng = mysqli_real_escape_string($conn,$_POST['lng']);

        $street_name = mysqli_real_escape_string($conn,$_POST['street_name']);

        $hash = md5( rand(0,1000)); 



        $sql = "INSERT INTO markers (lat, lng, hashcode, street_name, state)

        VALUES ('$lat', '$lng', '$hash','$street_name', '0')";



        if ($conn->query($sql) === TRUE) {

            $last_id = mysqli_insert_id($conn);

            echo $last_id;







            $to = mysqli_real_escape_string($conn,$_POST['email']);

        $subject = "Segnalazione Inviata con Successo";

        



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

        

                                <h2 style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;margin-bottom:20px;line-height:1.25;font-size:28px;" >'.$street_name.'</h2>

        

                                <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >Clicca il bottone sottostante appena la tua segnalazione sarà stata risolta per rimuoverla dalla mappa</p>

        

                                <table style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >

                                    <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                                        <td align="center" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;" >

                                            <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >

                                                <a href="https://filippoleonardi.altervista.org/progetto/index.php?code='.$hash.'" class="button" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;text-decoration:none;display:inline-block;color:white;background-color:#fdcc52;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;border-style:solid;border-color:#fdcc52;border-width:10px 20px 8px;font-weight:bold;border-radius:4px;" >Rimuovi Segnalazione</a>

                                            </p>

                                        </td>

                                    </tr>

                                </table>

                                <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Avenir Next, Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >Grazie per cercare di rendere Roma più pulita!</p>

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

        if(mail($to,$subject,$htmlContent,$headers)){

            $successMsg = 'Email has sent successfully.';

        }

        else{

            $errorMsg = 'Email sending fail.';







        }







        } else {

            echo "Error: " . $sql . "<br>" . $conn->error;

        }

    }

    else{

        echo "error";

    }

    break;



    case 2:

        if($_SESSION['user'] != ''){

        $id = mysqli_real_escape_string($conn,$_POST['id']);

        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);



        $sql = "UPDATE markers SET state = '1', id_user = '$user_id', date_deleted=NOW() WHERE id_marker='$id'";



        if ($conn->query($sql) === TRUE) {

            echo "Record deleted successfully";

        } else {

            echo "Error: " . $sql . "<br>" . $conn->error;

        }

    }

    break;

}



?>