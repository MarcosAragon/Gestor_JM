<?php
class User {
    private $id;
    private $username;

    public function __construct($id, $username) {
        $this->id       = $id;
        $this->username = $username;
    }

    public function getId()       { return $this->id; }
    public function getUsername() { return $this->username; }
 

    public function setId($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
   
}
?>