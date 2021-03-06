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
        $select = "SELECT s.* FROM squadre s JOIN utenti u ON s.id_utente = u.id WHERE s.id_utente=:id_utente";
        $stmt = $pdo->prepare($select);
        $stmt->bindParam(":id_utente",$id_utente,PDO::PARAM_INT);
        $stmt->execute();
        $squadra = new squadre();
        if($stmt->rowCount() > 0){
            $squadra->setAll($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $squadra;
    }

    static function insertSquadra($data_array){
        $nome_squadra = (string)$data_array[0];
        $id_utente = (int)$data_array[1];
        $id_squadra = 0;

        $pdo = self::connetti();
        $insertTeam = "INSERT INTO squadre(nome,id_utente) VALUES(:nome,:id_utente)";
        $insertPlayer = "INSERT INTO tesserati(id_squadra,id_calciatore) VALUES(:id_squadra,:id_calciatore)";
        $stmt = $pdo->prepare($insertTeam);
        $stmt->bindparam(":nome",$nome_squadra,PDO::PARAM_STR);
        $stmt->bindparam(":id_utente",$id_utente,PDO::PARAM_INT);
        if($stmt->execute()){
            $id_squadra = (int)$pdo->lastInsertId();
            for ($i=2; $i < count($data_array); $i++) {
                $id_calciatore = (int)$data_array[$i];
                $stmtP = $pdo->prepare($insertPlayer);
                $stmtP->bindparam(":id_squadra",$id_squadra,PDO::PARAM_INT);
                $stmtP->bindparam(":id_calciatore",$id_calciatore,PDO::PARAM_INT);
                $stmtP->execute();
            }
            $json = new JSON();
            $json = $json->getJson($id_utente);
            return $json;
        }
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

    static function selectSchierati($id_giornata,$id_utente){
        $lista = [];
        $pdo = self::connetti();
        $select = "SELECT c.* FROM formazioni f JOIN tesserati t ON f.id_calciatore = t.id_calciatore 
                    JOIN calciatori c ON f.id_calciatore = c.id JOIN squadre s ON t.id_squadra = s.id JOIN
                    utenti u ON s.id_utente = u.id WHERE f.id_giornata =" .$id_giornata ." AND u.id =" . $id_utente;
        $stmt = $pdo->query($select);
        if($stmt->execute()){
            $lista = $stmt->fetchAll(PDO::FETCH_CLASS, "calciatori");
        }
        return $lista;
    }

    //This method returns a string with options of a select
    static function selectAllCalciatori(){
        $optionsString = "";
        $pdo = self::connetti();
        $select = "SELECT * FROM calciatori ORDER BY posizione DESC, cognome ASC";
        $stmt = $pdo->query($select);
        if($stmt->execute()){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $optionsString .= "<option value='" . $row['id'] ."'>" . $row['cognome'] . ", " . $row['posizione'] . "</option>";
            }
        }
        return $optionsString;
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

    private function setId($value){
        $this->id = $value;
    }

    private function setData($value){
        $this->data = $value;
    }

    private function setNumero($value){
        $this->numero = $value;
    }

    private function setFormazione($value){
        $this->formazione = $value;
    }

    static function selectGiornate($id_utente){
        $lista = [];
        $pdo = self::connetti();
        $select = "SELECT * FROM giornate";
        $stmt = $pdo->query($select);
        if($stmt->execute()){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $giornata = new giornate();
                $giornata->setId($row['id']);
                $giornata->setData($row['data']);
                $giornata->setNumero($row['numero']);
                $giornata->setFormazione(calciatori::selectSchierati($row['id'],$id_utente));
                $lista[] = $giornata;
            }
        }
        return $lista;
    }
}

class JSON {
    use connection;

    private $json = [];
    const METHODS = [
        "utenti" => [
            "select" => "utenti::selectUtente",
        ],
        "squadre" => [
            "select" => "squadre::selectSquadra",
            "insert" => "squadre::insertSquadra",
        ],
        "calciatori" => [
            "select" => "calciatori::selectAllCalciatori",
        ],
        "all" => [
            "select" => 'all',
        ]
    ];

    private function setJson($id_utente){
        $this->json['utente'] = utenti::selectUtente($id_utente);
        $this->json['squadra'] = squadre::selectSquadra($id_utente);
        $this->json['giornate'] = giornate::selectGiornate($id_utente);
    }

    public function getJson($id_utente){
        $this->setJson($id_utente);
        
        return $this->json;
    }

    static function analizeRequest($request){
        $method = self::METHODS[$request['table']][$request["query"]];
        
        return $method;
    }
}