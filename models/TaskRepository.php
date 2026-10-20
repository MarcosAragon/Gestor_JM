<?php
class TaskRepository {

    // Obtener todas las tareas de un usuario
    // añadir atributos que sea para ordenar por orden alfabetico o por fecha
    public static function getTaskByUserId($userId,$order="default") {
        $db = DB::connect();
        
       $orderquery = "title";
        $orderAvailable[]="date";

   
if($order == "date"){
    $orderquery = "date";
}
        $result = $db->query("SELECT * FROM task WHERE user_id=$userId ORDER BY $orderquery ASC");
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
          $tasks[] = new Task($row['id'], $row['user_id'], $row['title'], $row['description'], $row['date'], $row['done'], $row['category_id']);
        return $tasks;
    }

    }
    // Crear una nueva tarea
      public static function create($userId, $title, $description, $date, $categoryId = null) {
        $db = DB::connect();
        $userId = (int)$userId;
        $title = $db->real_escape_string($title);
        $description = $db->real_escape_string($description);
        $date = $db->real_escape_string($date);

        $categoryValue = "NULL";
        if ($categoryId != null) {
            $categoryId = (int)$categoryId;
            $check = $db->query("SELECT id FROM category WHERE id=$categoryId AND user_id=$userId");
            if ($check->fetch_assoc()) {
                $categoryValue = $categoryId;
            }
        }

        $db->query("INSERT INTO task (user_id, title, description, date, done, category_id) VALUES ($userId, '$title', '$description', '$date', 0, $categoryValue)");
    }

    // Eliminar una tarea
    public static function delete($id) {
        $db = DB::connect();
        $db->query("DELETE FROM task WHERE id=$id");
    }

    // Cambiar estado: pendiente ↔ realizada
   public static function toggleDone($id, $userId) {
    $db = DB::connect();
    $id = (int)$id;
    $userId = (int)$userId;
    $db->query("UPDATE task SET done=IF(done=1, 0, 1) WHERE id=$id AND (user_id=$userId OR id IN (SELECT task_id FROM task_share WHERE user_id=$userId))");
}
    // Asignar una tarea a una categoría (o quitarla si categoryId está vacío)
    public static function setCategory($taskId, $categoryId, $userId) {
        $db = DB::connect();
        $taskId = (int)$taskId;
        $userId = (int)$userId;

        $categoryValue = "NULL";
        if ($categoryId != "") {
            $categoryId = (int)$categoryId;
            $check = $db->query("SELECT id FROM category WHERE id=$categoryId AND user_id=$userId");
            if ($check->fetch_assoc()) {
                $categoryValue = $categoryId;
            } else {
                return;
            }
        }

        $db->query("UPDATE task SET category_id=$categoryValue WHERE id=$taskId AND user_id=$userId");
    }
}
?>