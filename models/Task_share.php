<?php
class Task_share {

    private $task_id;
    private $user_id;
    
    public function __construct($task_id,$user_id){
        $this->task_id = $task_id;
        $this->user_id = $user_id;
    }
    
    public function getUserId(){ return $this->user_id; }
    public function getTaskId(){ return $this->task_id; }

    public function setUserId($user_id){ $this->user_id = $user_id; }
    public function setTaskId($task_id){ $this->task_id = $task_id; }
}
?>