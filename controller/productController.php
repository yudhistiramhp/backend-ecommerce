<?php
require(__DIR__ . '/../config/init.php');

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function create($data)
    {
        try {
            $this->productModel->addProduct($data);
            return true;
        } catch (PDOException $e){
            echo "Error adding Product : " . $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        try {
            $this->productModel->updateProduct($id, $data);
            return true;
        } catch (PDOException $e){
            echo "Error updating Product : " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $this->productModel->deleteProduct($id);
            $result = $this->productModel->getProductById($id);
            return $result . true;
        } catch (PDOException $e){
            echo "Error deleting Category : " . $e->getMessage();
        }
    }


    public function show($id)
    {
        $result = $this->productModel->getProductById($id);
        return $result;
    }

    public function index()
    {
        $result = $this->productModel->getAllProducts();
        return $result;
    }

}
