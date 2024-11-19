<?php
require(__DIR__ . '/../config/init.php');

class Product extends Model
{
    public function __construct()
    { 
        parent::__construct();
        $this->setTableName('products');  
    }

    public function addProduct($data)
    {
        $stmt = $this->db->insertData($this->tableName, $data);
        return $stmt;
    }

    // public function getAllProductsWithCategories()
    // {
    //     $stmt = $this->db->getProductsWithCategories();
    //     return $stmt;
    // }

    public function getAllProducts()
    {
        $stmt = $this->db->selectData($this->tableName, null, 0);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        return $products;
    }


    public function getProductById($id)
    {
        $query = "SELECT products.*, categories.category_name 
        FROM products products JOIN categories ON products.category_id = categories.id
        WHERE products.id = :id";
    $stmt = $this->db->getDatabase()->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $data) {
        $stmt = $this->db->updateData($this->tableName, $data, $id);
    
        return $stmt;
    }

    public function deleteProduct($id) {
        try {
            $stmt = $this->db->deleteData($this->tableName, $id);
            return $stmt;
        } catch (PDOException $e){
            echo "Error : " . $e->getMessage();
        }
    }

    
    public function restoreProduct($id)
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
?>
