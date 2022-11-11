<?php
    include("../model/model.php");
    session_start();
    $model = new Model();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){
        
        $productName = $_POST['product-name'];
        $productDescription = $_POST['product-description'];
        $productPrice = $_POST['product-price'];

        $isSuccess = $model -> addProduct($productName, $productDescription, $productPrice);
        
        if($isSuccess){
            $_SESSION['successfully-saved'] = true;
        }
        else{
            $_SESSION['successfully-saved'] = false;
        }
        header("Location: ../views/dashboard.php");
    }