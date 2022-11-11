<?php
    include("dbConnect.php");

    class Model extends DbConnection{

        public function registerAccount($firstname, $lastname, $username, $email, $password){
            $sql = "INSERT INTO user_account_tbl(username, password) VALUES(?, ?)";
            $statement = $this->databaseConnect()->prepare($sql);
            $statement -> execute([$username, $password]);

            $sql2 ="SELECT user_id FROM user_account_tbl WHERE username = ? AND password = ?";
            $statement = $this->databaseConnect()->prepare($sql2);
            $statement -> execute([$username, $password]);
            $result = $statement->fetchAll();
            $id = "";
            foreach($result as $key => $value){
                $id = $value['user_id'];
            }
            
            $sql3 = "INSERT INTO user_info_tbl(first_name, last_name, email, user_id) VALUES(?, ?, ?, ?)";
            $statement = $this->databaseConnect()->prepare($sql3);
            $isSuccess = $statement -> execute([$firstname, $lastname, $email, $id]);

            return $isSuccess;

        }

        public function getAccounts(){
            $sql = "SELECT * FROM user_account_tbl";
            $statement = $this->databaseConnect()->query($sql);
            $results = $statement->fetchAll();

            return $results;
        }

        public function getUserInfo(){
            $sql = "SELECT * FROM user_info_tbl";
            $statement = $this->databaseConnect()->query($sql);
            $results = $statement->fetchAll();

            return $results;
        }
        
        public function getPersonalInfo($userId){
            $sql = "SELECT * FROM user_info_tbl WHERE user_id = ?";
            $statement = $this->databaseConnect()->prepare($sql);
            $statement -> execute([$userId]);
            $results = $statement->fetchAll();

            return $results;
        }

        public function getAllProducts(){

            $sql = "SELECT * FROM product_tbl";
            $statement = $this->databaseConnect()->query($sql);
            $results = $statement->fetchAll();

            return $results;
        }

        public function getProduct($productId){

            $sql = "SELECT * FROM product_tbl WHERE product_id = ?";
            $statement = $this->databaseConnect()->prepare($sql);
            $statement -> execute([$productId]);
            $results = $statement->fetchAll();

            return $results;
        }

        public function addProduct($productName, $productDescription, $productPrice){

            $sql = "INSERT INTO product_tbl(product_name, product_description, product_price) VALUES(?, ?, ?)";
            $statement = $this->databaseConnect()->prepare($sql);
            $isSuccess = $statement -> execute([$productName, $productDescription, $productPrice]);

            return $isSuccess;
            
        }

        public function updateProduct($productId, $productName, $productDescription, $productPrice){

            $sql = "UPDATE product_tbl SET product_name = ?, product_description = ?, product_price = ? WHERE product_id = ?";
            $statement = $this->databaseConnect()->prepare($sql);
            $isSuccess = $statement -> execute([$productName, $productDescription, $productPrice, $productId]);

            return $isSuccess;

        }

        public function deleteProduct($productId){

            $sql = "DELETE FROM product_tbl WHERE product_id = ?";
            $statement = $this->databaseConnect()->prepare($sql);
            $isSuccess = $statement -> execute([$productId]);

            return $isSuccess;
        }
    }