<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $email = $_POST['email'];

    $password = $_POST['password'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/users?q='. $email .'&limit=1',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: SSWS 00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $dataArray = json_decode($response);

        if($dataArray[0]->status == 'ACTIVE' && $dataArray[0]->profile->appAccountStatus == 'ACTIVE')
        {
        
            $form_data = [
                       
                "username" => $email,
                
                "password" => $password,
                
                "options" => [
                            "multiOptionalFactorEnroll" => true,
                            "warnBeforePasswordExpired" => true
                        ]
                    ];
            $login = json_encode($form_data);
        
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/authn',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $login,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Cookie: JSESSIONID=3AA10483866A182948CBC0779AE29F08'
            ),
            ));
            
            $response = curl_exec($curl);
             
            curl_close($curl);
            
            $data = json_decode($response, true);

            $_SESSION['data'] = $data;

            header('Location: dashboard.php');

        }
        else
        {
             echo '<script>
                alert("Please check your account status!");
                window.location.href = "login.php";
            </script>';
        }

}

else 

{
    echo "Email not exists.";
}