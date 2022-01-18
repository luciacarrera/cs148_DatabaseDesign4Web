<?php
class DataBase{
    // public variable
    public $pdo = '';
    
    // for debugging purposes
    const DB_DEBUG = false;

    public function __construct($dataBaseUser, $whichDataBasePassword, $dataBaseName) {
        $this->pdo = null;

        // passwords
        $path = '';
        if(substr(BASE_PATH, -6) == 'admin/'){
            $path = '../lib/' . $path;
        }
        include $path . 'pass.php';
        $DataBasePassword = '';

        switch ($whichDataBasePassword) {
            case 'r':
                $DataBasePassword = $dbReader;
                break;
            case 'w':
                $DataBasePassword = $dbWriter;
                break;
        }

        $query = NULL;
        $dsn = 'mysql:host=webdb.uvm.edu;dbname=';

        // debugging to see if everything typed correctly
        if(self::DB_DEBUG){
            echo "<p>Try connecting with phpMyAdmin with these credentials. </p>";
            echo '<p> Username: ' . $dataBaseUser . '</p>';
            echo '<p>DSN: ' . $dsn . $dataBaseName. '</p>';
            echo '<p>Password: ' . $DataBasePassword. '</p>';
        }

        //in case there is some type of mistake basic try catch
        try {
            $this->pdo = new PDO($dsn . $dataBaseName, $dataBaseUser, $DataBasePassword);

            if(!$this->pdo) {
                if(self::DB_DEBUG) echo '<p>You are NOT connected to the database!</p>';
                return 0;
            } else {
                if(self::DB_DEBUG) echo '<p>You are superconnected to the database!</p>';
                return $this->pdo;
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            if (self::DB_DEBUG) echo "<p>An error occurred while connecting to the database: $error_message </p>";
        }
        
         

    } // ends constructor

    public function insert($query, $values=''){
        $status = false;
        $statement = $this->pdo->prepare($query);

        if(is_array($values)){
            $status = $statement->execute($values);

        }else{
            $status = $statement->execute();

        }

        return $status;
    }

    public function delete($query, $values=''){
        $status = false;
        $statement = $this->pdo->prepare($query);

        if(is_array($values)){
            $status = $statement->execute($values);

        }else{
            $status = $statement->execute();

        }

        return $status;
    }

    public function update($query, $values=''){
        print "<p>reached update statement</p>";

        $status = false;
        $statement = $this->pdo->prepare($query);

        
        if(is_array($values)){
            $status = $statement->execute($values);

        }else{
            $status = $statement->execute();

        }

        return $status;
    }

    public function select($query, $values = '') {
        
        // sends query to db and sanitizes a lot of things
        $statement = $this->pdo->prepare($query);

        // if array executes w values if not just executes
        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute();
        }

        // gets all records to array
        $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        // done w statement
        $statement->closeCursor();

        // returns array values from sql statement
        return $recordSet;
    }
    
    // display query function
    function displayQuery($query, $values = '') {
            if ($values != '') {
                $needle = '?'; 
                $haystack = $query;
                foreach ($values as $value) {
                    $pos = strpos($haystack, $needle);
                    if ($pos !== false) {
                        
                        $haystack = substr_replace($haystack, '"' . $value . '"', $pos, strlen($needle));
                    }
                }
                $query = $haystack;
            }
            return $query;
            
    }


} // ends class
?>