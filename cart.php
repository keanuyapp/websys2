<!DOCTYPE html>
<html lang="en">
   <head>
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
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
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


      <?php if ($_COOKIE['email'] == ""){
					print('<li><a href="index.php?login=true&#login">Login</a></li>
					<li><a href="index.php?register=true&#register">Register</a></li>');
					}
					else{
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
                     <h2>Cart</h2>
                  </div>
                  
        <div class="section-title">
          <h2>Products</h2>
          <p>Cart</p>

                  
          <?php 
								$hostname = "localhost";
								$database = "Shopee";
								$db_login = "root";
								$db_pass = "";
								
								$dlink = mysqli_connect($hostname, $db_login, $db_pass) or die("Could not connect");
								mysqli_select_db($dlink,$database) or die("Could not select database");
								$cart = unserialize($_COOKIE["orders"]);

								ob_start();

								if (isset($_COOKIE['orders']) && count($_COOKIE['orders']) > 0) {
										// Rest of your code goes here
									
										if (isset($_REQUEST['delete']) && is_numeric($_REQUEST['delete'])) {
											$deleteIndex = (int) $_REQUEST['delete'];
											if ($deleteIndex >= 0 && $deleteIndex < count($cart)) {
												unset($cart[$deleteIndex]);
												$cart = array_values($cart); // Reset array keys
												$serialized_cart = serialize($cart);
												setcookie("orders", $serialized_cart, time() + 3600);
											}
											ob_end_clean(); // Clear output buffer
											header("Location:cart.php");
											exit();
										}
										$compiled_orders = $_COOKIE['orders'];
										$orders = unserialize($compiled_orders);
										$counters = 0;
										$overall_price = 0;
										
										/* start of table header */
										print('	<table>
													<thead>
														<tr align="center">
															<td style="width: 50px"></td>
															<td style="width: 200px"><h3 style="color:black">Image</h3></td>
															<td style="width: 300px"><h3 style="color:black">ID</h3></td>
															<td style="width: 300px"><h3 style="color:black">Name</h3></td>
															<td style="width: 100px"><h3 style="color:black">Price</h3></td>
															<td style="width: 200px"><h3 style="color:black">Quantity</h3></td>
															<td style="width: 200px"><h3 style="color:black">Total</h3></td>
															<td style="width: 300px"></td>
														</tr>
													</thead>
											<tbody>');
											$index = 0;
											foreach ($orders as &$orderlist) {
												ob_start();
												$place = strval($index . "word");
												$place2 = strval($index . "ha");
												$orderList_query = "SELECT quantity FROM products WHERE prodid='" . $orderlist['prodid'] . "'";
												$orderlist_call = mysqli_query($dlink, $orderList_query) or die(mysqli_error($dlink));
												$orderlist_results = mysqli_fetch_array($orderlist_call);
											
												$calculated_price = $orderlist['price'] * $orderlist['Quantity'];
												$overall_price += $calculated_price;
												
												print("<tr align='center'>
													<td>
													<form method='post'>
														<input type='hidden' name=".$place2." value='false'>
														<input type='checkbox' name=".$place2." value='true'".($orderlist['order'] === 'true' ? 'checked' : '')." onclick='this.form.submit();'>												
													</form></td>
													<td>
														<img style='height: 100px' src='" . $orderlist['image'] . "' alt=''/>
													</td>
													<td>
														<h3 style='color:black'>" . $orderlist['prodid'] . "</h3>
													</td>
													<td>
														<h3 style='color:black'>" . $orderlist['product'] . "</h3>
													</td>
													<td>
														<h3 style='color:black'>" . $orderlist['price'] . "</h3>
													</td>
													<td>");
											
												if (isset($_POST[$place])) {
													$pota = $_POST[$place];
													if (!empty($pota)) {
														// Update the quantity in the $orderlist array
														$orderlist['Quantity'] = $pota;
													}
													
													header("Refresh: 0");
												}
												if (isset($_POST[$place2])) {
													$value = $_POST[$place2];
													if ($value === "true") {
														$orderlist["order"] = $value;
													} else {
														$orderlist["order"] = "false";
														
													}
													
           											header("Refresh: 0");																								
												}
											
												print("<form method='post'>
													<select name='".$place."' onchange='this.form.submit()'>
														<option value='".$orderlist['Quantity']."' selected>". $orderlist['Quantity'] . "</option>
														<option value='1'>1</option>
														<option value='2'>2</option>
														<option value='3'>3</option>
														<option value='4'>4</option>
														<option value='5'>5</option>
														<option value='6'>6</option>
														<option value='7'>7</option>
														<option value='8'>8</option>
														<option value='9'>9</option>
														<option value='10'>10</option>
													</select>
												</form>
												</td>");
											
												print("<td>
													<h3 style='color:black'>" . $calculated_price . "</h3>
												</td>

												<td>
													<h2><a href='cart.php?delete=".$index."'>delete</a></h2>
												</td>
												</tr>");
											
												// Update the cookies with the modified quantity
												$serialized_cart = serialize($orders);
												setcookie("orders", $serialized_cart, time() + 3600);
												
												$index++;
											}
											if ($_REQUEST['place_order'] == 'true') {
												$cart = unserialize($_COOKIE["orders"]);
												
											
												$newCart = array(); // New array to hold unchecked items
											
												for ($x = 0; $x < count($cart); $x++) {
													if ($cart[$x]["order"] == true) {
														$query = "INSERT INTO purchase (userid, prodid, quantity,total, date, status) VALUES ('".$_COOKIE['email']."', '".$cart[$x]['prodid']."', '".$cart[$x]['Quantity']."', '".$cart[$x]['price']*$cart[$x]['Quantity']."', '".date("Y-m-d H:i:s")."', 'Pending');";
														mysqli_query($dlink, $query) or die(mysqli_error($dlink));
													} else {
														$newCart[] = $cart[$x]; // Add unchecked item to the new array
													}
												}
											
												$cart = $newCart; // Assign the new array back to $cart
											
												$serialized_cart = serialize($cart);
												setcookie("orders", $serialized_cart, time() + 3600);
												echo "<meta http-equiv='refresh' content='0;url=cart.php'>";
											}
											
											mysqli_close($dlink);
											
											ob_end_flush();
											
											print("</tbody>
											</table>");
										
											print("<div align='right'>
											<h3 style='color:black'><a href='cart.php?place_order=true'>Place Order</a></h3>	
											<h3 style='color:black'>Total Price: " . $overall_price . "</h3>
											</div><br>");
												
											// Rest of your code goes here
										}											

				
										
										
								?>




                            </div>
               </div>
            </div>

         </div>
      </div>

    </div>
                   
      <!-- end our protien  -->



      <!--  footer -->
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