<?php

    include_once("assets/phpbase/session.php");
    include_once('assets/phpbase/loginfunctions.php');

    secure_session_start();

   if(isset($_SESSION['login_string'])){
    // Elimina tutti i valori della sessione.
    $_SESSION = array();
    // Recupera i parametri di sessione.
    $params = session_get_cookie_params();
    // Cancella i cookie attuali.
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    // Cancella la sessione.
    session_destroy();

    header("location: login.php");
    //exit;
  }
  else{
    
  }
?>
  </body>
</html>
