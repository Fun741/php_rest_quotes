<?php
    class Database {
        //DB params
        
        /*
        private $host = 'acw2033ndw0at1t7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name ='qq98270q4ma5o9jx';
        private $username = 't468dm1c55876o10';
        private $password = 'thn3v0224bqd1ybr';
        private $conn;
        */
        
        
        /*
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        
        $hostname = $dbparts['acw2033ndw0at1t7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com']; //host name
        $username = $dbparts['t468dm1c55876o10']; //user name
        $password = $dbparts['thn3v0224bqd1ybr']; // password
        $database = ltrim($dbparts['qq98270q4ma5o9jx'],'/'); //database name in workshop
        */
        
        /*
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        
        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');
        
        

        //DB connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: '. $e->getMessage();
            }
            return $this->conn;
        }
        */
    
        function __construct() {
            $url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);
            $this->conn = null;
        }
        

        //DB connect
        public function connect() {

            try {
                
                $hostname = $dbparts['host'];
                $username = $dbparts['user'];
                $password = $dbparts['pass'];
                $database = ltrim($dbparts['path'],'/');
                
                $this->conn = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: '. $e->getMessage();
            }
            return $this->conn;
        }
    
    }
