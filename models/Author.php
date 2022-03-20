<?php
    
    class Author {
        // DB stuff
        private $conn;
        private $table = 'authors';

        // Quotes properties
        public $id;
        public $author;

        //constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //read all
        public function read() {
            // create query
            $query = 'SELECT
                    a.id,
                    a.author
                FROM
                ' . $this->table . ' a
                ORDER BY
                    a.id DESC';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //get single
        public function read_single() {
            // create query
            $query = 'SELECT
                    a.id,
                    a.author
                FROM
                    ' . $this->table . ' a
                WHERE
                    a.id = ?
                LIMIT 0,1';  
            
            //prepare statment
            $stmt = $this->conn->prepare($query);

            //bind ID
            $stmt->bindParam(1, $this->id);
            
            // execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //try {
                if (null == $row['id']) {
                    echo json_encode("No Author Found");
                    die();
                }
            //}
            //catch (Exception $e) {
            //    echo "Message: " . $e->getMessage();
            //}
            
            $this->id = $row['id'];
            $this->author = $row['author'];
        
        }

        //create new author
        public function create() {
            //create qu
            $query = 'INSERT INTO ' . 
                    $this->table . '
                SET
                    id = :id,
                    author = :author';
            //prpare
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));

            //bind params

            //$stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            //execute querry

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //update author
        public function update() {
            //create qu
            $query = 'UPDATE ' . 
                    $this->table . '
                SET
                    id = :id,
                    author = :author
                WHERE
                    id = :id';

            //prpare
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->author = htmlspecialchars(strip_tags($this->author));

            //bind params

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            //execute querry

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //delete author
        public function delete() {
            //create qu
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            
            //prep statment
            $stmt = $this->conn->prepare($query);

            //clean id
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind id
            $stmt->bindParam(':id', $this->id);

            //exucute
            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

    }