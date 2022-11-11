<?php
    include("../model/model.php");
    session_start();
    $model = new Model();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])){
        
        $productId = $_POST['product-id'];
        $productName = $_POST['product-name'];
        $productDescription = $_POST['product-description'];
        $productPrice = $_POST['product-price'];

        $isSuccess = $model -> updateProduct($productId, $productName, $productDescription, $productPrice);
        
        if($isSuccess){
            $_SESSION['successfully-update'] = true;
        }
        else{
            $_SESSION['successfully-updated'] = false;
        }
        header("Location: ../views/dashboard.php");
    }