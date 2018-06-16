<?php

    include("assets/phpbase/classes.php");

    $request_data = file_get_contents('php://input');

    $request_data_obj = json_decode($request_data);

    var_dump($request_data_obj);