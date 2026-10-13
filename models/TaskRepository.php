<?php
class TaskRepository {

    // Obtener todas las tareas de un usuario
    public static function getTaskByUserId($userId) {
        $db = DB::connect();
        $result = $db->query("SELECT * FROM task WHERE user_id=$userId ORDER BY date ASC");
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = new Task($row['id'], $row['user_id'], $row['title'], $row['description'], $row['date'], $row['done']);
        }
        return $tasks;
    }

    // Crear una nueva tarea
    public static function create($userId, $title, $description, $date) {
        $db = DB::connect();
        $db->query("INSERT INTO task (user_id, title, description, date, done) VALUES ($userId, '$title', '$description', '$date', 0)");
    }

    // Eliminar una tarea
    public static function delete($id) {
        $db = DB::connect();
        $db->query("DELETE FROM task WHERE id=$id");
    }

    // Cambiar estado: pendiente ↔ realizada
    public static function toggleDone($id) {
        $db = DB::connect();
        $db->query("UPDATE task SET done=IF(done=1, 0, 1) WHERE id=$id");
    }
}
?>