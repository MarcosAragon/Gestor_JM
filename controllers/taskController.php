<?php

if (isset($_GET['a'])) {

    if ($_GET['a'] == 'create' && isset($_POST['title'])) {
        $userId = $_SESSION['user']->getId();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        TaskRepository::create($userId, $title, $description, $date);
        header('location:index.php');
        exit;
    }

    if ($_GET['a'] == 'toggle' && isset($_GET['id'])) {
        TaskRepository::toggleDone($_GET['id']);
        header('location:index.php');
        exit;
    }

    if ($_GET['a'] == 'delete' && isset($_GET['id'])) {
        TaskRepository::delete($_GET['id']);
        header('location:index.php');
        exit;
    }
}
?>