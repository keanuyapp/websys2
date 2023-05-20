<!DOCTYPE html>
<html lang="en">
   <head>
	<style>
 .popup {
     position: fixed;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
     width: 100%;
     height: 100%;
     background-color: rgba(0, 0, 0, 0.5);
     display: flex;
     align-items: center;
     justify-content: center;
 }
 
 .popup-content {
     background-color: white;
     padding: 20px;
     margin-top: 20%; /* Adjust the value to set the desired padding on top */
 }
 
 .popup h2 {
     margin-top: 0;
 }
 
 .popup button {
     margin-top: 10px;
 }

 /* Additional Styles */
 .popup-content {
     max-width: 400px; /* Optional: Set a maximum width for the popup */
     margin: auto; /* Center the popup horizontally */
 }
</style>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>pro</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/1243" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <div id="myNav" class="menu_sid">
         <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
         <div class="menu_sid-content">
            <a href="index.php">Home</a>
            <a href="index.php?login=true&#login">Log in</a>
            <a href="index.php?register=true&#register">Register</a>
            <a href="products.php?">Products</a>
            <a href="myorders.php?myorders=true">My Orders</a>
            <a href="cart.php?products=true#portfolio">Cart</a>
         </div>
            
         </div>
      </div>
      <?php if ($_COOKIE['email'] == ""){
					print('<li><a href="index.php?login=true&#login">Login</a></li>
					<li><a href="index.php?register=true&#register">Register</a></li>');
					}
					else{
						print "<li><a style='color:black' href=cart.php?products=true#portfolio>Cart</a></li>";
						print "<li><a style='color:black' href=index.php?logout=true>Logout</a></li>";
						print "<h5 style='color:#eb5d1e'>  Welcome " . $_COOKIE['type'];
						print "  " .$_COOKIE['email'];
					}?>
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
         <div class="menu_sitbar">
            <ul class="menu">
               <li><button type="button" >
                  <img style="" onclick="openNav()" src="images/menu_icon.png" alt="#"/>
                  </button>
               </li>
            </ul>
         </div>

      </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- our protien  -->
      <div id="protien" class="protien_main">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Products</h2>
                  </div>
                  
                  <main id="main">

<!-- ======= Portfolio Section ======= -->

<?php 
								//mysqli_close($dlink);
									$prod_id = $_REQUEST['prodid'];
									$counter = 0;
																	
									$hostname="localhost";
									$database="Shopee";
									$db_login="root";
									$db_pass="";

									$dlink = mysqli_connect($hostname, $db_login, $db_pass) or die("Could not connect");
									mysqli_select_db($dlink,$database) or die("Could not select database");

									if($_REQUEST['prodid'] != ""){
											$query = "SELECT * FROM products WHERE prodid='".$prod_id."'";
											$result = mysqli_query($dlink,$query) or die(mysqli_error($dlink));
											$get_order = mysqli_fetch_array($result);
				
										if (!isset($_COOKIE["orders"])){	
											
											$flavors = array(
												array(
														"prodid" => $prod_id,
														"product" => $get_order['productname'],
														"image" => $get_order['productimage'],
														"price" => $get_order['ourprice'],
														"order" => false,
														"Quantity" => 1
													),												
											);
			
																						
												$serialized_shoes = serialize($shoes);
												setcookie("orders", $serialized_shoes, time() + 3600); // cookie expires in 1 hour
											
									
												

										} else {
											$getcooookeis = $_COOKIE['orders'];
											$shoes = unserialize($getcooookeis);
											$new = true; // Flag to check if the product is new

											// Loop to check if the product being added already exists in the array
											foreach ($shoes as &$shoe) {
												// If the product being added already exists in the array, increase the order quantity by one
												if ($shoe['flavor'] == $get_order['productname']) {
													$shoe['Quantity'] = $shoe['Quantity'] + 1;
													$new = false;
												}
											}

											if ($new) {
												$new_shoes = array(
													"prodid" => $prod_id,
													"product" => $get_order['productname'],
													"image" => $get_order['productimage'],
													"price" => $get_order['ourprice'],
													"order" => false,
													"Quantity" => 1
												);
												$shoes[] = $new_shoes;
											}

											// Serialize the array and update the cookie
											$new_shoes = serialize($shoes);
											setcookie("orders", $new_shoes, time() + 3600);

										}
									}
							// Query the database for the categories of products

										$categorySearch = "SELECT prodcat FROM products GROUP BY prodcat";
										$categoryResults = mysqli_query($dlink,$categorySearch) or die(mysqli_error($dlink));
										$categoryNumOfResults = mysqli_num_rows($categoryResults);

										// Create an array to hold the names of the categories
										$categoryNames = array();
										for ($i = 0; $i < $categoryNumOfResults; $i++) {
											$categoryRow = mysqli_fetch_array($categoryResults);
											$categoryNames[] = $categoryRow['prodcat'];
										}

										// Create an array to hold the categories and their products
										$category = array();

										for ($i = 0; $i < $categoryNumOfResults; $i++) {

											// Initialize an array for each category
											$category[$categoryNames[$i]] = array();

											// Query the database for the products within the category
											$productsSearch = "SELECT * FROM products WHERE prodcat='" . $categoryNames[$i] . "'";
											$productsResults = mysqli_query($dlink,$productsSearch) or die(mysqli_error($dlink));
											$productsNumOfResults = mysqli_num_rows($productsResults);

											// Add each product to the category array
											for ($j = 0; $j < $productsNumOfResults; $j++) {
												$productsRow = mysqli_fetch_array($productsResults);
												$category[$categoryNames[$i]][] = array(
												"name" => $productsRow['productname'],
												"id" => $productsRow['prodid'],
												"image" => $productsRow['productimage'],
												"quantity" => $productsRow['quantity'],
												"order" => false,											
												"price" => $productsRow['ourprice']
												);
											}
										}
										
										// if url request of category does not have any value
										if (isset($_COOKIE['email']) && $_COOKIE['type'] == "Customer") {
												foreach ($category as $categoryName => $products) {	
													// Print the category names
													echo "<a href='products.php?category=".$categoryName."'><h1 align='center'style='color:black'>" . $categoryName . "</h2></a>";
												}
										}
												
												if (isset($_REQUEST['category'])) {
													$selectedCategory = $_REQUEST['category'];
												}




												$singleuse;

												// Check if a category is selected or no category is specified
												
												foreach ($category as $categoryName => $products) {
													
														if (empty($selectedCategory) || $categoryName === $selectedCategory) {
															// Print the category name
															$popup;
															foreach ($products as $productDetails) {
																$popup = "popup-" . $productDetails['id'];
															}
															
															echo "<h2 align='center' style='color:black'>" . $categoryName;
															if (isset($_COOKIE['email']) && $_COOKIE['type'] == "Admin"){
															echo '
																	<select name="test" onchange="openPopup(this.value, \'' . $popup . '\')" style="display: inline-block;">
																		<option value="">---</option>
																		<option value="' . $popup . 'Change">Change</option>
																	</select>';																		
															}
															
															echo "<table style='align:center; width: 100%;'>";
															
															echo "<tr>";	
															
															 // Display product image & name
																foreach ($products as $productDisplay) {
																	echo "<th align='center'>";
																	echo "<a><img style='height: 200px;' src='" . $productDisplay['image'] . "' /></a>";
																	echo "<a style='color:black'>" . $productDisplay['name'] . "</a>";
																	echo "</th>";
																}
																echo "</tr>";
		
																// Display product information & price
																foreach ($products as $productDetails) {
																	$popupId = "popup-" . $productDetails['id'];
																	echo "<td align='center'>";
															
																	// If product's stock is not empty (if quantity != 0), display details
																	if ($productDetails['quantity'] > 0) {
																		echo "<a style='color:black'> ID: " . $productDetails['id'] . "</a>";
																		echo "<a style='color:black'> Quantity: " . $productDetails['quantity'] . "</a>";
																		echo "<a style='color:black'> Price: " . $productDetails['price'] . "</a>";
																	}  else {
																		echo "<a style='color:black'> SOLD OUT </a>";
																	}
																
																	// If logged in user is a customer, show 'add to cart' button
																	if (isset($_COOKIE['email']) && $_COOKIE['type'] == "Customer") {
																			// If product's stock is not empty (if quantity != 0), display 'add to cart' button
																		if ($productDetails['quantity'] > 0) {
																			echo "<br><form action='products.php' method='post' enctype='multipart/form-data'>
																					<input type='hidden' name='prodid' value='" . $productDetails['id'] . "'>
																					<button type='submit' style='border: 1px solid; border-radius: 5px; background-color: white; color: black;'>Add to Cart</button>
																				</form>";
																			}

																	} 
																	
																	else if (isset($_COOKIE['email']) && $_COOKIE['type'] == "Admin") {
																		
																		$pName;
																		$pCat;
																		$pQuan;
																		$peed;
																		$peerice;
											
																		$query = "SELECT productName, prodcat, quantity,ourprice FROM products WHERE prodid = '" . $productDetails['id'] . "'";

																		$result = mysqli_query($dlink,$query) or die(mysqli_error($dlink));
																		if ($result && mysqli_num_rows($result) > 0) {
																			$row = mysqli_fetch_assoc($result);
																			$pName = $row['productName'];
																			$pCat = $row['prodcat'];
																			$pQuan = $row['quantity'];
																			$peed= $row['prodid'];
																			$peerice= $row['ourprice'];
																		}

																		echo '<div id="' . $popupId . '" class="popup" style="display: none;">
																			<div class="popup-content">
																				<h2>Edit Product ' . $productDetails['id'] . '</h2>					
																				<form action="products.php" method="Post" enctype="multipart/form-data">
																					<a>Product Category<input type="text" id="categ" name="categ" placeholder="Enter Category Name"value="'.$pCat.'"></a><br>
																					<a><img style="height: 100px;" src="' . $productDetails['image'] . '" /></a><br>                                                                      
																					<a>Image<input type="file" id="file" name="file" accept="image/png, image/jpeg, image/gif"></a><br>	
																					<input type="hidden" name="prodNUmber" value= "'.$productDetails['id'] .'">																			
																					<a>Product Name<input type="text" id="prodN " name="prodN" placeholder="Enter Product Name" value="' . $pName . '"></a><br>
																					<a>Quantity<input type="number" id="quantity" name="quantity" placeholder="Enter quantity" value="'.$pQuan.'"></a><br>
																					<a>Price<input type="number" id="price" name="price" placeholder="Enter price" value="'.$peerice.'"></a><br>
																					<button type="submit" name="submitBtn">Submit</button>	
																				</form>
																				<button onclick="closePopup(\'' . $popupId . '\')">Close</button>
																			</div>
																		</div>';

																		echo '<div id="insertPopup-' . $popupId . '" class="popup" style="display: none;">
																		<div class="popup-content">	
																			<h2>Insert Product</h2>
																			<form action="products.php" method="POST" enctype="multipart/form-data">
																				<a>Product Category<input type="text" id="categ" name="categ" placeholder="Enter Category Name" value="'.$pCat.'"></a><br>
																				<a>Image<input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif"></a><br>
																				<a>Product Name<input type="text" id="prodN" name="prodN" placeholder="Enter Product Name"></a><br>
																				<a>Product Description<input type="text" id="desc" name="desc" placeholder="Enter Product Description"></a><br>
																				<a>Product Link<input type="text" id="link" name="link" placeholder="Enter Product Link"></a><br>
																				<a>Last Price<input type="text" id="lastPrice" name="lastPrice" placeholder="Enter Last Price"></a><br>
																				<a>Our Price<input type="text" id="ourPrice" name="ourPrice" placeholder="Enter Our Price"></a><br>
																				<a>Quantity<input type="number" id="quantity" name="quantity" placeholder="Enter quantity"></a><br>
																				<button type="submit" name="insertBtn' . $productDetails['id'] . '">Insert</button>
																			</form>
																			<button onclick="closePopup(\'insertPopup-' . $popupId . '\')">Close</button>
																		</div>
																	</div>';

																	echo '<div id="deletePopup-' . $productDetails['id'] . '" class="popup" style="display: none;">
																			<div class="popup-content">
																				<h2>Delete Product ' . $productDetails['id'] . '</h2>
																				<p>Are you sure you want to delete this item?</p>
																				<form action="products.php" method="POST">
																					<input type="hidden" name="deleteProductId" value="' . $productDetails['id'] . '">
																					<button type="submit" name="deleteBtn">Delete</button>
																				</form>
																				<button onclick="closePopup(\'deletePopup-' . $productDetails['id'] . '\')">Cancel</button>
																			</div>
																			</div>';
																	
																	 echo '<div id="catPopup-' . $popupId . '" class="popup" style="display: none;">
																			<div class="popup-content">
																				<h2>Change Category</h2>					
																				<form action="products.php" method="Post" enctype="multipart/form-data">
																					<a>Product Category<input type="text" id="categ" name="categed" placeholder="Enter Category Name"value="'.$categoryName.'"></a><br>
																					
																					<button type="submit" name="catChanger[' . $productDetails['id'] . ']">Submit</button>
																				</form>
																				<button onclick="closePopup(\'catPopup-' . $popupId . '\')">Close</button>
																			</div>
																		</div>';
																		//<button type="submit" name="catChanger">Change</button>
																			
																	echo '<br>
																	<select name="test" onchange="openPopup(this.value, \'' . $popupId . '\')" style="display: inline-block;">
																		<option value="">---</option>
																		<option value="' . $popupId . 'Edit">Edit</option>
																		<option value="deletePopup-' . $productDetails['id'] . '">Delete</option>
																		<option value="' . $popupId . 'Insert">Insert</option>
																	</select>';
																	
																																			
																	echo '<script>
																			function openPopup(value, popupId) {
																				// Additional logic based on the selected value
																				if (value === popupId + "Edit") {
																					document.getElementById(popupId).style.display = "block";Editcat
																				} 
																				else if (value.includes("deletePopup")) {
																					document.getElementById(value).style.display = "block";
																				} else if (value === popupId + "Insert") {
																					document.getElementById("insertPopup-" + popupId).style.display = "block";
																				}else if (value === popupId + "Change") {
																					document.getElementById("catPopup-" + popupId).style.display = "block";
																				}
																				// Set the form\'s action attribute
																				document.getElementById(popupId).querySelector(\'form\').action = "products.php?popup=" + popupId;
																			}

																			function closePopup(popupId) {
																				document.getElementById(popupId).style.display = "none";
																			}
																			</script>';
																			
																			
																
												
																	if (isset($_POST['submitBtn'])) {
																		// get hidden value from input
																		$tangina = $_REQUEST['prodNUmber'];
																		$productName = $_REQUEST['prodN'];
																		$quantity = $_REQUEST['quantity'];
																		$category = $_REQUEST['categ'];
																		$price = $_REQUEST['price'];

																		$query = "UPDATE products SET prodcat = '$category', productname = '$productName', ourprice = '$price', quantity = '$quantity'";	
																		if (isset($_FILES)) {
																			$imageFile = $_FILES['file'];																		
																			if ($imageFile['error'] === UPLOAD_ERR_OK) {
																				$uploadDir = 'C:\wamp\www\sample\pro-html\img';
																				$imageName = $imageFile['name'];
																				$imagePath = $uploadDir . $imageName;
																				if (move_uploaded_file($imageFile['tmp_name'], $imagePath)) {
																					$query .= ", productimage = 'img/$imageName'";
																				}
																			}
																			// Update image based on prodid
																			$query .= " WHERE prodid = '" . $tangina . "'";
																			// Execute the update query
																			$result = mysqli_query($dlink, $query);
																			echo "<meta http-equiv='refresh' content='0;url=products.php'>";
																		}																													
																	}
																	else if (isset($_POST['insertBtn' . $productDetails['id']])) {
																		// Perform Insert Operation
																		$category = $_POST['categ'];
																		$productName = $_POST['prodN'];
																		$description = $_POST['desc'];
																		$productLink = $_POST['link'];
																		$lastPrice = $_POST['lastPrice'];
																		$ourPrice = $_POST['ourPrice'];
																		$quantity = $_POST['quantity'];
																		$imageName = '';
																	
																		if (isset($_FILES['image'])) {
																			$imageFile = $_FILES['image'];
																			
																			if ($imageFile['error'] === UPLOAD_ERR_OK) {
																				$uploadDir = 'C:\wamp\www\sample\pro-html\img';
																				$imageName = $imageFile['name'];
																				$imagePath = $uploadDir . $imageName;
																	
																				if (move_uploaded_file($imageFile['tmp_name'], $imagePath)) {
																					// Image uploaded successfully
																				}
																			}
																		}
																		if (empty($imageName)) {

																			$imageName = 'loading.gif'; // Replace with your default image filename
																		}
																		
																	
																		$query = "INSERT INTO products (prodcat, productName, productdesc, productLink, productimage, lastPrice, ourPrice, quantity) 
																				  VALUES ('$category', '$productName', '$description', '$productLink', 'assets/img/portfolio/$imageName', '$lastPrice', '$ourPrice', '$quantity');";
																	
																		$result = mysqli_query($dlink, $query);
																		echo "<meta http-equiv='refresh' content='0;url=products.php'>";
																	}
																	
																		
																		else if (isset($_POST['deleteBtn'])) {
																			// Handle the delete button press
																			$deleteProductId = $_REQUEST['deleteProductId'];
																			
																			// Perform the deletion logic for the given product ID
																			$query = "DELETE FROM products WHERE prodid = '$deleteProductId'";
																			$result = mysqli_query($dlink, $query) or die(mysqli_error($dlink));
																			
																			// Check if the deletion was successful
																			if ($result) {
																				echo "Item deleted successfully.";
																				
																			} else {
																				echo "Error deleting item.";
																			}
																			echo "<meta http-equiv='refresh' content='0;url=products.php'>";
																		}
																			
																		else if (isset($_POST['catChanger'][$productDetails['id']])) {
																			
																			$category = $_POST['categed'];
																			$test = $_POST['catcell'];
																			if (isset($category)) {
																				$query = "UPDATE products SET prodcat = '$category'WHERE prodcat = '$pCat'";
														
																				// Execute the update query
																				$result = mysqli_query($dlink, $query);
																				echo "<meta http-equiv='refresh' content='0;url=products.php'>";
																			}
																		
																	}
																		
																			
																	
																//admin	
																}
																
													
																
																	//  echo $quantity;
																	
																//loop for buttons main loop end
																}
															
														//if admin end	
														}
													
															echo "</td>";
															echo "<br>";
													
															echo "</tr>";
														
															echo "</table>";
														//big forloop end
														
													}
													
													if (isset($_COOKIE['email']) && $_COOKIE['type'] == "Admin"){
													echo '<form action="products.php" method="POST">
															<input type="hidden" name="Category">
															<button type="submit" name="Newcategory">New Category</button>
														  </form>';
													}
														
													if (isset($_POST['Newcategory'])) {
														$query = "INSERT INTO products (prodcat, productName, productdesc, productLink, productimage, lastPrice, ourPrice, quantity) VALUES ('New Category', '---', '---', '---', 'assets/img/portfolio/newcat.jpg', '0', '0', '0');";

																			$result = mysqli_query($dlink, $query);
																			echo "<meta http-equiv='refresh' content='0;url=products.php'>";
													}
														
														
												// $test = $_COOKIE['orders'];
												// $testerer = unserialize($test);
												// echo var_dump($test);	

										// Close MySQL connection
										mysqli_close($dlink);
									?>
			

<div class="section-title">
<p>Check our Products!</p>
</div>
<br>
<br>



                   
      <!-- end our protien  -->



      <!--  footer -->
      <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
      <footer>
         <div class="footer">
            <div class="daih_bg">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-12">
                        <ul class="conta">
                           <li><i class="fa fa-phone" aria-hidden="true"></i></li>
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> Location</li>
                           <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <img class="tex_left" src="images/logo2.png" alt="#"/>
                  </div>

                  <div class="col-sm-12">
                     <ul class="social2_icon">
                        <li><a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>

         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script>
         function openNav() {
           document.getElementById("myNav").style.width = "100%";
         }
         
         function closeNav() {
           document.getElementById("myNav").style.width = "0%";
         }
      </script>
   </body>
</html>