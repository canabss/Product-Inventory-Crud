<?php
    include("../model/model.php");
    session_start();
    $object = new Model();
    if(!isset($_SESSION['user-id'])){
        header("Location: index.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/myLogo.png" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <title>Lay Bare - Dashboard</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-logo" id="logo" href="dashboard.php">
                    <img src="../assets/images/logo.png" alt="Logo" />
                </a>
                <div class="row">
                    <p class="current-user-name"><i class='fas fa-user'></i> <?php echo " ".$_SESSION['firstname']." ".$_SESSION['lastname']?><a class="logout" href="../controller/logout.php">Logout</a></p>
                </div>
            </div>
        </nav>
    </header>
    <div class="content">
        <div class="container">
            <div class="tbl-header">
                <h1 class="table-title text-uppercase">Product List</h1>
                <button class='btn btn-primary add-button' name = 'add'>
                    <i class='fas fa-plus'></i> Add Product
                </button>
            </div>
            <table id="table" class="table table-bordered table-striped text-center" style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Product ID</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Product Description</th>
                        <th class="text-center">Product Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $object->getAllProducts();
                        $count = 1;
                    ?>
                    <?php foreach($result as $key => $value):?>
                        <tr>
                            <td class="align-middle"><?php echo $count;?></td>
                            <td class="align-middle"><?php echo $value["product_id"];?></td>
                            <td class="align-middle"><?php echo $value["product_name"];?></td>
                            <td class="align-middle"><?php echo $value["product_description"];?></td>
                            <td class="align-middle"><?php echo $value["product_price"];?></td>
                            <td class="align-middle">
                                <div class="action-button">
                                    <button class='btn update-button' value='<?php echo $value["product_id"]."/".$value["product_name"]."/".$value["product_description"]."/".$value["product_price"];?>'>
                                        <i class='fas fa-edit'></i> Edit
                                    </button>

                                    <form action='../controller/deleteProduct.php' method='post'>
                                        <input type='hidden' name='product-id' value='<?php echo $value["product_id"]?>"'>
                                        <button type='submit' class='btn action-button delete-button' name = 'delete'>
                                            <i class='fas fa-trash'></i>  Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php $count++?>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="add">
        <div class="container">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title">Add Product</h4>
                        <button  class="close" name="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="add-form" action="../controller/addProduct.php">
                        <div class="input-field">
                            <label class = "form-label" for="product-name">Product Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="product-name" required>
                        </div>
                        <div class="input-field">
                            <label class = "form-label" for="product-description">Product Description</label>
                            <input type="text" class="form-control" placeholder="Product Description" name="product-description" required>
                        </div>
                        <div class="input-field">
                            <label class = "form-label" for="product-price">Price</label>
                            <input type="text" class="form-control" placeholder="Product Price" name="product-price" required>
                        </div>
                        <button type="submit" class="save" name="save" ><i class='fa fa-save'></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update">
        <div class="container">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title">Update Product</h4>
                        <button class="close" name="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="add-form" action="../controller/updateProduct.php">
                        <div class="input-field">
                            <label class = "form-label" for="product-id">Product ID</label>
                            <input type="text" class="form-control" placeholder="Product ID" name="product-id" id="product-id" readonly>
                        </div>
                        <div class="input-field">
                            <label class = "form-label" for="product-name">Product Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="product-name" id="product-name" required>
                        </div>
                        <div class="input-field">
                            <label class = "form-label" for="product-description">Product Description</label>
                            <input type="text" class="form-control" placeholder="Product Description" name="product-description" id="product-description" required>
                        </div>
                        <div class="input-field">
                            <label class = "form-label" for="product-price">Price</label>
                            <input type="text" class="form-control" placeholder="Product Price" name="product-price" id="product-price" required>
                        </div>
                        <button type="submit" class="save" name="update" ><i class='fa fa-save'></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $(".table").DataTable({
                ordering: false,
                lengthChange: false,
                "pagingType": "simple_numbers",
                "bInfo": false,
                "pageLength": 5
            }); 
            $("#search-input").on('keyup', function(){
                table.search(this.value).draw();
            });
        });  

        $(document).ready(function () {
            $('.add-button').click(function () {
                $('#add').modal('show');
            });     
        });   

        $(document).ready(function () {
            $('#add').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $(document).ready(function () {
            $('.close').click(function () {
                $('#add').modal('hide');
                $('#update').modal('hide');
            });     
        });  

        $('.update-button').click(function () {
            $('#update').modal('show');
            console.log($(this).val());
            var arr = $(this).val().split("/");
            
            $('#product-id').val(String(arr[0]));
            $('#product-name').val(String(arr[1]));
            $('#product-description').val(String(arr[2]));
            $('#product-price').val(String(arr[3]));
        }); 

        $(document).ready(function () {
            $('#add').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        
    </script>
    <?php if(isset($_SESSION['successfully-saved'])) :?>
        <?php if($_SESSION['successfully-saved'] == true) :?>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Product Successfully Added.',
                    icon:'success', 
                    confirmButtonColor: '#212529', 
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed){
                        <?php unset($_SESSION['successfully-saved']);?>
                        window.location.replace('../views/dashboard.php');
                    }
                });
            </script>
        <?php endif;?>
    <?php endif;?>

    <?php if(isset($_SESSION['successfully-update'])) :?>
        <?php if($_SESSION['successfully-update'] == true) :?>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Product Successfully Updated.',
                    icon:'success', 
                    confirmButtonColor: '#212529', 
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed){
                        <?php unset($_SESSION['successfully-update']);?>
                        window.location.replace('../views/dashboard.php');
                    }
                });
            </script>
        <?php endif;?>
    <?php endif;?>

    <?php if(isset($_SESSION['successfully-deleted'])) :?>
        <?php if($_SESSION['successfully-deleted'] == true) :?>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Product Successfully deleted.',
                    icon:'success', 
                    confirmButtonColor: '#212529', 
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed){
                        <?php unset($_SESSION['successfully-deleted']);?>
                        window.location.replace('../views/dashboard.php');
                    }
                });
            </script>
        <?php endif;?>
    <?php endif;?>
</body>
</html>
