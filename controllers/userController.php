<?php

if(isset($_GET['logout']) || (isset($_GET['a']) && $_GET['a'] == 'logout')){
    session_destroy();
    header('location:index.php');
    exit;
}


if(isset($_POST['login'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $q="select * from user where username='".$_POST['username']."'";
        
        $db=DB::connect();

        $result = $db->query($q);
        if($row=$result->fetch_assoc()){
            if($row['password']==md5($_POST['password'])){

                $_SESSION['user']=new User($row['id'], $row['username']);
                header('location:index.php');
                exit;
            }
        }
    }
    $_SESSION['error'] = "Usuario o contraseña incorrectos";
    header('location:index.php?login');
    exit;
}

if(isset($_POST['register'])){
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])){
        if($_POST['password'] != $_POST['password2']){
            $_SESSION['error'] = "Las contraseñas no coinciden";
            header('location:index.php?register');
            exit();
        }

        $q="insert into user values (NULL, '".$_POST['username']."', md5('".$_POST['password']."'))";

        $db= DB::connect();
        $db->query($q);
        if($db->insert_id){
            header('location:index.php?login');
            exit();
        }
    }
    $_SESSION['error'] = "No se pudo registrar el usuario";
    header('location:index.php?register');
    exit();
}