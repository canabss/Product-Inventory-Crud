<?php

    include("../model/model.php");
    session_start();
    $model = new Model();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])){
        
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        if(!verifyEmail($email) && !verifyUsername($username)){
            if(!verifyEmail($email)){
                if(!verifyUsername($username)){
                    if($password == $confirmPassword){
                        $isSuccess = $model -> registerAccount($firstName, $lastName, $username, $email, $password);
                    
                        if($isSuccess){
                            $_SESSION['successfully-registered'] = true;
                        }
                        else{
                            $_SESSION['successfully-registered'] = false;
                            $_SESSION['error'] = "SQL Error";
                        }
                    }
                    else{
                        $_SESSION['successfully-registered'] = false;
                        $_SESSION['error'] = "Password Mismatch";
                    }
                }
                else{
                    $_SESSION['successfully-registered'] = false;
                    $_SESSION['error'] = "Username is already Taken";
                }
            }
            else{
                $_SESSION['successfully-registered'] = false;
                $_SESSION['error'] = "Email is already Taken";
            }
        }
        else{
            $_SESSION['successfully-registered'] = false;
            $_SESSION['error'] = "Username and Email is already Taken";
        }
        header("Location: ../views/accountRegistration.php");
    }

    function verifyEmail($email){
        $model = new Model();
        $isTaken = false;
        $result = $model -> getUserInfo();
        foreach($result as $key => $value){
            if($value['email'] == $email){
                $isTaken = true;
                break;
            }
        }

        return $isTaken;
    }

    function verifyUsername($username){
        $model = new Model();
        $isTaken = false;
        $result = $model -> getAccounts();
        foreach($result as $key => $value){
            if($value['username'] == $username){
                $isTaken = true;
                break;
            }
        }

        return $isTaken;
    }