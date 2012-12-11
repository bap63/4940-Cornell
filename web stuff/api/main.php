<?php

//TODO:Finish
$request_headers = get_request_headers();

function get_request_headers() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if(substr($key, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
        }
    }
    return $headers;
}

if($request_headers["Accept"] == "text/html"){
    print_r("HTML");
}
else if($request_headers["Accept"] == "text/json"){
    print_r("JSON");
}
else if($request_headers["Accept"] == "application/xml"){
    print_r("XML");
}
else if($request_headers["Accept"] == "text/csv"){
    print_r("CSV");
}
else{
    print_r("Unkown MIME type");
}

?>