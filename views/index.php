<?php
    include("../controller/loginProcess.php");
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
    <title>Lay Bare - Login</title>
</head>
<body>
    <div class="login-body">
        <div class="login-container">
            <div class="left-container">
                <div class="logo">
                    <img src="../assets/images/logo.png" alt="Logo">
                </div>
            </div>
            <div class="right-container">
                <header>
                    <h1 class="login-header">Login</h1>
                    <form action="../controller/loginProcess.php" method="post">
                        <div class="input-field">
                            <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-field">
                            <button class="login-button form-control" type="submit" name="login">Login</button>
                        </div>
                    </form>
                    <p class="link-description"> Don't have account yet?
                        <a class="link-register" href="accountRegistration.php">Register.</a>
                    </p>
                </header>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <?php if(isset($_SESSION['login-success'])) :?>
        <?php if($_SESSION['login-success'] == false) :?>
            <script type='text/javascript'>
                Swal.fire({
                    title: 'Failed to Login.',
                    html: '<?php echo "* ".$_SESSION['error'];?>', 
                    icon:'error', 
                    confirmButtonColor: '#212529', 
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed){
                        <?php unset($_SESSION['login-success']);unset($_SESSION['error']);?>
                    }
                });
            </script>
        <?php endif;?>
    <?php endif;?>
</body>
</html>