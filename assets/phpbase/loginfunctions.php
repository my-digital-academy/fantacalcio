<?php 
    include_once("assets/phpbase/classes.php");

    function login($user, $password) {
        $utente = utenti::selectUtente($user);
        $password = md5($password);
        if(!$utente == false && $utente->getPassword() == $password){
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['utente'] = $utente;
            $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
            return true;
        }
        else{
            return false;
        }
    }
    
    function login_check() {
        // Verifica che tutte le variabili di sessione siano impostate correttamente
        if(isset($_SESSION['utente'], $_SESSION['login_string'])){
            $utente = $_SESSION['utente'];
            $login_string = $_SESSION['login_string'];
            $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
            $utente_controllo = utenti::selectUtente($utente->getUsername());
            $login_check= hash('sha512', $utente_controllo->getPassword().$user_browser);
            return $login_string;
            if ($login_check == $login_string){
                return true;
            }
            else{
                return false;
            }
        }
        else {
            return false;
        }
    }