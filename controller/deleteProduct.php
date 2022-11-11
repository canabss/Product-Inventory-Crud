<?php
    include("../model/model.php");
    session_start();
    $model = new Model();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])){
        
        $productId = $_POST['product-id'];
        $isSuccess = $model -> deleteProduct($productId);
        
        if($isSuccess){
            $_SESSION['successfully-deleted'] = true;
        }
        else{
            $_SESSION['successfully-deleted'] = false;
        }
        header("Location: ../views/dashboard.php");
    }