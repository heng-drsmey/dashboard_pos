<?php
session_start();
include ('cn.php');
if(isset($_SESSION['session'])){
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- link sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <?php
            if(isset($_REQUEST['btnLogin'])){
                $username  = $conn->real_escape_string($_REQUEST['txtname']);
                $password = $conn->real_escape_string($_REQUEST['txtpassword']);
                $sql = "SELECT * FROM `user` WHERE `Username` = '$username' AND `Password` = '$password'";
                $rs = $conn->query($sql);
                $row = $rs->fetch_assoc();
                if(!empty($row)){
                    $_SESSION['session'] = $row['Id'];
                    header("location: index.php");
                }
                else{
                    echo '
                    <script>
                      swal({
                        title: "Try again",
                        text: "Incorrect Password OR Username",
                        icon: "error",
                      });
                    </script>
                    ';
                  }
            }
        ?>

        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" name="txtname">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="txtpassword">
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit" name="btnLogin">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="adminvendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>