<?php
    include("../model/model.php");
    session_start();
    $model = new Model();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $loginSuccess = false;
        $accountsResult = $model -> getAccounts();
        foreach($accountsResult as $key => $value){
            if($value['username'] == $username && $value['password'] == $password){
                $infoResult = $model -> getPersonalInfo($value['user_id']);
                foreach($infoResult as $keys => $values){
                    $_SESSION['user-id'] = $values['user_id'];
                    $_SESSION['firstname'] = $values['first_name'];
                    $_SESSION['lastname'] = $values['last_name'];
                }
                $loginSuccess = true;
                $_SESSION['login-success'] = true;
                
            }
        }
        if(!$loginSuccess){
            $_SESSION['login-success'] = false;
            $_SESSION['error'] = "Incorrect Email or Password";
        }
        header("Location: ../views/");
    }

    else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])){
        session_destroy();
        header("Location: ../view/");
        exit();
    }