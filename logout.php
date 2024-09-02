<?php

session_start();

if (isset($_POST['userId'])) 

{   

    $userId = $_POST['userId'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://bankofhope.oktapreview.com/api/v1/users/'.$userId.'/sessions',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: SSWS 00pTjzEcbWYkGpmqvKczLXGZZbmpc7M7P6TcHfYHR3'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    unset($_SESSION['data']);

    header('Location: login.php');

}else{
    echo "No user session found";
}
