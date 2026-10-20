<?php
class TaskShareRepository {
    public static function share($taskId, $userId) {
        $db = DB::connect();
        $db->query("INSERT INTO task_share (task_id, user_id) VALUES ($taskId, $userId)");
    }


    public static function getTaskByUserId($userId) {
    $db = DB::connect();
    $result = $db->query("SELECT task.* FROM task INNER JOIN task_share ON task_share.task_id = task.id WHERE task_share.user_id=$userId ORDER BY task.title ASC");
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = new Task($row['id'], $row['user_id'], $row['title'], $row['description'], $row['date'], $row['done']);
    }
    return $tasks;
} 
}