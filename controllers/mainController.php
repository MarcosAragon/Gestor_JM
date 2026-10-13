<?php
require_once("db.php");
require_once("models/Task.php");
require_once("models/TaskRepository.php");
require_once("models/User.php");

session_start();

if(isset($_GET['c'])){
    if($_GET['c']=='user'){
        require_once('controllers/userController.php');
    }
    if($_GET['c']=='task'){
        require_once('controllers/taskController.php');
    }
}

if(isset($_GET['login'])){
    require_once('views/loginView.phtml');
    exit;
}

if(isset($_GET['register'])){
    require_once('views/registerview.phtml');
    exit;
}

// Si no hay sesión, mostramos solo los links y paramos
if(!isset($_SESSION['user'])){
    require_once('views/guestView.phtml');
    exit;
}

// Usuario logueado: cargamos sus tareas y mostramos la vista principal
$tasks = TaskRepository::getTaskByUserId($_SESSION['user']->getId());
require_once('views/mainView.phtml');