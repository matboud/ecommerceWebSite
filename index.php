

<?php
// colors  blue: rgba(14, 140, 228, 0.8);
//  //     green: #1abc9c;




  
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
		$sql = "INSERT INTO cart(id_user, id_product, quantity) VALUES ( '$_SESSION[user_in]' , '$_GET[add_cart]' , '1')";
		mysqli_query($conn, $sql);
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>MyCady</title>
<meta charset="utf-8">
<!--for mobile themes-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--google-->
<meta name="description" content="MyCady shop project">
<!--version mobile net-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

</head>

<body>

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
							<!-- <div class="logo"><a href="#">MyCady</a></div> -->
							<div class="logo"><a href="#"><img src='logo.png' width='160px'></a></div>
							
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

												echo'
												<div class="cart_count"><span>'.$much_product.'</span></div>
												</div>
												<div class="cart_content">
													<div class="cart_text"><a href="cart.php">Cart</a></div>
													<div class="cart_price">$'.$total_price.'</div>
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
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="#">Home<i class="fas fa-chevron-down"></i></a></li>
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
							
										
								
								<li class="page_menu_item">
									<a href="#">Country<i class="fa fa-angle-down"></i></a>
									<ul class="">

										<?php
											$sql = "SELECT * FROM country";
											$req = mysqli_query($conn, $sql); 
											while ($row = mysqli_fetch_assoc($req)) {
												echo " <a href='index.php?selected_country=$row[id_country]'><li>$row[name_country]<i class='fa fa-angle-down'></i></li></a> ";
											}
										?>
									</ul>
								</li>
								
								<li class="page_menu_item">
									<a href="#">City<i class="fa fa-angle-down"></i></a>
									<ul class="">
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
								<li class="page_menu_item">
									<a href="#">Supermarket<i class="fa fa-angle-down"></i></a>
									<ul class="">
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
								<li class="page_menu_item">
									<a href="#">Categorie<i class="fa fa-angle-down"></i></a>
									<ul class="">
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
								<li class="page_menu_item">
									<a href="#">Home<i class="fa fa-angle-down"></i></a>
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
	
	<!-- Banner -->

	<div class="banner">
		<div class="banner_background" style="background-image:url(images/banner_background.jpg)"></div>
		<div class="container fill_height">
			<div class="row fill_height">
				<div class="banner_product_image"><img src="images/banner_product.png" alt=""></div>
				<div class="col-lg-5 offset-lg-4 fill_height">
					<div class="banner_content">
						<h1 class="banner_text">new era of smartphones</h1>
						<div class="banner_price"><span>$530</span>$460</div>
						<div class="banner_product_name">Apple Iphone 6s</div>
						<div class="button banner_button"><a href="#">Shop Now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Characteristics -->

	<div class="characteristics">
		<div class="container">
			<div class="row">

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_1.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_2.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_3.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_4.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					
					<!-- Deals  !!!!!!!! for the deals of the week u should have two prices promo and fix  -->

					<div class="deals">
						<div class="deals_title">Deals of the Week</div>
						<div class="deals_slider_container">
							
							<!-- Deals Slider -->
<!-- DEAL OF THE WEEK--><div class="owl-carousel owl-theme deals_slider">
								<?php
									$sql = "SELECT * FROM deal,product,categorie WHERE deal.id_product = product.id_product AND product.id_categorie = categorie.id_categorie";
									$req = mysqli_query($conn, $sql);

									while($row = mysqli_fetch_assoc($req)){
										
										echo "
										<!-- Deals Item -->
										<div class='owl-item deals_item'>
											<div class='deals_image'><img src='images/$row[image]' alt=''></div>
											<div class='deals_content'>
												<div class='deals_info_line d-flex flex-row justify-content-start'>
													<div class='deals_item_category'><a href='#'>$row[name_categorie]</a></div>
													<div class='deals_item_price_a ml-auto'>$row[prix_fix]$</div>
												</div>
												<div class='deals_info_line d-flex flex-row justify-content-start'>
													<div class='deals_item_name'>$row[nom_product]</div>
													<div class='deals_item_price ml-auto'>$row[prix_promo]$</div>
												</div>
												<div class='available'>
													<div class='available_line d-flex flex-row justify-content-start'>
														<div class='available_title'>Available: <span>6</span></div>
														<div class='sold_title ml-auto'>Already sold: <span>28</span></div>
													</div>
													<div class='available_bar'><span style='width:17%'></span></div>
												</div>
												<div class='deals_timer d-flex flex-row align-items-center justify-content-start'>
													<div class='deals_timer_title_container'>
														<div class='deals_timer_title'>Hurry Up</div>
														<div class='deals_timer_subtitle'>Offer ends in:</div>
													</div>
													<div class='deals_timer_content ml-auto'>
														<div class='deals_timer_box clearfix' data-target-time=''>
															<div class='deals_timer_unit'>
																<div id='deals_timer1_hr' class='deals_timer_hr'></div>
																<span>hours</span>
															</div>
															<div class='deals_timer_unit'>
																<div id='deals_timer1_min' class='deals_timer_min'></div>
																<span>mins</span>
															</div>
															<div class='deals_timer_unit'>
																<div id='deals_timer1_sec' class='deals_timer_sec'></div>
																<span>secs</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										";
									}
								?>

							</div>

						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>
					
					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Featured</li>
									<!-- IF YOU WANT TO ADD SOME MORE fEATURED (THEY LL SHOW LIKE OTHER DIVS WHICH U HAVE TO SLIDE TO SEE!) -->
									<!-- <li>On Sale</li> -->
									<!-- <li>Best Rated</li> -->
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel active">
<!--PRODUCTS BY CAT IF ISSET ELSE ALL PRODUCTS-->	<div class="featured_slider slider">
									<?php
									if (isset($_SESSION['selected_categorie'])) {
											$sql = "SELECT * FROM product WHERE id_categorie = '$_SESSION[selected_categorie]'";
											$req = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_assoc($req)){
												// calcul discount : 
												$discount = 100-($row['prix_promo'] * 100) / $row['prix_fix']; 
												$prc_dis = round($discount).'%';
												$check_discount = "product_discount";

												// Show product:
												echo "
													<div class='featured_slider_item'>
														<div class='border_active'></div>
														<div class='product_item discount d-flex flex-column align-items-center justify-content-center text-center'>
															<div class='product_image d-flex flex-column align-items-center justify-content-center'><img src='images/$row[image]' alt=''></div>
															<div class='product_content'>
																<div class='product_price discount'>";
																	if($row['prix_promo'] != 0){
																		$row['prix_promo'];
																		$check_discount = 'product_discount';
																			echo"$$row[prix_promo]<span>$$row[prix_fix]</span> ";
																	}else{
																			echo"$$row[prix_fix]<span> ";
																			$check_discount = '';
																			$prc_dis = '';
																	}
																	
												echo			"</div>
																<div class='product_name'><div><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div></div>
																<div class='product_extras'>
																	<div class='product_color'>
																		<input type='radio' checked name='product_color' style='background:#b19c83'>
																		<input type='radio' name='product_color' style='background:#000000'>
																		<input type='radio' name='product_color' style='background:#999999'>
																	</div>
																	<a href='index.php?add_cart=$row[id_product]' class='product_cart_button'>Add to Cart</a>
																</div>
															</div>
															<div class='product_fav'><i class='fas fa-heart'></i></div>
															<ul class='product_marks'>
																<li class='product_mark $check_discount'>$prc_dis</li>
																<li class='product_mark product_new'>new</li>
															</ul>
														</div>
													</div>		
												";
												
												
											}
										}else{

											$sql = "SELECT * FROM product ";
											$req = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_assoc($req)){
												// calcul discount : 
												$discount = 100-($row['prix_promo'] * 100) / $row['prix_fix']; 
												$prc_dis = round($discount).'%';
												$check_discount = "product_discount";

												// Show product:
												echo "
													<div class='featured_slider_item'>
														<div class='border_active'></div>
														<div class='product_item discount d-flex flex-column align-items-center justify-content-center text-center'>
															<div class='product_image d-flex flex-column align-items-center justify-content-center'><img src='images/$row[image]' alt=''></div>
															<div class='product_content'>
																<div class='product_price discount'>";
																	if($row['prix_promo'] != 0){
																		$row['prix_promo'];
																		$check_discount = 'product_discount';
																			echo"$$row[prix_promo]<span>$$row[prix_fix]</span> ";
																	}else{
																			echo"$$row[prix_fix]<span> ";
																			$check_discount = '';
																			$prc_dis = '';
																	}
																	
												echo			"</div>
																<div class='product_name'><div><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div></div>
																<div class='product_extras'>
																	<div class='product_color'>
																		<input type='radio' checked name='product_color' style='background:#b19c83'>
																		<input type='radio' name='product_color' style='background:#000000'>
																		<input type='radio' name='product_color' style='background:#999999'>
																	</div>
																	<div class='product_cart_button'>
																	<a href='index.php?add_cart=$row[id_product]'>Add to Cart</a>
																	</div>
																</div>
															</div>
															<div class='product_fav'><i class='fas fa-heart'></i></div>
															<ul class='product_marks'>
																<li class='product_mark $check_discount'>$prc_dis</li>
																<li class='product_mark product_new'>new</li>
															</ul>
														</div>
													</div>		
												";
											}
										}	

									?>


								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>


							<!-- if u added new features you place the content here !!! for the pic size u better choose 178x178 -->
							<!-- Product Panel -->

							<!-- <div class="product_panel panel">
								<div class="featured_slider slider">

									

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div> -->


							<!-- Product Panel -->

							<!-- <div class="product_panel panel">
								<div class="featured_slider slider">

									
								</div>
								<div class="featured_slider_dots_cover"></div>
							</div> -->

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Popular Categories -->

	<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Popular Categories</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link"><a href="#">full catalog</a></div>
					</div>
				</div>
				
				<!-- Popular Categories Slider -->

				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="images/popular_1.png" alt=""></div>
									<div class="popular_category_text">Smartphones & Tablets</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="images/popular_2.png" alt=""></div>
									<div class="popular_category_text">Computers & Laptops</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="images/popular_3.png" alt=""></div>
									<div class="popular_category_text">Gadgets</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="images/popular_4.png" alt=""></div>
									<div class="popular_category_text">Video Games & Consoles</div>
								</div>
							</div>

							<!-- Popular Categories Item -->
							<div class="owl-item">
								<div class="popular_category d-flex flex-column align-items-center justify-content-center">
									<div class="popular_category_image"><img src="images/popular_5.png" alt=""></div>
									<div class="popular_category_text">Accessories</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Banner -->

	<div class="banner_2">
		<div class="banner_2_background" style="background-image:url(images/banner_2_background.jpg)"></div>
		<div class="banner_2_container">
			<div class="banner_2_dots"></div>
			<!-- Banner 2 Slider -->

			<div class="owl-carousel owl-theme banner_2_slider">
				<?php
				// for the banner's picture you better  choose that size : 858x476
				// select the best sells in categorie .. you can change how much to select by changing the variable below :
				$much_select = 5;
				$sql = "SELECT * FROM product ORDER BY product_sell DESC LIMIT $much_select";
				$req = mysqli_query($conn, $sql);

				while ($row = mysqli_fetch_assoc($req)) {
					echo "
						<!-- Banner 2 Slider Item -->
						<div class='owl-item'>
							<div class='banner_2_item'>
								<div class='container fill_height'>
									<div class='row fill_height'>
										<div class='col-lg-4 col-md-6 fill_height'>
											<div class='banner_2_content'>
												<div class='banner_2_title'>$row[nom_product]</div>
												<div class='banner_2_text'>$row[description]</div>
												<div class='rating_r rating_r_4 banner_2_rating'><i></i><i></i><i></i><i></i><i></i></div>
												<div class='button banner_2_button'><a href='#'>Explore</a></div>
											</div>
										</div>
										<div class='col-lg-8 col-md-6 fill_height'>
											<div class='banner_2_image_container'>
												<div class='banner_2_image'><img src='images/$row[image]' alt=''></div>
											</div>
										</div>
									</div>
								</div>			
							</div>
						</div>
						";
				}
				?>

			</div>
		</div>
	</div>

	<!-- Hot New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Last products</div>
							<ul class="clearfix">
								<li class="active">Featured</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-9" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										<?php
											// here we ll show the latest 30 product (of cours u can change that number below)
											$much_select = 30;
											$sql = "SELECT * FROM product ORDER BY id_product DESC LIMIT $much_select";
											$req = mysqli_query($conn, $sql);

											while ($row = mysqli_fetch_assoc($req)) {
												if ($row['prix_promo']!=0) {
													$price = $row['prix_promo'];
												}else{
													$price = $row['prix_fix'];
												}
												
												echo"
												<!-- Slider Item -->
												<div class='arrivals_slider_item'>
													<div class='border_active'></div>
													<div class='product_item is_new d-flex flex-column align-items-center justify-content-center text-center'>
														<div class='product_image d-flex flex-column align-items-center justify-content-center'><img src='images/$row[image]' alt=''></div>
														<div class='product_content'>
															<div class='product_price'>$$price</div>
															<div class='product_name'><div><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div></div>
															<div class='product_extras'>
																<div class='product_color'>
																	<input type='radio' checked name='product_color' style='background:#b19c83'>
																	<input type='radio' name='product_color' style='background:#000000'>
																	<input type='radio' name='product_color' style='background:#999999'>
																</div>
																<div class='product_cart_button'><a href='index.php?add_cart=$row[id_product]'>Add to cart</a></div>
															</div>
														</div>
														<div class='product_fav'><i class='fas fa-heart'></i></div>
														<ul class='product_marks'>
															<li class='product_mark product_discount'>-25%</li>
															<li class='product_mark product_new'>new</li>
														</ul>
													</div>
												</div>
												";
											}
										?>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>

							</div>



<?php
	// here im puting a random categorie and random product :
	$sql = "SELECT * FROM product ORDER BY RAND() LIMIT 1";
	$req = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($req);
	if ($row['prix_promo']!=0) {
		$price = $row['prix_promo'];
	}else{
		$price = $row['prix_fix'];
	}
		echo "
			<div class='col-lg-3'>
				<div class='arrivals_single clearfix'>
					<div class='d-flex flex-column align-items-center justify-content-center'>
						<div class='arrivals_single_image'><img src='images/$row[image]' alt=''></div>
						<div class='arrivals_single_content'>
							<div class='arrivals_single_name_container clearfix'>
								<div class='arrivals_single_name'><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div>
								<div class='arrivals_single_price text-right'>$$price</div>
							</div>
							<div class='rating_r rating_r_4 arrivals_single_rating'><i></i><i></i><i></i><i></i><i></i></div>
							<form action='#'><button class='arrivals_single_button'>Add to Cart</button></form>
						</div>
						<div class='arrivals_single_fav product_fav active'><i class='fas fa-heart'></i></div>
						<ul class='arrivals_single_marks product_marks'>
							<li class='arrivals_single_mark product_mark'>new</li>
						</ul>
					</div>
				</div>
			</div>
		";
?>
					</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Best Sellers -->

	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Hot Best Sellers</div>
							<ul class="clearfix">

								<?php
									// initializing the TAB:
									$sql = "SELECT * FROM categorie ORDER BY RAND() LIMIT 3";
									$req = mysqli_query($conn, $sql);
									while($row = mysqli_fetch_assoc($req)){
										$tab_cat[] = $row['id_categorie'];
										$tab_name_cat[] = $row['name_categorie'];
									}
								?>
								<li class="active"><?php echo"$tab_name_cat[0]"; ?></li>
								<li><?php echo"$tab_name_cat[1]"; ?></li>
								<li><?php echo"$tab_name_cat[2]"; ?></li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>

						<div class="bestsellers_panel panel active">

							<!-- Best Sellers Slider -->

							<div class="bestsellers_slider slider">
								
									<!-- well we have an array of the categorie elements id so we can use them to bring stuffs and show them -->

							<?php
								$sql = "SELECT * FROM product, categorie WHERE product.id_categorie = $tab_cat[0] AND product.id_categorie = categorie.id_categorie";
								$req = mysqli_query($conn, $sql);

								while ($row = mysqli_fetch_assoc($req)) {
									if ($row['prix_promo']!=0) {
										$discount = 100-($row['prix_promo'] * 100) / $row['prix_fix']; 
										$prc_dis = round($discount);
										$check_discount = "bestsellers_discount";
										$strct_price = "<div class='bestsellers_price discount'>$row[prix_promo]$<span>$row[prix_fix]$</span></div>";
									}else{
										$check_discount = ""; 
										$strct_price = "<div class='bestsellers_price discount'>$row[prix_fix]$</div>";											
									}
									echo "
									<div class='bestsellers_item discount'>
										<div class='bestsellers_item_container d-flex flex-row align-items-center justify-content-start'>
											<div class='bestsellers_image'><img src='images/$row[image]' alt=''></div>
											<div class='bestsellers_content'>
												<div class='bestsellers_category'><a href='#'>$row[name_categorie]</a></div>
												<div class='bestsellers_name'><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div>
												<div class='rating_r rating_r_4 bestsellers_rating'><i></i><i></i><i></i><i></i><i></i></div>
												$strct_price
											</div>
										</div>
										<div class='bestsellers_fav active'><i class='fas fa-heart'></i></div>
										<ul class='bestsellers_marks'>
											<li class='bestsellers_mark $check_discount'>$prc_dis%</li>
										</ul>
									</div>
									";
								}
							?>
								

							</div>
						</div>

						<div class="bestsellers_panel panel">

							<!-- Best Sellers Slider -->

							<div class="bestsellers_slider slider">

								<!-- Best Sellers Item -->
								<?php
								$sql = "SELECT * FROM product, categorie WHERE product.id_categorie = $tab_cat[1] AND product.id_categorie = categorie.id_categorie";
								$req = mysqli_query($conn, $sql);

								while ($row = mysqli_fetch_assoc($req)) {
									if ($row['prix_promo']!=0) {
										$discount = 100-($row['prix_promo'] * 100) / $row['prix_fix']; 
										$prc_dis = round($discount);
										$check_discount = "bestsellers_discount";
										$strct_price = "<div class='bestsellers_price discount'>$row[prix_promo]$<span>$row[prix_fix]$</span></div>";
									}else{
										$check_discount = ""; 
										$strct_price = "<div class='bestsellers_price discount'>$row[prix_fix]$</div>";											
									}
									echo "
									<div class='bestsellers_item discount'>
										<div class='bestsellers_item_container d-flex flex-row align-items-center justify-content-start'>
											<div class='bestsellers_image'><img src='images/$row[image]' alt=''></div>
											<div class='bestsellers_content'>
												<div class='bestsellers_category'><a href='#'>$row[name_categorie]</a></div>
												<div class='bestsellers_name'><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div>
												<div class='rating_r rating_r_4 bestsellers_rating'><i></i><i></i><i></i><i></i><i></i></div>
												$strct_price
											</div>
										</div>
										<div class='bestsellers_fav active'><i class='fas fa-heart'></i></div>
										<ul class='bestsellers_marks'>
											<li class='bestsellers_mark $check_discount'>$prc_dis%</li>
										</ul>
									</div>
									";
								}
							?>
							</div>
						</div>

						<div class="bestsellers_panel panel">

							<!-- Best Sellers Slider -->

							<div class="bestsellers_slider slider">

								<!-- Best Sellers Item -->
								<?php
								$sql = "SELECT * FROM product, categorie WHERE product.id_categorie = $tab_cat[2] AND product.id_categorie = categorie.id_categorie";
								$req = mysqli_query($conn, $sql);

								while ($row = mysqli_fetch_assoc($req)) {
									if ($row['prix_promo']!=0) {
										$discount = 100-($row['prix_promo'] * 100) / $row['prix_fix']; 
										$prc_dis = round($discount);
										$check_discount = "bestsellers_discount";
										$strct_price = "<div class='bestsellers_price discount'>$row[prix_promo]$<span>$row[prix_fix]$</span></div>";
									}else{
										$check_discount = ""; 
										$strct_price = "<div class='bestsellers_price discount'>$row[prix_fix]$</div>";											
									}
									echo "
									<div class='bestsellers_item discount'>
										<div class='bestsellers_item_container d-flex flex-row align-items-center justify-content-start'>
											<div class='bestsellers_image'><img src='images/$row[image]' alt=''></div>
											<div class='bestsellers_content'>
												<div class='bestsellers_category'><a href='#'>$row[name_categorie]</a></div>
												<div class='bestsellers_name'><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div>
												<div class='rating_r rating_r_4 bestsellers_rating'><i></i><i></i><i></i><i></i><i></i></div>
												$strct_price
											</div>
										</div>
										<div class='bestsellers_fav active'><i class='fas fa-heart'></i></div>
										<ul class='bestsellers_marks'>
											<li class='bestsellers_mark $check_discount'>$prc_dis%</li>
										</ul>
									</div>
									";
								}
							?>

							</div>
						</div>
					</div>
						
				</div>
			</div>
		</div>
	</div>

	<!-- Adverts -->

	<div class="adverts">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 advert_col">
					
					<!-- Advert Item -->
					<?php
						$sql = "SELECT * FROM categorie WHERE id_categorie = $tab_cat[0]";
						$req = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($req);

						echo "
						<div class='advert d-flex flex-row align-items-center justify-content-start'>
							<div class='advert_content'>
								<div class='advert_title'><a href='#'>Trends 2018</a></div>
								<div class='advert_text'>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
							</div>
							<div class='ml-auto'><div class='advert_image'><img src='images/adv_1.png' alt=''></div></div>
						</div>
						";
					?>
					
				</div>

				<div class="col-lg-4 advert_col">
					
					<!-- Advert Item -->
					<?php
						$sql = "SELECT * FROM categorie WHERE id_categorie = $tab_cat[1]";
						$req = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($req);

						echo "
						<div class='advert d-flex flex-row align-items-center justify-content-start'>
							<div class='advert_content'>
								<div class='advert_subtitle'>Trends 2018</div>
								<div class='advert_title_2'><a href='#'>Sale -45%</a></div>
								<div class='advert_text'>Lorem ipsum dolor sit amet, consectetur.</div>
							</div>
							<div class='ml-auto'><div class='advert_image'><img src='images/adv_2.png' alt=''></div></div>
						</div>
						";
					?>
					
				</div>

				<div class="col-lg-4 advert_col">
					
					<!-- Advert Item -->
					<?php
						$sql = "SELECT * FROM categorie WHERE id_categorie = $tab_cat[2]";
						$req = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($req);

						echo "
						<div class='advert d-flex flex-row align-items-center justify-content-start'>
							<div class='advert_content'>
								<div class='advert_title'><a href='#'>Trends 2018</a></div>
								<div class='advert_text'>Lorem ipsum dolor sit amet, consectetur.</div>
							</div>
							<div class='ml-auto'><div class='advert_image'><img src='images/adv_3.png' alt=''></div></div>
						</div>
						";
					?>
					
				</div>

			</div>
		</div>
	</div>

	<!-- Trends -->

	<div class="trends">
		<div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
		<div class="trends_overlay"></div>
		<div class="container">
			<div class="row">

				<!-- Trends Content -->
				<div class="col-lg-3">
					<div class="trends_container">
						<h2 class="trends_title">Best Sells</h2>
						<div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
						<div class="trends_slider_nav">
							<div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
					</div>
				</div>

				<!-- Trends Slider -->
				<div class="col-lg-9">
					<div class="trends_slider_container">

						<!-- Trends Slider -->

						<div class="owl-carousel owl-theme trends_slider">

							<?php
								$sql = "SELECT * FROM product,categorie WHERE product.id_categorie = categorie.id_categorie ORDER BY product_sell DESC";
								$req = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($req)) {
									if ($row['prix_promo']!=0) {
										$price = $row['prix_promo'];
									}else{
										$price = $row['prix_promo'];
									}
									echo "
									<div class='owl-item'>
										<div class='trends_item'>
											<div class='trends_image d-flex flex-column align-items-center justify-content-center'><img src='images/$row[image]' alt=''></div>
											<div class='trends_content'>
												<div class='trends_category'><a href='#'>$row[name_categorie]</a></div>
												<div class='trends_info clearfix'>
													<div class='trends_name'><a href='product.php?id_product=$row[id_product]'>$row[nom_product]</a></div>
													<div class='trends_price'>$price$</div>
												</div>
											</div>
											<ul class='trends_marks'>
											</ul>
											<div class='trends_fav'><i class='fas fa-heart'></i></div>
										</div>
									</div>
									";
								}
							?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


<!--if you want add cookies -->
	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Recently Viewed</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							
							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_1.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Beoplay H7</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_2.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225</div>
										<div class="viewed_name"><a href="#">Samsung J730F...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_4.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$379</div>
										<div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_5.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$225<span>$300</span></div>
										<div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>

							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="images/view_6.jpg" alt=""></div>
									<div class="viewed_content text-center">
										<div class="viewed_price">$375</div>
										<div class="viewed_name"><a href="#">Speedlink...</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
							
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_1.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_2.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_3.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_4.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_5.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_6.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_7.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="images/brands_8.jpg" alt=""></div></div>

						</div>
						
						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

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
							<div class="newsletter_title">Sign up for Newsletters</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form class="newsletter_form" method='post'>
								<input type="email" name='mail' class="newsletter_input" required="required" placeholder="Enter your email address">
								<input type='submit' name='subscriber' class="newsletter_button" value='Subscribe'>
							</form>

							<?php
								if (isset($_POST['subscriber'])) {
									$mail = $_POST['mail'];

									$sql = "INSERT INTO subscribers(mail_subscriber) VALUES ('$mail')";
									mysqli_query($conn, $sql);
								}
							?>
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
						<div class="footer_phone">+212 000 00 0000</div>
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

Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://www.mycady.com">MyCady</a> 
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
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/slick-1.8.0/slick.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>

</html>