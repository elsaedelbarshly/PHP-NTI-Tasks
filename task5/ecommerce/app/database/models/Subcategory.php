<?php 

namespace app\database\models;
use app\database\config\connection;

class Subcategory extends connection 
{
    private $id,$name_en,$name_ar,$status,$image,$category_id,$created_at,$updated_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName_en()
    {
        return $this->name_en;
    }

    public function setName_en($name_en)
    {
        $this->name_en = $name_en;
    }

    public function getName_ar()
    {
        return $this->name_ar;
    }

    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCategory_id()
    {
        return $this->category_id;
    }

    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function all(string $columns = "*",string $order = "id")
    {
        $query = "SELECT $columns FROM `sub_categories` ORDER BY $order";
        return $this->runDQL($query);
    }

    public function getSubsByCats()
    {
        $query = "SELECT `id`,`name_en` FROM `sub_categories` WHERE `category_id` = {$this->category_id} ";
        return $this->runDQL($query);
    }

    public function find()
    {
        $query = "SELECT `id`,`name_en` FROM `sub_categories` WHERE `id` = {$this->id} ";
        return $this->runDQL($query);
    }
}