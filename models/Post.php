<?php
    class Post{
        private $conn;
        private $table = 'clothes';

        //post properties
        public $id;
        public $name;
        public $gfor;
        public $afor;
        public $photos;
        public $price;
        public $description;

        //constructor with db
        public function __construct($db){
            $this->conn=$db;
        }

        public function read(){
            //create query
            $query = 'SELECT * FROM '.$this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt; 
        }
        public function read_single($id){
            //create query
            $query = 'SELECT * FROM ' . $this->table . ' WHERE C_ID = '. $id;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function create($name,$gfor,$afor,$photos,$price,$description){
            $query = 'INSERT INTO ' . $this->table . '(NAME, GFOR, AFOR, PHOTOS, PRICE, DESCRIPTION) VALUES (:name, :gfor, :afor, :photos, :price, :description)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':name', $name);
            $stmt->bindparam(':gfor', $gfor);
            $stmt->bindparam('afor', $afor);
            $stmt->bindparam('photos', $photos);
            $stmt->bindparam('price', $price);
            $stmt->bindparam('description', $description);
            if($stmt->execute()){
                return true;
            }
            else{
                echo 'error' . $stmt->error;
                return false;
            }
        }
        public function update($id,$name,$gfor,$afor,$photos,$price,$description){
            $query = 'UPDATE ' . $this->table . ' SET NAME = :name, GFOR = :gfor, AFOR = :afor, PHOTOS = :photos, PRICE = :price, DESCRIPTION = :description WHERE C_ID = ' . $id;
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':name', $name);
            $stmt->bindparam(':gfor', $gfor);
            $stmt->bindparam('afor', $afor);
            $stmt->bindparam('photos', $photos);
            $stmt->bindparam('price', $price);
            $stmt->bindparam('description', $description);
            if($stmt->execute()){
                return true;
            }
            else{
                echo 'error' . $stmt->error;
                return false;
            }
        }
        public function delete($id){
            $query = 'DELETE FROM ' . $this->table . ' WHERE C_ID = :id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':id', $id);
            if($stmt->execute()){
                return true;
            }
            else{
                echo 'error' . $stmt->error;
                return false;
            }
        }
    }

?>