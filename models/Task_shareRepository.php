<?php
class TaskShareRepository {
         public static function share($taskId, $userId, $ownerId) {
        $db = DB::connect();
        $taskId = (int)$taskId;
        $userId = (int)$userId;
        $ownerId = (int)$ownerId;

        $check = $db->query("SELECT task_id FROM task_share WHERE task_id=$taskId AND user_id=$userId");
        if ($check->fetch_assoc()) {
            return;
        }

        $db->query("INSERT INTO task_share (task_id, user_id) SELECT id, $userId FROM task WHERE id=$taskId AND user_id=$ownerId");
    }


           public static function getTaskByUserId($userId) {
        $db = DB::connect();
        $userId = (int)$userId;
        $result = $db->query("SELECT task.*, category.name AS category_name FROM task INNER JOIN task_share ON task_share.task_id = task.id LEFT JOIN category ON category.id = task.category_id WHERE task_share.user_id=$userId ORDER BY task.title ASC");
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $task = new Task($row['id'], $row['user_id'], $row['title'], $row['description'], $row['date'], $row['done'], $row['category_id']);
            $task->setCategoryName($row['category_name']);
            $tasks[] = $task;
        }
        return $tasks;
    }
       
}