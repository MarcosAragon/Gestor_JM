<?php
class Category {
    private $id;
    private $user_id;
    private $name;

    public function __construct($id, $user_id, $name) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
    }

    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getName() { return $this->name; }

    public function setId($id){ $this->id = $id; }
    public function setUserId($user_id){ $this->user_id = $user_id; }
    public function setName($name){ $this->name = $name; }
}
?>