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
        TaskRepository::toggleDone($_GET['id'], $_SESSION['user']->getId());
        header('location:index.php');
        exit;
    }

    if ($_GET['a'] == 'delete' && isset($_GET['id'])) {
        TaskRepository::delete($_GET['id'], $_SESSION['user']->getId());
        header('location:index.php');
        exit;
    }
            if ($_GET['a'] == 'set_category' && isset($_POST['task_id']) && isset($_POST['category_id'])) {
        TaskRepository::setCategory($_POST['task_id'], $_POST['category_id'], $_SESSION['user']->getId());
        header('location:index.php');
        exit;
    }

    if($_GET['a'] == 'add_user' && isset($_POST['task_id']) && isset($_POST['username'])){
        $ids = UserRepository::getIdByUsername($_POST['username']);
        if(count($ids) > 0 && $ids[0] != $_SESSION['user']->getId()){
            TaskShareRepository::share($_POST['task_id'], $ids[0], $_SESSION['user']->getId());
        }
        header('location:index.php');
        exit;
    }
}
?>