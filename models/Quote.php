<?php
    
    class Quote {
        // DB stuff
        private $conn;
        private $table = 'quotes';

        // Quotes properties
        public $id;
        public $quote;
        public $categoryId;
        public $authorId;

        //constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //read all
        public function read() {
            // create query
            $query = 'SELECT
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId
                FROM
                    ' . $this->table . ' q
                ORDER BY
                    q.id DESC';

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
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId,
                    a.author,
                    c.category
                FROM
                    ' . $this->table . ' q
                LEFT JOIN 
                    authors a ON q.authorId = a.id
                LEFT JOIN 
                    categories c ON q.categoryId = c.id
                WHERE
                    q.id = ?
                LIMIT 0,1';  
            
            //prepare statment

            $stmt = $this->conn->prepare($query);

            //bind ID
            $stmt->bindParam(1, $this->id);
            
            // execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id']; 
            $this->quote = $row['quote'];
            $this->author = $row['author'];
            $this->category = $row['category'];
        }

        //get all with spisific authorId
        public function read_authorid() {
            // create query
            $query = 'SELECT
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId,
                    a.author,
                    c.category
                FROM
                    ' . $this->table . ' q
                LEFT JOIN 
                    authors a ON q.authorId = a.id
                LEFT JOIN 
                    categories c ON q.categoryId = c.id
                WHERE
                    q.authorId = ?
                ORDER BY 
                    q.id DESC';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //bind author Id
            $stmt->bindParam(1, $this->authorId);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //get all with spisific authorId
        public function read_categoryid() {
            // create query
            $query = 'SELECT
                    q.id,
                    q.quote,
                    q.categoryId,
                    q.authorId,
                    a.author,
                    c.category
                FROM
                    ' . $this->table . ' q
                LEFT JOIN 
                    authors a ON q.authorId = a.id
                LEFT JOIN 
                    categories c ON q.categoryId = c.id
                WHERE
                    q.categoryId = ?
                ORDER BY
                    q.id DESC';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //bind categoryId
            $stmt->bindParam(1, $this->categoryId);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //get all with spisific authorId
        public function read_aid_cid() {
            // create query
            $query = 'SELECT
                q.id,
                q.quote,
                q.categoryId,
                q.authorId,
                a.author,
                c.category
            FROM
                ' . $this->table . ' q
            LEFT JOIN 
                authors a ON q.authorId = a.id
            LEFT JOIN 
                categories c ON q.categoryId = c.id
            WHERE
                q.authorId = ? AND q.categoryId = ?';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->authorId);
            $stmt->bindParam(2, $this->categoryId);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        //id = :id,

        //create post 
        public function create() {
            //create qu
            $query = 'INSERT INTO ' . 
                    $this->table . '
                SET
                    id = :quote,
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId';
            //prpare
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            //bind params

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            //execute querry

            try {
                if($stmt->execute()) {
                    return true;
                }
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
                return false;
            }

            //printf("Error: %s.\n", $stmt->error);

            
        }
        
        //update quote
        public function update() {
            //create qu
            $query = 'UPDATE ' . 
                    $this->table . '
                SET

                    id = :id,
                    quote = :quote,
                    authorId = :authorId,
                    categoryId = :categoryId
                WHERE
                    id = :id';

            //prpare
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            //$this->id = htmlspecialchars(strip_tags($this->id));
            //bind params

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);
            //$stmt->bindParam(':id', $this->id);

            //execute querry

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //delete quote
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
    
