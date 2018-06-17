<?php

    include("assets/phpbase/classes.php");

    //Get request data of AjaxCall
    $request_data = file_get_contents('php://input');
    //Transform requested data into array
    $request_data = json_decode($request_data);
    //Call JSON method that returns right method
    //for this type of request
    $json_response = JSON::analizeRequest($request_data);
    //Call method to populate JSON
    $json_response = $json_response($request_data['data'][0]);
    //Response
    echo $json_response;