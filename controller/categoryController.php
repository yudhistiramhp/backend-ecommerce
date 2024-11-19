<?php
require(__DIR__ . '/../config/init.php');

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function create($data)
    {
        try {
            $this->categoryModel->addCategory($data);
            return true;
        } catch (PDOException $e){
            echo "Error adding Category : " . $e->getMessage();
        }
    }

    public function show($id)
    {
        $result = $this->categoryModel->getCategoryById($id);
        return $result;
    }

    public function destroy($id)
    {
        try {
            $this->categoryModel->deleteCategory($id);
            $result = $this->categoryModel->getCategoryById($id);
            return $result . true;
        } catch (PDOException $e){
            echo "Error deleting Category : " . $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        try {
            $this->categoryModel->updateCategory($id, $data);
            return true;
        } catch (PDOException $e){
            echo "Error updating Category : " . $e->getMessage();
        }
    }

    public function index()
    {
        $result = $this->categoryModel->getAllCategories();
        return $result;
    }
    

}

?>
