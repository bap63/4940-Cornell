<?php

//TODO:Finish
$request_headers = getBestSupportedMimeType();
//print_r($request_headers);

/*function get_request_headers() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if(substr($key, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
        }
    }
    return $headers;
}*/

if(key($request_headers) == 'text/html'){
    print_r("HTML");
}
else if(key($request_headers) == "text/json"){
    print_r("JSON");
}
else if(key($request_headers) == "application/xml"){
    print_r("XML");
}
else if(key($request_headers) == "text/csv"){
    print_r("CSV");
}
else{
    print_r("Unsupported MIME type");
}


//function adapted from Maciej Łebkowski from http://stackoverflow.com/questions/1049401/how-to-select-content-type-from-http-accept-header-in-php
function getBestSupportedMimeType() {
    // Values will be stored in this array
    $AcceptTypes = Array ();

    // Accept header is case insensitive, and whitespace isn’t important
    $accept = strtolower(str_replace(' ', '', $_SERVER['HTTP_ACCEPT']));
    // divide it into parts in the place of a ","
    $accept = explode(',', $accept);
    foreach ($accept as $a) {
        // the default quality is 1.
        $q = 1;
        // check if there is a different quality
        if (strpos($a, ';q=')) {
            // divide "mime/type;q=X" into two parts: "mime/type" i "X"
            list($a, $q) = explode(';q=', $a);
        }
        // mime-type $a is accepted with the quality $q
        // WARNING: $q == 0 means, that mime-type isn’t supported!
        $AcceptTypes[$a] = $q;
    }
    arsort($AcceptTypes);

    // return the types accepted in descending order
    return $AcceptTypes;
}


?>