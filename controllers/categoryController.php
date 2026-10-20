<?php

if (isset($_SESSION['user']) && isset($_GET['a'])) {

    if ($_GET['a'] == 'create' && isset($_POST['name'])) {
        $name = trim($_POST['name']);
        if ($name != "") {
            CategoryRepository::create($_SESSION['user']->getId(), $name);
        }
        header('location:index.php');
        exit;
    }

    if ($_GET['a'] == 'delete' && isset($_GET['id'])) {
        CategoryRepository::delete($_GET['id'], $_SESSION['user']->getId());
        header('location:index.php');
        exit;
    }
}
?>