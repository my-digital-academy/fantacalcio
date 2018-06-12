<?php

include_once("basescripts.php");

trait connection{
    static function connetti(){
        return new PDO(HOST, USER, PASSWORD);
    }
}

class utenti {
    use connection;

    /*<<<DECLARATIONS */

    private $id;
    private $username;
    private $password;

    private function setAll($arr_utente){
        $this->setId($arr_utente['id']);
        $this->setUsername($arr_utente['username']);
        $this->setPassword($arr_utente['password']);
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
    use connection;
    
    private $id;
    private $nome;
    private $utente;

    private function setAll($arr_squadra){
        $this->setId($arr_squadra['id']);
        $this->setNome($arr_squadra['nome']);
        $id_utente = (int)$arr_squadra['id_utente'];
        $this->setUtente($id_utente);
    }

    public function getId(){
        return $this->id;
    }

    private function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    private function setNome($nome){
        $this->nome = $nome;
    }

    public function getUtente(){
        return $this->utente;
    }

    private function setUtente($id){
        $this->utente = utenti::selectUtente($id);
    }

    static function selectSquadra($id_utente){
        $pdo = self::connetti();
        $select = "SELECT * FROM squadre s JOIN utenti u ON s.id_utente = u.id WHERE s.id_utente='" . $id_utente . "'";
        $stmt = $pdo->query($select);
        $stmt->execute();
        $squadra = new squadre();
        $squadra->setAll($stmt->fetch(PDO::FETCH_ASSOC));
        return $squadra;
    }

}

class calciatori {
    
}

class giornate {

}

class formazioni {

}

class tesserati {
    
}