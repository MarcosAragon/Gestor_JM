<?php
class TaskRepository{
    public static function getTaskByUserId($userId){
        $db=DB::connect();
        $query="SELECT * FROM tasks WHERE user_id=$userId";
        $result=$db->query($query);
        $tasks=[];
        while($task=$result->fetch_assoc()){
            $tasks[]= new Task($task['id'], $task['user_id'], $task['title'], $task['description'], $task['date'], $task['done']);
        }
        return $tasks;
    }
}