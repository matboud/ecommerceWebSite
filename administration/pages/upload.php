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

    <title>Mycady | Administration</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Social Buttons CSS -->
    <link href="../vendor/bootstrap-social/bootstrap-social.css" rel="stylesheet">

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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">MyCady</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../deconnexion.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
       
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Upload</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="panel panel-default"> 
                        <div class="panel-heading">
                            Add Product : 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            
                            <div class="form-group has-success">

                                <div class="form-group" >
                                    <label  id="color-form-label">Categorie :</label>
                                    <select class="form-control" id="color-form-cnt" name="supermarket">
                                        <?php

                                            $sql = "SELECT * FROM categorie";
                                            $req = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_assoc($req)){
												echo "<option value='$row[id_categorie]'>$row[name_categorie]</option>";
                                            }
                                            
                                        ?>
                                    </select>
                                    <br>
                                </div>      

                                <label class="control-label" id="color-form-label" for="inputSuccess">Name :</label>
                                <input type="text" class="form-control" id="color-form-cnt" name="name">
                                    <br>
                                <label class="control-label" id="color-form-label" for="inputSuccess">Description :</label>
                                <textarea class="form-control" id="color-form-cnt" rows="3" name="description"></textarea>
                                    <br>
                                <label class="control-label" id="color-form-label" for="inputSuccess">Prix fix :</label>
                                <input type="text" class="form-control left prix_promo" id="color-form-cnt" name="prix_fix">
                                    
                                <label class="control-label" id="color-form-label" for="inputSuccess">prix Promotion :</label>
                                <input type="text" class="form-control right prix_promo" id="color-form-cnt" name="prix_promo">
                                    <br> </br>
                                <label class="control-label" id="color-form-label" for="inputSuccess">Date-E :</label>
                                <input type="date" class="form-control" id="color-form-cnt" name="date_e">
                                    <br>
                                <label class="control-label" id="color-form-label" for="inputSuccess">How much product :</label>
                                <input type="text" class="form-control" id="color-form-cnt" name="product_left">
                                    <br>
                                <label class="control-label" id="color-form-label" for="inputSuccess">Images :</label>
                                <div class="form-control table_images" id="color-form-cnt">
                                <input type="file" name="uploading_pic" id="">
                                <input type="file" name="uploading_pic1" id="">
                                <input type="file" name="uploading_pic2" id="">
                                <input type="file" name="uploading_pic3" id="">
                                </div>
                                <br>
                                <input type="submit" class="btn btn-outline btn-primary btn-lg btn-block" value="Add Product" name="submit_product">
                                
                             </div>
                        </form>
                        <?php
                            //upload product : BackEnd
                            if(isset($_POST['submit_product'])){
                                $DirDirectory = "../../images/";
                                $FileDirectory = $DirDirectory . basename($_FILES["uploading_pic"]["name"]);
                                $FileDirectory1 = $DirDirectory . basename($_FILES["uploading_pic1"]["name"]);
                                $FileDirectory2 = $DirDirectory . basename($_FILES["uploading_pic2"]["name"]);
                                $FileDirectory3 = $DirDirectory . basename($_FILES["uploading_pic3"]["name"]);
                                $ReadyToUpload = 1;
                                $changename = 0;
                            $checkType = strtolower(pathinfo($FileDirectory,PATHINFO_EXTENSION));
                            }
                            // Check if $ReadyToUpload is set to 0 by an error
                            if ($ReadyToUpload == 0) {
                                echo "Sorry, your files was not uploaded.";
                            // if everything is ok, try to upload file
                            } else {
                                if (move_uploaded_file($_FILES["uploading_pic"]["tmp_name"], $FileDirectory) && move_uploaded_file($_FILES["uploading_pic1"]["tmp_name"], $FileDirectory1) && move_uploaded_file($_FILES["uploading_pic2"]["tmp_name"], $FileDirectory2) && move_uploaded_file($_FILES["uploading_pic3"]["tmp_name"], $FileDirectory3) ) {
                                    echo "<br>The file ". basename( $_FILES["uploading_pic"]["name"]). " has been uploaded.<br>";
                                    echo "The file ". basename( $_FILES["uploading_pic1"]["name"]). " has been uploaded.<br>";
                                    echo "The file ". basename( $_FILES["uploading_pic2"]["name"]). " has been uploaded.<br>";
                                    echo "The file ". basename( $_FILES["uploading_pic3"]["name"]). " has been uploaded.<br>";

                                    $name = $_POST['name'];
                                    $description = $_POST['description'];
                                    $prix_fix = $_POST['prix_fix'];
                                    $prix_promo = $_POST['prix_promo'];
                                    $date_e = $_POST['date_e'];
                                    $product_left = $_POST['product_left'];
                                    $image =  $_FILES["uploading_pic"]["name"];
                                    $image1 = $_FILES["uploading_pic1"]["name"];
                                    $image2 = $_FILES["uploading_pic2"]["name"];
                                    $image3 = $_FILES["uploading_pic3"]["name"];
                                    $id_sup = $_POST['supermarket'];                                    
                                    
                                    $sql = "INSERT INTO product(nom_product, description, prix_fix, prix_promo, product_left, image, image1, image2, image3, date_ex, id_categorie) VALUES('$name', '$description', '$prix_fix', '$prix_promo', '$product_left', '$image', '$image1', '$image2', '$image3', '$date_e', '$id_sup') ";
                                    mysqli_query($conn, $sql);
                                    echo "the product have been added successfuly"; 

                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                } 
                            }
                        ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add categorie :
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <form method="post" enctype="multipart/form-data">
                            <label class="control-label" id="color-form-label-red" for="inputSuccess">Name :</label>
                            <input type="text" class="form-control" id="color-form-cnt-red" name="name_cat">

                            <br>

                            <label class="control-label" id="color-form-label-red" for="inputSuccess">Description :</label>
                            <textarea class="form-control" id="color-form-cnt-red" rows="3" name="adress_cat"></textarea>

                            <br>

                            <label class="control-label" id="color-form-label-red" for="inputSuccess">Images :</label>
                            <div class="form-control table_images" id="color-form-cnt-red">
                                <input type="file" name="uploading_pic" id="">
                            </div>

                            <br>

                            <div class="form-group" >
                                <label  id="color-form-label-red">Supermarket :</label>
                                <select class="form-control" id="color-form-cnt-red" name="id_supermarket">
                                    <?php
                                        $sql = "SELECT * FROM supermarket,city WHERE supermarket.id_city = city.id_city";
                                        $req = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($req)){
                                            echo "<option value='$row[id_supermarket]'>$row[name_supermarket] ($row[name_city])</option>";
                                        }
                                    ?>
                                    
                                </select>

                            </div>
                                <br>
                                <input type="submit" class="btn btn-outline btn-danger btn-lg btn-block" value="Add Categorie" name="submit_categorie">

                        </form>
                        </div>
                        <!-- /.panel-body -->
                        
                                <?php





                                // _______________________________________________________________________________________________________________________________
                                // [/_\]************************************** PICTURE OF CATEGORIES ******************************************[/_\]
                                // _______________________________________________________________________________________________________________________________
                                    // if(isset($_POST['submit_categorie'])){
                                        
                                        // $name_cat = $_POST['name_cat'];
                                        // $adress_cat = $_POST['adress_cat'];
                                        // $id_supermarket = $_POST['id_supermarket'];


                                        // $sql ="INSERT INTO categorie(name_categorie, description, id_supermarket) VALUES('$name_cat', '$adress_cat', '$id_supermarket')";
                                        // mysqli_query($conn, $sql);
                                        // echo "Categorie have been added succesfuly";
                                    // }
                                ?>


<?php

if(isset($_POST['submit_categorie'])){
$DirDirectory = "uploads/";
$FileDirectory = $DirDirectory . basename($_FILES["uploading_pic"]["name"]);
$ReadyToUpload = 1;
$changename = 0;
$checkType = strtolower(pathinfo($FileDirectory,PATHINFO_EXTENSION));
}
// Check if $ReadyToUpload is set to 0 by an error
if ($ReadyToUpload == 0) {
    echo "Sorry, your files was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["uploading_pic"]["tmp_name"], $FileDirectory)) {
        echo "<br>The file ". basename( $_FILES["uploading_pic"]["name"]). " has been uploaded.<br>";

        $name_cat = $_POST['name_cat'];
        $adress_cat = $_POST['adress_cat'];
        $image = $_FILES["uploading_pic"]["name"];
        $id_supermarket = $_POST['id_supermarket'];


        $sql ="INSERT INTO categorie(name_categorie, description, img, id_supermarket) VALUES('$name_cat', '$adress_cat', '$image', '$id_supermarket')";
        mysqli_query($conn, $sql);
        echo "Categorie have been added succesfuly";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


                           
                                




                            
                        
                        
                        
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Supermarket:
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post">
                            <label class="control-label" id="color-form-label-org" for="inputSuccess">Name :</label>
                            <input type="text" class="form-control" id="color-form-cnt-org" name="name_sm">
                                <br>
                            <label class="control-label" id="color-form-label-org" for="inputSuccess">Adresse :</label>
                            <textarea class="form-control" id="color-form-cnt-org" rows="3" name="adress_sm"></textarea>
                                <br>
                            <label class="control-label" id="color-form-label-org" for="inputSuccess">Telephone :</label>
                            <input type="text" class="form-control" id="color-form-cnt-org" name="phone_sm">
                                <br>

                            <div class="form-group" >
                                <label  id="color-form-label-org">City :</label>
                                <select class="form-control" id="color-form-cnt-org" name="city_sm">
                                    <?php
                                        $sql = "SELECT * FROM city";
                                        $req = mysqli_query($conn, $sql);

                                        while($row = mysqli_fetch_assoc($req)){
                                            echo "<option value='$row[id_city]'>$row[name_city]</option>";
                                        }
                                    ?>
                                    
                                </select>
                                <br>
                                <input type="submit" class="btn btn-outline btn-warning btn-lg btn-block" value="Add Supermarket" name="submit_supermarket">
                                <?php
                                    if(isset($_POST['submit_supermarket'])){
                                        $name_sm = $_POST['name_sm'];
                                        $adress_sm = $_POST['adress_sm'];
                                        $phone_sm = $_POST['phone_sm'];
                                        $city_sm = $_POST['city_sm'];

                                        $sql ="INSERT INTO supermarket(name_supermarket, adresse, tele, id_city) VALUES('$name_sm', '$adress_sm', '$phone_sm', '$city_sm')";
                                        mysqli_query($conn, $sql);
                                        echo "Supermarket have been added succesfuly";
                                    }
                                ?>
                            </div>
                                </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Social Buttons with Font Awesome Icons
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h4>Social Buttons</h4>
                            <a class="btn btn-block btn-social btn-bitbucket">
                                <i class="fa fa-bitbucket"></i> Sign in with Bitbucket
                            </a>
                            <a class="btn btn-block btn-social btn-dropbox">
                                <i class="fa fa-dropbox"></i> Sign in with Dropbox
                            </a>
                            <a class="btn btn-block btn-social btn-facebook">
                                <i class="fa fa-facebook"></i> Sign in with Facebook
                            </a>
                            <a class="btn btn-block btn-social btn-flickr">
                                <i class="fa fa-flickr"></i> Sign in with Flickr
                            </a>
                            <a class="btn btn-block btn-social btn-github">
                                <i class="fa fa-github"></i> Sign in with GitHub
                            </a>
                            <a class="btn btn-block btn-social btn-google-plus">
                                <i class="fa fa-google-plus"></i> Sign in with Google
                            </a>
                            <a class="btn btn-block btn-social btn-instagram">
                                <i class="fa fa-instagram"></i> Sign in with Instagram
                            </a>
                            <a class="btn btn-block btn-social btn-linkedin">
                                <i class="fa fa-linkedin"></i> Sign in with LinkedIn
                            </a>
                            <a class="btn btn-block btn-social btn-pinterest">
                                <i class="fa fa-pinterest"></i> Sign in with Pinterest
                            </a>
                            <a class="btn btn-block btn-social btn-tumblr">
                                <i class="fa fa-tumblr"></i> Sign in with Tumblr
                            </a>
                            <a class="btn btn-block btn-social btn-twitter">
                                <i class="fa fa-twitter"></i> Sign in with Twitter
                            </a>
                            <a class="btn btn-block btn-social btn-vk">
                                <i class="fa fa-vk"></i> Sign in with VK
                            </a>

                            <hr>

                            <div class="text-center">
                                <a class="btn btn-social-icon btn-bitbucket"><i class="fa fa-bitbucket"></i></a>
                                <a class="btn btn-social-icon btn-dropbox"><i class="fa fa-dropbox"></i></a>
                                <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                                <a class="btn btn-social-icon btn-flickr"><i class="fa fa-flickr"></i></a>
                                <a class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
                                <a class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                                <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                                <a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                <a class="btn btn-social-icon btn-pinterest"><i class="fa fa-pinterest"></i></a>
                                <a class="btn btn-social-icon btn-tumblr"><i class="fa fa-tumblr"></i></a>
                                <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                                <a class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
