<?php
    class Database {
        //DB params
        private $host = 'acw2033ndw0at1t7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name ='qq98270q4ma5o9jx';
        private $username = 't468dm1c55876o10';
        private $password = getenv(JAWS_DB);
        private $conn;

        //DB connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: '. $e->getMessage();
            }

            return $this->conn;
        }
    }
