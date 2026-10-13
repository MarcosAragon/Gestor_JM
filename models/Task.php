<?php
class Task {
    private $id;
    private $user_id;
    private $title;
    private $description;
    private $date;
    private $done;
    
    
    public function __construct($id, $user_id, $title, $description, $date, $done) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
        $this->done = $done;
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getDate() { return $this->date; }
    public function getDone() { return $this->done; }
    
}
?>