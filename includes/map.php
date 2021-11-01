<?php
header("Content-type: text/html; charset=utf-8");
ini_set( "display_errors", 1 );
error_reporting( E_ALL );

const API_KEY = 'Z0TyTOt9Shzfs01IsWTLkKi7ctt14Yyuv849uRRc-RM';

function map($city, $country){
    $url = "https://image.maps.ls.hereapi.com/mia/1.6/mapview?w=300&h=300&z=10&co=$country&ci=$city&apiKey=" . API_KEY;

    // Open image file, note binary data should be written to using 'w+' mode.
    $imageFile = fopen('assets/map/map_' .$city. '.jpg', 'w+');

    // Setup options.
    $options = [
        // Save response to the image file.
        CURLOPT_FILE => $imageFile,
        // Don't verify (auto-trust) certificates.
        CURLOPT_SSL_VERIFYPEER => false
    ];

    // Setup curl request.
    $curl_session = curl_init($url);
    curl_setopt_array($curl_session, $options);

    // Send request.
    curl_exec($curl_session);

    // Check HTTP status response.
    $httpStatusCode = curl_getinfo($curl_session, CURLINFO_HTTP_CODE);

    // Close session & file when finished.
    curl_close($curl_session);
    fclose($imageFile);

    echo 'assets/map/map_'.$city.'.jpg';
}


