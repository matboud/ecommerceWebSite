<?php
session_start();
// connection to the BDD : 
    
    // host infos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mycady";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block">
                                <?php
                                    if(isset($_POST['submit'])){
                                        $mail = $_POST['mail'];
                                        $password = $_POST['password'];
                                        
                                        function nn_crypt($data) { 
                                            return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
                                          }

                                          
                                        $pass = nn_crypt($password);
                                          
                                          
                                        
                                        
                                        
                                        $sql = "SELECT * FROM user";
                                        $req = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($req)){
                                            if($row['mail']==$mail && $row['password_u']==$pass){
                                                if ($row['role_u']==1) {
                                                    $_SESSION['user_in']=$row['id_user'];
                                                    header("location: upload.php");
                                                }else{
                                                    $_SESSION['user_in']=$row['id_user'];
                                                    header("location: ../../index.php");
                                                }
                                                break;
                                            }else{
                                            }
                                        }
                                    }
                                ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
                Creat an <a href='register.php'> account</a>?
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
