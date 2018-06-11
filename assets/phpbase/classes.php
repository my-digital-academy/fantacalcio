<?php

include_once("basescripts.php");

function secure_session_start() {
	$session_name = 'secure_session'; // Imposta un nome di sessione
	$secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
	$httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
	ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
	$cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
	session_start(); // Avvia la sessione php.
	session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

trait connessione{
    public function connetti(){
        return new PDO(HOST, USER, PASSWORD);
    }
}

class utenti {
    use connessione;

    /*<<<DECLARATIONS */

    private $id;
    private $username;
    private $password;

    private function setAll($arr_utente){
        $this->username = $arr_utente['username'];
        $this->password = $arr_utente['password'];
    }

    public function getId(){
        return $this->id;
    }

    private function setId($id){
        $this->id = $id;
    }

    public function getUsername(){
        return $this->username;
    }

    private function setUsername($username){
        $this->username = $username;
    }

    public function getPassword(){
        return $this->password;
    }

    private function setPassword($password){
        $this->password = $password;
    }

    /*DECLARATIONS>>>*/
    /*<<<METHODS*/
    static function selectUtente($param){
        $select = "";
        //Controllo se il parametro è una stringa o un intero per
        //cambiare la query
        if(gettype($param) == "string"){
            $select = "SELECT * FROM utenti WHERE username='" . $param . "'";
        }
        else{
            $select = "SELECT * FROM utenti WHERE id=" . $param;
        }
        $pdo = self::connetti();
        $stmt = $pdo->query($select);
        $stmt->execute();
        $utente = new utenti();
        $utente->setAll($stmt->fetch(PDO::FETCH_ASSOC));
        return $utente;
    }
    /*METHODS>>>*/
}

class squadre {
    
}

class calciatori {
    
}

class giornate {

}

class formazioni {

}

class tesserati {
    
}