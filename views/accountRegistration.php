<?php
    include("../controller/registerProcess.php");
    if(isset($_SESSION['user-id'])){
        header("Location: dashboard.php");
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/myLogo.png" />
    <title>Lay Bare - Register</title>
</head>
<body>
    <div class="registration-body">
        <div class="registration-container">
            <div class="registration-left-container">
                <div class="logo">
                    <img src="../assets/images/logo.png" alt="Logo">
                </div>
            </div>
            <div class="registration-right-container">
                <header>
                    <h1 class="login-header">Register</h1>
                    <form action="../controller/registerProcess.php" method="post">
                        <div class="input-field row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname" required>
                            </div>
                        </div>
                        <div class="input-field">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-field">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password" required>
                        </div>
                        <div class="input-field">
                            <button class="registration-button form-control" type="submit" name="register">Register</button>
                        </div>

                    </form>
                    <p class="link-description"> Already have an account?
                        <a class="link-register" href="index.php">Login.</a>
                    </p>
                </header>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <?php if(isset($_SESSION['successfully-registered'])) :?>
        <?php if($_SESSION['successfully-registered'] == false) :?>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Failed to Register Account.',
                    html: '<?php echo "* ".$_SESSION['error'];?>', 
                    icon:'error', 
                    confirmButtonColor: '#212529', 
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed){
                        <?php unset($_SESSION['successfully-registered']);unset($_SESSION['error']);?>
                    }
                });
            </script>
        <?php endif;?>
    <?php endif;?>

    <?php if(isset($_SESSION['successfully-registered'])) :?>
        <?php if($_SESSION['successfully-registered'] == true) :?>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Account Registration Successfully.',
                    icon:'success', 
                    confirmButtonColor: '#212529', 
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed){
                        <?php unset($_SESSION['successfully-registered']);?>
                        window.location.replace('../views/');
                    }
                });
            </script>
        <?php endif;?>
    <?php endif;?>

</body>
</html>