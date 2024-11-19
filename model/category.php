<?php
require(__DIR__ . '/../config/init.php');

class Category extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('categories');
    }

    public function addCategory($data)
    {

        $stmt = $this->db->insertData($this->tableName, $data);
        return $stmt;
    }

    public function getAllCategories()
    {
        $stmt = $this->db->selectData($this->tableName, null, 0);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        return $categories;
    }

    public function getCategoryById($id){
        $stmt = $this->db->selectData($this->tableName, $id);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $data) {
    
        $stmt = $this->db->updateData($this->tableName, $data, $id);
    
        return $stmt;
    }
    

    public function deleteCategory($id) {
        try {
            $stmt = $this->db->deleteData($this->tableName, $id);
            return $stmt;
        } catch (PDOException $e){
            echo "Error : " . $e->getMessage();
        }
    }

    public function restoreCategory($id)
    {
        try {
            $query = "UPDATE {$this->tableName} SET is_deleted = 0 WHERE id = :id";
            $stmt = $this->db->getDatabase()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
