<?php

session_start();

$currentTime = time();
    
$storedOtp = $_SESSION['otp'];
            
$otpCreationTime = $_SESSION['otp_creation_time'];
            
$otpExpiryDuration = $_SESSION['otp_expiry_duration'];     

$data = $_SESSION['data'];

$email = json_decode($data, true);

if (isset($_SESSION['data']) && isset($_SESSION['otp']) && isset($_POST['otp'])) 
{
    
    $receivedOtp = $_POST['otp'];
    
    if(isset($email['profile']['email']))
    {      
            
            // // Handle OTP validation
            if ($receivedOtp == $storedOtp) 
            {
            
                if (($currentTime - $otpCreationTime) <= $otpExpiryDuration)  
                {
                        unset($_SESSION['otp']);
                     
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
        
                        CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/users?activate=true',
        
                        CURLOPT_RETURNTRANSFER => true,
                        
                        CURLOPT_ENCODING => '',
                        
                        CURLOPT_MAXREDIRS => 10,
                        
                        CURLOPT_TIMEOUT => 0,
                        
                        CURLOPT_FOLLOWLOCATION => true,
                        
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        
                        CURLOPT_POSTFIELDS => $data,
                        
                        CURLOPT_HTTPHEADER => array(
                          'Accept: application/json',
                          'Content-Type: application/json',
                          'Authorization: SSWS 00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3'
                        ),
        
                      ));
        
                      $jsonResponse = curl_exec($curl);
        
                      curl_close($curl);
        
                        $responseArray = json_decode($jsonResponse, true);
                      
                        $id = $responseArray['id'];
      
                        $up = curl_init();
                        
                        curl_setopt_array($up, array(
                          CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/groups/00gguipjybTA2xxtK1d7/users/'.$id,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'PUT',
                          CURLOPT_HTTPHEADER => array(
                            'Accept: application/json',
                            'Content-Type: application/json',
                            'Authorization: SSWS 00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3'
                          ),
                        ));
                        
                        $ponse = curl_exec($up);
                        
                        curl_close($up);
                        
                         if (isset($id)) 
                          {
                                unset($_SESSION['data']);
                                session_destroy();
                                echo '<script>
                                      alert("Account activated.");
                                      window.location.href = "login.php";
                                      </script>';                 
                          } else {
                              
                                echo '<script>alert("Check the function"); </script>';
                          }
                     
                } else {
                    $message = "<p style='color: blue;'>OTP Expired. Please try again.</p>";
                    
                }
            }else{
                $message = "<p style='color: red;'>Entered OTP Invalid.</p>";
            }
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Bank Of Hope</title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body class="body">
  <div class="lcontainer">
    <div class="title">Account verification</div>
    <?php if(isset($message)) echo $message; ?>
    <div class="content">
      <form method="post">
           <div class="user-details">
          <div class="input-box">
        <span class="details">Please enter email OTP:</span>
        <input type="text" id="otp" name="otp" maxlength="6" required>
        <div class="button">
          <input class="button" type="submit" name="validate_otp" value="Submit OTP">
        </div>
        </div>
        </div>
    </form>
    
<?php if (($currentTime > $otpCreationTime) && isset($_POST['generate_otp']))  
      
      {
             $otp = rand(100000, 999999); 
    
             $expiryDuration = 1 * 60; 
                    
             $otpCreationTime = time(); 
                    
             $_SESSION['otp'] = $otp;
                    
             $_SESSION['otp_creation_time'] = $otpCreationTime;
                    
             $_SESSION['otp_expiry_duration'] = $expiryDuration;
                    
             $username = $email['profile']['email'];
              
             $firstname = $email['profile']['firstName'];

             $to = $username;
                                            
             $subject = 'Bank Of Hope';
                                            
             $message = '<!DOCTYPE html>
                        <html>
                        
                        <head>
                            <title></title>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        </head>
                        
                        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
                            <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Lato, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Thrilled to have you here! Get ready to dive into your new account. </div>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <!-- LOGO -->
                                <tr>
                                    <td bgcolor="#ff7361" align="center">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ff7361" align="center" style="padding: 0px 10px 0px 10px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                                    <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src=" https://naokta.com/boh.png" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                            <tr>
                                                <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                    <p style="margin: 0;"><p>Hi '. $firstname .' ,</p>Your Bank Of Hope account was just used to activate from a new or unrecognized device, browser or application. 
                                                                    for more details:<a href="https://www.bankofhope.com"> https://www.bankofhope.com</a></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#ffffff" align="left">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                      Account activation OTP:  <td align="center" style="border-radius: 3px;" bgcolor="#ff7361">'.$otp.'</td>
                                                                         <td>OTP valid for 2 min.</td>
                                                                    </tr>
                                                                    
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr> <!-- COPY -->
                                           
                                            <tr>
                                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                    <p style="margin: 0;">Your username is <a href="#"> '.$username.' </a><br>
                                                              Your account sign-in page is <a href="https://naokta.com/poc/login.php">login?</a><br>
                                                              If you experience difficulties accessing your account, you can send a help request to this email <a>support@bankofhope.com</a> <br></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                    <p style="margin: 0;">Thanks for choosing our service,<br>BOH Team</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </body>
                        
                        </html>';
        
                        $headers = 'From: no-reply@bankofhope.com' . "\r\n" .
                                  'Reply-To: no-reply@bankofhope.com' . "\r\n" .
                                  'Content-type:text/html;charset=UTF-8' . "\r\n" .
                                  'MIME-Version: 1.0' . "\r\n" .
                                  'X-Mailer: PHP/' . phpversion();
                        
                        if (mail($to, $subject, $message, $headers)) 
                        {
                          $message = "OTP sent to your email.";       
                        } 
                        else 
                        {
                             echo '<script>
                                alert("Please try again..");
                            </script>';    
                        }
                    
      }             
?>    
    <form name="otpForm" method="post">
        <div class="input-box">
          <div class="button">
          <input class="button" type="submit" name="generate_otp" value="Generate OTP">
          </div>
        </div>
    </form>
    </div>
  </div>
 </div>
</body>

</html>
