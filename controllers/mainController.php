<?php
require_once("db.php");
require_once("models/Task.php");
require_once("models/TaskRepository.php");
require_once("models/User.php");
require_once("models/Task_shareRepository.php");
require_once("models/Task_share.php");
require_once("models/UserRepository.php");
require_once("models/Category.php");
require_once("models/CategoryRepository.php");



session_start();

if(isset($_GET['c'])){
    if($_GET['c']=='user'){
        require_once('controllers/userController.php');
    }
    if($_GET['c']=='task'){
        require_once('controllers/taskController.php');
    }
    if($_GET['c']=='category'){
        require_once('controllers/categoryController.php');
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

$order = isset($_GET['order']) ? $_GET['order'] : "default";
$tasks = TaskRepository::getTaskByUserId($_SESSION['user']->getId(), $order);
$sharedTasks = TaskShareRepository::getTaskByUserId($_SESSION['user']->getId());
$categories = CategoryRepository::getByUserId($_SESSION['user']->getId());
require_once('views/mainView.phtml');

