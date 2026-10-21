<?php
class TaskRepository {

    // Obtener todas las tareas de un usuario
    // añadir atributos que sea para ordenar por orden alfabetico o por fecha
        public static function getTaskByUserId($userId, $order="default", $categoryId=0) {
        $db = DB::connect();
        $userId = (int)$userId;
        $categoryId = (int)$categoryId;

        $orderquery = "title";
        if ($order == "date") {
            $orderquery = "date";
        }

        $where = "user_id=$userId";
        if ($categoryId > 0) {
            $where = $where." AND category_id=$categoryId";
        }

        $result = $db->query("SELECT * FROM task WHERE $where ORDER BY $orderquery ASC");
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = new Task($row['id'], $row['user_id'], $row['title'], $row['description'], $row['date'], $row['done'], $row['category_id']);
        }
        return $tasks;
    }
    // Crear una nueva tarea
         // Crear una nueva tarea (sin categoría; se asigna después)
    public static function create($userId, $title, $description, $date) {
        $db = DB::connect();
        $userId = (int)$userId;
        $title = $db->real_escape_string($title);
        $description = $db->real_escape_string($description);
        $date = $db->real_escape_string($date);
        $db->query("INSERT INTO task (user_id, title, description, date, done) VALUES ($userId, '$title', '$description', '$date', 0)");
    }

    // Eliminar una tarea
        public static function delete($id, $userId) {
        $db = DB::connect();
        $id = (int)$id;
        $userId = (int)$userId;
        $db->query("DELETE FROM task WHERE id=$id AND user_id=$userId");
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