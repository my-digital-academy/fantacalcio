<?php

include_once("utils.php");

trait connection{
    static function connetti(){
        return new PDO(HOST, USER, PASSWORD);
    }
}

class utenti implements \JsonSerializable{
    use connection;

    //Method to serialize object into JSON 
    public function jsonSerialize(){
        $vars = get_object_vars($this);

        return $vars;
    }


    /*<<<DECLARATIONS */

    private $id;
    private $username;
    private $password;

    private function setAll($arr_utente){
        $this->setId($arr_utente['id']);
        $this->setUsername($arr_utente['username']);
        if(isset($arr_utente['password'])){
            $this->setPassword($arr_utente['password']);
        }
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
            $select = "SELECT id,username FROM utenti WHERE id=" . $param;
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

class squadre implements \JsonSerializable{
    use connection;
    
    private $id;
    private $nome;
    private $tesserati = [];

    //Method to serialize object into JSON 
    public function jsonSerialize(){
        $vars = get_object_vars($this);

        return $vars;
    }

    private function setAll($arr_squadra){
        $this->setId($arr_squadra['id']);
        $this->setNome($arr_squadra['nome']);
        $this->setTesserati();
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

    private function setTesserati(){
        $this->tesserati = calciatori::selectCalciatori($this->id);
    }

    static function selectSquadra($id_utente){
        $pdo = self::connetti();
        $select = "SELECT s.* FROM squadre s JOIN utenti u ON s.id_utente = u.id WHERE s.id_utente='" . $id_utente . "'";
        $stmt = $pdo->query($select);
        $stmt->execute();
        $squadra = new squadre();
        $squadra->setAll($stmt->fetch(PDO::FETCH_ASSOC));
        return $squadra;
    }

}

class calciatori implements \jsonSerializable{
    use connection;

    private $id;
    private $cognome;
    private $nome;
    private $posizione;
    private $squadra;

     //Method to serialize object into JSON 
     public function jsonSerialize()
     {
         $vars = get_object_vars($this);
 
         return $vars;
     }

    private function setId($id){
        $this->id = $id;
    }

    private function setCognome($value){
        $this->cognome = $value;
    }

    private function setNome($value){
        $this->nome = $value;
    }

    private function setPosizione($value){
        $this->posizione = $value;
    }

    private function setSquadra($value){
        $this->squadra = $value;
    }

    static function selectCalciatori($id_squadra){
        $lista = [];
        $pdo = self::connetti();
        $select = "SELECT c.* FROM calciatori c JOIN tesserati t ON c.id = t.id_calciatore WHERE t.id_squadra =" . $id_squadra;
        $stmt = $pdo->query($select);
        if($stmt->execute()){
            $lista = $stmt->fetchAll(PDO::FETCH_CLASS, "calciatori");
        }
        return $lista;
    }

    static function selectSchierati($id_giornata,$id_squadra){
        $lista = [];
        $pdo = self::connetti();
        $select = "SELECT * FROM formazioni f JOIN tesserati t ON f.id_calciatore = t.id_calciatore 
                    JOIN calciatori c ON f.id_calciatore = c.id JOIN squadre s ON t.id_squadra = s.id 
                    WHERE f.id_giornata =" .$id_giornata ." AND s.id =" . $id_squadra;
        $stmt = $pdo->query($select);
        if($stmt->execute()){
            $lista = $stmt->fetchAll(PDO::FETCH_CLASS, "calciatori");
        }
        return $lista;
    }

}

class giornate implements \jsonSerializable{
    use connection;

    private $id;
    private $data;
    private $numero;
    private $formazione = [];
    //private $formazione;

    //Method to serialize object into JSON 
    public function jsonSerialize(){
        $vars = get_object_vars($this);

        return $vars;
    }

    private function set($value){
        $this->id = $value;
    }

    private function setData($value){
        $this->data = $value;
    }

    private function setNumero($value){
        $this->numero = $value;
    }

    static function selectGiornate(){
        $lista = [];
        $pdo = self::connetti();
        $select = "SELECT * FROM giornate g JOIN formazioni f ON g.id = f.id_giornata WHERE g.id=1";
        $stmt = $pdo->query($select);
        if($stmt->execute()){
            $lista = $stmt->fetchAll(PDO::FETCH_CLASS, "giornate");
        }
        return $lista;
    }
}

class JSON {
    use connection;

    private $utente;
    private $squadra;
    private $giornate = [];
    private $json = [];


    private function setUtente($id){
        $this->utente = utenti::selectUtente($id);
    }
    
    private function setSquadra($id){
        $this->squadra = squadre::selectSquadra($id);
    }

    private function setGiornate(){
        $this->giornate = giornate::selectGiornate();
    }

    private function setJson(){
        $this->json['utente'] = $this->utente;
        $this->json['squadra'] = $this->squadra;
        var_dump($this->giornate);
        $this->json['giornate'] = $this->giornate;
    }

    private function setObj($id){
        $this->setUtente($id);
        $this->setSquadra($id);
        $this->setGiornate();
        $this->setJson();
    }

    public function getJson($id){
        $this->setObj($id);
        return json_encode($this->json, JSON_PRETTY_PRINT);
    }
}