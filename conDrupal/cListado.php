<?php

$url = 'http://chelo.cloudapp.net/?q=sw/rest';

//PAra obtener datos  (index)
$data = array('index' => true);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

#echo $result;

$obj = json_decode($result,true);

?>