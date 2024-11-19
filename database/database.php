<?php
require(__DIR__ . '/../config/init.php');

class Database
{
    private $host;
    private $database;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->host = DB_SERVER;
        $this->database = DB_DATABASE;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
    }

    public function getDatabase()
    {
        $db = "mysql:host={$this->host};dbname={$this->database}";

        if (!isset($this->conn)) {
            $this->conn = new PDO($db, $this->username, $this->password);
        }
        return $this->conn;
    }

    private function bindParams($stmt, $params)
    {
        foreach ($params as $key => $value) {
            $stmt->bindParam(":" . $key, $value);
        }
    }

    public function selectData($tableName, $id, $isDeleted = 0)
    {
        if (empty($id)) {
            $query = "SELECT * FROM {$tableName} WHERE isDeleted = {$isDeleted}";
            $result = $this->getDatabase()->query($query);
            return $result;
        } else {
            $query =  "SELECT * FROM {$tableName} WHERE isDeleted = {$isDeleted} and id = {$id} ";
            $result =  $this->getDatabase()->query($query);
            return $result;
        }
    }

    public function insertData($tableName, $data)
    {
        try {
            $keys = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";
            $stmt = $this->getDatabase()->prepare($query);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function updateData($tableName, $data, $id)
    {
        try {
            $setClause = '';
            foreach ($data as $key => $value) {
                $setClause .= "{$key} = :{$key}, ";
            }
            $setClause = rtrim($setClause, ', ');
            $query = "UPDATE {$tableName} SET {$setClause} WHERE id = :id";
            $stmt = $this->getDatabase()->prepare($query);

            $data['id'] = $id;

            $stmt->execute($data);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function deleteData($tableName, $id)
    {
        $query = "DELETE FROM {$tableName} WHERE id={$id}";
        // $query = "UPDATE {$tableName} SET isDeleted=1 WHERE id={$id}";
        $stmt = $this->getDatabase()->prepare($query);
        $stmt->execute();
    }


    public function restoreRecord($tableName)
    {
        $query = "UPDATE {$tableName} SET isDeleted=0 WHERE isDeleted=1";
        $stmt  = $this->getDatabase()->prepare($query);
        $stmt->execute();
    }

    public function getProductsWithCategories()
    {
        try {
            $query = "SELECT *
                    FROM 
                        products
                    LEFT JOIN 
                        categories ON products.category_id = categories.id
                    WHERE 
                        products.isDeleted = 0";
                        
            $stmt = $this->getDatabase()->query($query);
            
            if ($stmt === false) {
                throw new PDOException("Error executing query: " . implode(", ", $this->getDatabase()->errorInfo()));
            }
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error fetching data: " . $e->getMessage();
        }
    }
    
}
