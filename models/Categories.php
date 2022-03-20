<?php
    class Categories {
        // DB stuff
        private $conn;
        private $table = 'Categories';

        // Quotes properties
        public $id;
        public $category;

        //constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //read all
        public function read() {
            // create query
            $query = 'SELECT
                    c.id,
                    c.category
                FROM
                ' . $this->table . ' c
                ORDER BY
                    c.id DESC';

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
                    c.id,
                    c.category
                FROM
                    ' . $this->table . ' c
                WHERE
                    c.id = ?
                LIMIT 0,1';  
            
            //prepare statment
            $stmt = $this->conn->prepare($query);

            //bind ID
            $stmt->bindParam(1, $this->id);
            
            // execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->category = $row['category'];
        }

        public function create() {
            //create qu
            $query = 'INSERT INTO ' . 
                    $this->table . '
                SET 
                    id = :id,
                    category = :category';
            //prpare
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->category = htmlspecialchars(strip_tags($this->category));

            //bind params

            //$stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);

            //execute querry

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //update categories
        public function update() {
            //create qu
            $query = 'UPDATE ' . 
                    $this->table . '
                SET
                    id = :id,
                    category = :category
                WHERE
                    id = :id';

            //prpare
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->category = htmlspecialchars(strip_tags($this->category));

            //bind params

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);

            //execute querry

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //delete category
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