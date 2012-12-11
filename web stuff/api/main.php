<?php

//TODO:Finish
print_r( get_request_headers() );

function get_request_headers() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if(substr($key, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
        }
    }
    return $headers;
}


?>