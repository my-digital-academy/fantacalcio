<?php

   include("assets/phpbase/classes.php");
   include_once("assets/phpbase/session.php");

   secure_session_start();

   //Get request data of AjaxCall
   $request = file_get_contents('php://input');
   //Transform requested data into array
   $request = json_decode($request,true);
   //Call JSON method that returns right method
   //for this type of request
   $json_response = JSON::analizeRequest($request);

   if(empty($request['data'])){
       if($json_response == 'all'){
           $id = (int)$_SESSION['utente']->getId();
           $json_response = new JSON();
           $json_response = $json_response->getJson($id);
       }
       else{
           $json_response = $json_response();
       }
   }
   else{
       $json_response = $json_response($request['data'][0]);
   }
   //This method controls if response is json
   if(gettype($json_response) != "string"){
       $json_response = json_encode($json_response);
   }
   //Response
   echo $json_response;