<?php
class User {
    private $id;
    private $username;
    private $tasks=[];

    public function __construct($id, $username) {
        $this->id = $id;
        $this->username = $username;
        $this->tasks=TaskRepository::getTasksByUser($id);
    }

    public function getId() { return $this->id; }
    public function getUsername() { return $this->name; }
    
}
?>