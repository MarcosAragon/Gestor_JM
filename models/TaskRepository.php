<?php
class TaskRepository {

    // Obtener todas las tareas de un usuario
    // añadir atributos que sea para ordenar por orden alfabetico o por fecha
    public static function getTaskByUserId($userId,$order="default") {
        $db = DB::connect();
        $orderAvailable[]="title";
        $orderAvailable[]="date";

        if($order=="default"||$order=="title"){
            $orderquery="title";
        }
        else if($order=="date"){
            $orderquery="date";
        }
        
        $result = $db->query("SELECT * FROM task WHERE user_id=$userId ORDER BY $orderquery ASC");
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