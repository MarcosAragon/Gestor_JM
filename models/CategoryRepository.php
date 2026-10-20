<?php
class CategoryRepository {

    // Todas las categorías de un usuario, por orden alfabético
    public static function getByUserId($userId) {
        $db = DB::connect();
        $userId = (int)$userId;
        $result = $db->query("SELECT * FROM category WHERE user_id=$userId ORDER BY name ASC");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['user_id'], $row['name']);
        }
        return $categories;
    }

    // Crear una categoría
    public static function create($userId, $name) {
        $db = DB::connect();
        $userId = (int)$userId;
        $name = $db->real_escape_string($name);
        $db->query("INSERT INTO category (user_id, name) VALUES ($userId, '$name')");
    }

    // Borrar una categoría (solo si es del usuario)
    public static function delete($id, $userId) {
        $db = DB::connect();
        $id = (int)$id;
        $userId = (int)$userId;
        $db->query("DELETE FROM category WHERE id=$id AND user_id=$userId");
    }
}
?>