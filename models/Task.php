<?php
class Task {
    private $id;
    private $user_id;
    private $title;
    private $description;
    private $date;
    private $done;
        private $category_name;

    private $category_id;
    
    
   public function __construct($id, $user_id, $title, $description, $date, $done, $category_id = null) {
    $this->id = $id;
    $this->user_id = $user_id;
    $this->title = $title;
    $this->description = $description;
    $this->date = $date;
    $this->done = $done;
    $this->category_id = $category_id;
}

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getDate() { return $this->date; }
    public function getDone() { return $this->done; }
    
    public function setId($id){ $this->id = $id; }
    public function setTitle($title){ $this->title = $title; }
    public function setDescription($description){ $this->description = $description; }
    public function setDate($date){ $this->date = $date; }
    public function setDone($done){ $this->done = $done; }

    public function getCategoryId() { return $this->category_id; }
public function setCategoryId($category_id){ $this->category_id = $category_id; }
    public function getCategoryName() { return $this->category_name; }
    public function setCategoryName($category_name){ $this->category_name = $category_name; }
    
}
?>