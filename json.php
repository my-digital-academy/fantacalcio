<?php

    include("assets/phpbase/classes.php");

    //Get request data of AjaxCall
    $request_data = file_get_contents('php://input');
    //Cast data to integer (because of getJson accept integer param)
    $request_data = (int)$request_data;
    //Create new JSON 
    $json_response = new JSON();
    //Call method to populate JSON
    $json_response = $json_response->getJson($request_data);
    //Response
    echo $json_response;
