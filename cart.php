<?php
session_start();
// session_destroy();
if(isset($_GET['selected_country'])) $_SESSION["selected_country"] = $_GET['selected_country'];
if(isset($_GET['selected_city'])) $_SESSION["selected_city"] = $_GET['selected_city'];
if(isset($_GET['selected_supermarket'])) $_SESSION["selected_supermarket"] = $_GET['selected_supermarket'];
if(isset($_GET['selected_categorie'])) $_SESSION["selected_categorie"] = $_GET['selected_categorie'];


// if(isset($_SESSION['selected_country'])) echo "session country exist".$_SESSION['selected_country'].$_SESSION['selected_city'].$_SESSION['selected_supermarket'];
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

	// add to cart if (click on add to cart): 
	if(isset($_GET['add_cart'])){
		if(isset($_SESSION['user_in'])){
			$sql = "INSERT INTO cart(id_user, id_product) VALUES ( '$_SESSION[user_in]' , '$_GET[add_cart]')";
			mysqli_query($conn, $sql);
		}
	}
?>


							<?php
								if (isset($_POST['clear'])) {
									$sql = "DELETE FROM `cart` WHERE id_user = $_SESSION[user_in]";
									mysqli_query($conn, $sql);
								}	
							?>

							

<!DOCTYPE html>
<html lang="en">
<head>
<title>Cart</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
							<?php
								if (isset($_POST['addCommand'])) {

									$mysql = "SELECT * FROM cart,product WHERE cart.id_user = $_SESSION[user_in] AND cart.id_product = product.id_product";
									$requet = mysqli_query($conn, $mysql);
									$total_price = 0;
									while($row = mysqli_fetch_assoc($requet)){
										if($row['prix_promo']!= 0){
											$price = $row['prix_promo'];
										}else{
											$price = $row['prix_fix'];
										}
										$pro_total = $price*$row['quantity'];

										$total_price += $pro_total;
									}


									if($total_price < 500 ){
										echo "<style>
											#super_this{
												display: block;
											}
										</style>";
									}else{
										$sql = "SELECT * FROM cart WHERE id_user = $_SESSION[user_in]";
										$req = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_assoc($req)) {
											$id_cart = $row['id_cart'];

											// from cart to shadow_cart: 
											$in_shadow_sql = "INSERT INTO `cart_shadow`(`id_user`, `id_product`, `quantity`) VALUES ('$row[id_user]', '$row[id_product]', '$row[quantity]')";
											mysqli_query($conn, $in_shadow_sql);

											// now delete the transfered data from cart:
											$new_sql_delete = "DELETE FROM `cart` WHERE id_cart = $id_cart";
											mysqli_query($conn, $new_sql_delete);
										}

										// from shadow to command : WHERE id_shadow doesn't exist in command :

										$sql = "SELECT * FROM cart_shadow WHERE id_shadow NOT IN(SELECT id_shadow FROM command)";
										$req = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_assoc($req)) {
											$date = date("d-m-Y");
											$statut = "pending";
											$id_shadow = $row['id_shadow'];

											$to_command = "INSERT INTO `command`(`date`, `statut`, `id_shadow`, `monthly` ) VALUES ('$date', '$statut', '$id_shadow', '0')";
											mysqli_query($conn, $to_command);
										}
										$_GET['gopdf'] = '1';
										
									}
								}


								if (isset($_POST['monthly'])) {

									$mysql = "SELECT * FROM cart,product WHERE cart.id_user = $_SESSION[user_in] AND cart.id_product = product.id_product";
									$requet = mysqli_query($conn, $mysql);
									$total_price = 0;
									while($row = mysqli_fetch_assoc($requet)){
										if($row['prix_promo']!= 0){
											$price = $row['prix_promo'];
										}else{
											$price = $row['prix_fix'];
										}
										$pro_total = $price*$row['quantity'];

										$total_price += $pro_total;
									}


									if($total_price < 500 ){
										echo "<style>
											#super_this{
												display: block;
											}
										</style>";
									}else{
										$sql = "SELECT * FROM cart WHERE id_user = $_SESSION[user_in]";
										$req = mysqli_query($conn,$sql);
										while ($row = mysqli_fetch_assoc($req)) {
											$id_cart = $row['id_cart'];

											// from cart to shadow_cart: 
											$in_shadow_sql = "INSERT INTO `cart_shadow`(`id_user`, `id_product`, `quantity`) VALUES ('$row[id_user]', '$row[id_product]', '$row[quantity]')";
											mysqli_query($conn, $in_shadow_sql);

											// now delete the transfered data from cart:
											$new_sql_delete = "DELETE FROM `cart` WHERE id_cart = $id_cart";
											mysqli_query($conn, $new_sql_delete);
										}

										// from shadow to command : WHERE id_shadow doesn't exist in command :

										$sql = "SELECT * FROM cart_shadow WHERE id_shadow NOT IN(SELECT id_shadow FROM command)";
										$req = mysqli_query($conn, $sql);
										while ($row = mysqli_fetch_assoc($req)) {
											$date = date("d-m-Y");
											$statut = "pending";
											$id_shadow = $row['id_shadow'];

											$to_command = "INSERT INTO `command`(`date`, `statut`, `id_shadow`, `monthly` ) VALUES ('$date', '$statut', '$id_shadow', '1')";
											mysqli_query($conn, $to_command);
										}
										$_GET['gopdf'] = '1';										
									}
								}

								
							?>
</head>

<body>
<a href=''>
<div id='super_this'>
	You can't make this order unless you buy more than 500$
</div>
</a>
<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+212 00 000 0000</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">contact@mycady.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">Country<i class="fas fa-chevron-down"></i></a>
										<ul>
										<?php
											$sql = "SELECT * FROM country";
											$req = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_assoc($req)){
												echo "<li><a href='index.php?selected_country=$row[id_country]'>$row[name_country]</a></li>";
											}
										?>
										</ul>
									</li>
									<li>
										<a href="#">City<i class="fas fa-chevron-down"></i></a>
										<ul>
										<?php
											if(isset($_SESSION['selected_country'])){
												$sql = "SELECT * FROM city WHERE id_country = $_SESSION[selected_country]";
												$req = mysqli_query($conn, $sql);
												
												while($row = mysqli_fetch_assoc($req)){
													echo "<li><a href='index.php?selected_city=$row[id_city]'>$row[name_city]</a></li>";
												}
											}else{
												echo "<li><div id='redMessage'>Select Country</div></li>";
											}
										?>
										</ul>
									</li>
									<li>
										<a href="#">SuperMarket<i class="fas fa-chevron-down"></i></a>
										<ul>
										<?php
											if(isset($_SESSION['selected_city'])){
												$sql = "SELECT * FROM supermarket WHERE id_city = $_SESSION[selected_city]";
												$req = mysqli_query($conn, $sql);
												
												while($row = mysqli_fetch_assoc($req)){
													echo "<li><a href='index.php?selected_supermarket=$row[id_supermarket]'>$row[name_supermarket]</a></li>";
												}
											}else{
												echo "<li><div id='redMessage'>Select City</div></li>";
											}
										?>
										</ul>
									</li>
									<li>
										<a href="#">Categorie<i class="fas fa-chevron-down"></i></a>
										<ul>
											<?php
												if(isset($_SESSION['selected_supermarket'])){
													$sql = "SELECT * FROM categorie WHERE id_supermarket = $_SESSION[selected_supermarket]";
													$req = mysqli_query($conn, $sql);
													
													while($row = mysqli_fetch_assoc($req)){
														echo "<li><a href='index.php?selected_categorie=$row[id_categorie]'>$row[name_categorie]</a></li>";
													}
												}else{
													echo "<li><div id='redMessage'>Select Supermarket</div></li>";
												}
											?>
										</ul>
									</li>
								</ul>
							</div>
							<div class="top_bar_user">
								<!-- <div class="user_icon"><img src="images/user.svg" alt=""></div>
								<div><a href="administration/pages/register.php">Register</a></div>
								<div><a href="administration/pages/login.php">Sign in</a></div> -->

								<?php
									if(isset($_SESSION['user_in'])){
										$sql = "SELECT * FROM user WHERE id_user = $_SESSION[user_in]";
										$req = mysqli_query($conn, $sql);
										$row = mysqli_fetch_assoc($req);
										echo "
										
											<ul class='standard_dropdown top_bar_dropdown'>
											<li>
												<a href='#'>
													<img src='administration/pages/uploads/$row[image_u]' class='profile_user' alt=''> &nbsp;&nbsp; | &nbsp;$row[name_u]<i class='fas fa-chevron-down'></i>
												</a>
												
												<ul>
													<li><a href='#'>Profile</a></li>
													<li><a href='deconnexion.php'>Deconnect</a></li>
												</ul>
											</li>
											</ul>	
										
										";
									}else{
										echo "
										<div class='user_icon'><img src='images/user.svg' alt=''></div>
										<div><a href='administration/pages/register.php'>Register</a></div>
										<div><a href='administration/pages/login.php'>Sign in</a></div>
										";
									}
								?>
								<!-- <div class="user_profile_pic">
									<img src="administration/pages/uploads/me.png" class="profile_user" alt=""> &nbsp;&nbsp; | amine
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="index.php">MyCady</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="shop.php" class="header_search_form clearfix">
										<input type="search" name="search_engine" required="required" class="header_search_input" placeholder="Search for products...">
										
										<!-- !!!!!!!!!!! DONT CHANGE ANYTHNG HERE ELSE U GONNA MISS UP WITH ALL THE SLIDS -->
										<div class="custom_dropdown" id="nonshow">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<form method="post">
										
												<div class='wishlist_text'>
													<?php
														if (isset($_SESSION['user_in'])) {
															echo "
																<div class='wishlist_text'><a href='wishlist.php?user_wishlist=$_SESSION[user_in]'>Wishlist</a></div>
															";
														}else{
															echo "
																<div class='wishlist_text'><a href='#'>Wishlist</a></div>
															";
														}
													?>
												</div>
												<div class='wishlist_count'>
												<?php
													$num_whichlist = 0;
													if(isset($_SESSION['user_in'])){
														$sql = "SELECT * FROM wishlist WHERE id_user = $_SESSION[user_in]";
														$req = mysqli_query($conn, $sql);
														
														while($row = mysqli_fetch_assoc($req)){
															$num_whichlist = $num_whichlist+1;
														}
														echo $num_whichlist;
														
													}else{
														echo $num_whichlist." {Log in}";
													}


												?>
												</div>
											

									</form>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="images/cart.png" alt="">
										<?php
											if (isset($_SESSION['user_in'])) {
												$sql="SELECT * FROM cart,product WHERE cart.id_user = $_SESSION[user_in] AND cart.id_product = product.id_product";
												$req = mysqli_query($conn, $sql);
												$cart_price = 0;
												$much_product = 0;
												$total_price = 0;
												while ($row = mysqli_fetch_assoc($req)) {
													// it means prix promo exist
														if($row['prix_promo']!= 0){
															$price = $row['prix_promo'];
															$much_product++;
														}else{
															$price = $row['prix_fix'];
															$much_product++;
														}
														$pro_total = $price*$row['quantity'];

														$total_price += $pro_total;
												}
												// price + 10% FEE :
												$fee = ($total_price*10)/100;
 												$final_price = $total_price+$fee;
												echo'
												<div class="cart_count"><span>'.$much_product.'</span></div>
												</div>
												<div class="cart_content">
													<div class="cart_text"><a href="cart.php">Cart</a></div>
													<div class="cart_price">$'.$final_price.'</div>
												</div>
												';
											}else{
												echo '
												<div class="cart_count"><span>0</span></div>
												</div>
												<div class="cart_content">
													<div class="cart_text"><a href="#">Cart</a></div>
													<div class="cart_price">$0{Log in}</div>
												</div>
												';
											}
										?>
										
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>

								<ul class="cat_menu">
									<li><a href="#">Computers & Laptops <i class="fas fa-chevron-right ml-auto"></i></a></li>
									<li><a href="#">Cameras & Photos<i class="fas fa-chevron-right"></i></a></li>
									<li class="hassubs">
										<a href="#">Hardware<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li class="hassubs">
												<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
												<ul>
													<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
												</ul>
											</li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li><a href="#">Smartphones & Tablets<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">TV & Audio<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">Gadgets<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">Car Electronics<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">Video Games & Consoles<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">Accessories<i class="fas fa-chevron-right"></i></a></li>
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="index.html">Home<i class="fas fa-chevron-down"></i></a></li>
									<li class="hassubs">
										<a href="#">Super Deals<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Featured Brands<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Pages<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="shop.html">Shop<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="product.html">Product<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="blog_single.html">Blog Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="regular.html">Regular Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="cart.html">Cart<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li><a href="blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
								<li class="page_menu_item has-children">
									<a href="#">Language<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Currency<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item">
									<a href="index.html">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
										<li class="page_menu_item has-children">
											<a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
											<ul class="page_menu_selection">
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											</ul>
										</li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="images/phone_white.png" alt=""></div>+38 068 005 3570</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="images/mail_white.png" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
							<?php
								$sql = "SELECT * FROM cart,product WHERE cart.id_user = $_SESSION[user_in] AND cart.id_product = product.id_product";
								$req = mysqli_query($conn, $sql);
								$total_price = 0;
								while($row = mysqli_fetch_assoc($req)){
									if($row['prix_promo']!= 0){
										$price = $row['prix_promo'];
									}else{
										$price = $row['prix_fix'];
									}
									$pro_total = $price*$row['quantity'];

									$total_price += $pro_total;
									// price + 10% FEE :
									$fee = ($total_price*10)/100;
									$final_price = $total_price+$fee;
									echo '
									<li class="cart_item clearfix">
										<div class="cart_item_image"><img src="images/'.$row['image'].'" alt=""></div>
										<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
											<div class="cart_item_name cart_info_col">
												<div class="cart_item_title">Name</div>
												<div class="cart_item_text">'.$row['nom_product'].'</div>
											</div>
											<div class="cart_item_color cart_info_col">
												<div class="cart_item_title">Color</div>
												<div class="cart_item_text"><span style="background-color:#999999;"></span>Silver</div>
											</div>
											<div class="cart_item_quantity cart_info_col">
												<div class="cart_item_title">Quantity</div>
												<div class="cart_item_text">'.$row['quantity'].'</div>
											</div>
											<div class="cart_item_price cart_info_col">
												<div class="cart_item_title">Price</div>
												<div class="cart_item_text">$'.$price.'</div>
											</div>
											<div class="cart_item_total cart_info_col">
												<div class="cart_item_title">Total</div>
												<div class="cart_item_text">$'.$pro_total.'</div>
											</div>
										</div>
									</li>
									';
								} 
							?>	
							</ul>
							
						</div>
						
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total + FEEs:</div>
								<div class="order_total_amount"><?php echo "$ $final_price" ?></div>
							</div>
						</div>

						<div class="cart_buttons">
							<form method = 'post'>
								<input name='clear'  type="submit" class="button cart_button_clear" value='Clear Cart'>
								<input name='monthly'  type="submit" class="button cart_button_monthly" value='Monthly command'>
								<input name='addCommand' type="submit" class="button cart_button_checkout" value='Add command'>
								<?php
									if (isset($_GET['gopdf'])) {
										echo" <br> </br><a href='pdf.php'>get facture</a>";
									}
								?>
							</form>

							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">MyCady</a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">+212600000000</div>
						<div class="footer_contact_text">
							<p>34 rabat ville rue ennacer</p>
							<p>Rabat, Morocco</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
								<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Find it Fast</div>
						<ul class="footer_list">
							<li><a href="#">Computers & Laptops</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Smartphones & Tablets</a></li>
							<li><a href="#">TV & Audio</a></li>
						</ul>
						<div class="footer_subtitle">Gadgets</div>
						<ul class="footer_list">
							<li><a href="#">Car Electronics</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<ul class="footer_list footer_list_2">
							<li><a href="#">Video Games & Consoles</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Computers & Laptops</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Matboud can't be removed. Template is licensed under CC BY 3.0-->

Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://www.matboud.com">MATBOUD</a> 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/cart_custom.js"></script>
</body>

</html>