<?php
class Database{
    public $pdo = '';

    const DB_DEBUG = false;

    public function __construct($dataBaseUser, $whichDataBasePassword, $dataBaseName){
        $this->pdo = null;

        // passwords be sure to add pass.php to <div class="gitignore"></div>

        include 'pass.php';
        $DataBasePassword = '';

        switch ($whichDataBasePassword) {
            case 'r':
                $DataBasePassword = $dbReader;
                break;
            case 'w':
                $DataBasePassword = $dbWriter;
                break;
        }
        $path = 'lib/';
        if (substr(BASE_PATH, -6) == 'admin/'){
            $path = '../' . $path;
        }

        include $path . 'pass.php';
        
        $query = NULL;

        $dsn = 'mysql:host=webdb.uvm.edu;dbname=';

        if (self::DB_DEBUG){
            echo "<p>Try connecting with phpMyAdmin with these credentials. </p>";
            echo '<p>Username: ' . $dataBaseUser;
            echo '<p>DSN: ' . $dsn . $dataBaseName;
            echo '<p>Password: ' . $DataBasePassword;
        }

        try {
            $this->pdo = new PDO($dsn . $dataBaseName, $dataBaseUser, $DataBasePassword);

            if (!$this->pdo) {
                if (self::DB_DEBUG) echo '<p>You are NOT connected to the database!</p>';
                return 0;
            } else{
                if (self::DB_DEBUG) echo '<p>You are connected to the database!</p>';
                return $this->pdo;
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            if (self::DB_DEBUG) echo "<p>An error occured while connecting to the database : $error_message</p>";
        }
    }
// to display code
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
    //original
    public function select($query, $values = '') {

        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $statement->execute($values);
        } else {
            $statement->execute();
        }
        $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $recordSet; 
    }
    //added in last part

   public function insert($query, $values = ''){
        $status = false;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $status = $statement->execute($values);
        } else {
            $status = $statement->execute();
        }
        return $status;
    } 

    public function update($query, $values = ''){
        $status = false;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $status = $statement->execute($values);
        } else {
            $status = $statement->execute();
        }
        return $status;
    } 

    public function delete($query, $values = ''){
        $status = false;
        $statement = $this->pdo->prepare($query);

        if (is_array($values)) {
            $status = $statement->execute($values);
        } else {
            $status = $statement->execute();
        }
        return $status;
    } 
}
?>
