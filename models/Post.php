<?php
    class Post{
        private $conn;
        private $table = 'clothes';
        private $tablebook = 'booking';
        private $tableadmin = 'admins';

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
        public function create($name,$gfor,$afor,$photos,$price,$types,$description){
            $query = 'INSERT INTO ' . $this->table . '(NAME, GFOR, AFOR, PHOTOS, PRICE, TYPES, DESCRIPTION) VALUES (:name, :gfor, :afor, :photos, :price, :types, :description)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':name', $name);
            $stmt->bindparam(':gfor', $gfor);
            $stmt->bindparam('afor', $afor);
            $stmt->bindparam('photos', $photos);
            $stmt->bindparam('price', $price);
            $stmt->bindparam('types', $types);
            $stmt->bindparam('description', $description);
            if($stmt->execute()){
                return true;
            }
            else{
                echo 'error' . $stmt->error;
                return false;
            }
        }
        public function update($id,$name,$gfor,$afor,$price,$types,$description){
            $query = 'UPDATE ' . $this->table . ' SET NAME = :name, GFOR = :gfor, AFOR = :afor, PRICE = :price, TYPES = :types, DESCRIPTION = :description WHERE C_ID = ' . $id;
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':name', $name);
            $stmt->bindparam(':gfor', $gfor);
            $stmt->bindparam('afor', $afor);
            $stmt->bindparam('price', $price);
            $stmt->bindparam('types', $types);
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
        public function create_booking($cid,$email,$name,$phone){
            $query = 'INSERT INTO ' . $this->tablebook . '(B_ID, C_ID, EMAIL, CLIENT_NAME, CLIENT_PHONE) VALUES (:bid, :cid, :email, :name, :phone)';
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':bid', $bid);
            $stmt->bindparam(':cid', $cid);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':name', $name);
            $stmt->bindparam(':phone', $phone);
            if($stmt->execute()){
                return true;
            }
            else{
                echo 'error' . $stmt->error;
                return false;
            }
        }
        public function read_booking(){
            $query = 'SELECT * FROM '.$this->tablebook;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt; 
        }
        public function read_byg($gender){
            $query = 'SELECT * FROM ' . $this->table . ' WHERE GFOR = '. ' "' . $gender. '" ';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;   
        }
        public function read_bya($age){
            $query = 'SELECT * FROM ' . $this->table . ' WHERE AFOR = '. ' "' . $age. '" ';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;   
        }
        public function read_byt($types){
            $query = 'SELECT * FROM ' . $this->table . ' WHERE TYPES = '. ' "' . $types. '" ';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;   
        }
        public function read_admin(){
            //create query
            $query = 'SELECT * FROM '.$this->tableadmin;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt; 
        }
        public function update_admin($username,$password,$superadmin){
            $query = 'UPDATE ' . $this->tableadmin . ' SET USERNAME = :username, PASSWORD = :password WHERE SUPERADMIN = '. ' "' . $superadmin. '" ';
            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':password', $password);
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