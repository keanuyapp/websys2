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
      <?php if ($_COOKIE['email'] == ""){
					print('<li><a href="index.php?login=true&#login">Login</a></li>
					<li><a href="index.php?register=true&#register">Register</a></li>');
					}
					else{
						print "<li><a style='color:black' href=cart.php?products=true#portfolio>Cart</a></li>";
                        print "<li><a style='color:black' href=myorders.php>My Orders</a></li>";
						print "<li><a style='color:black' href=index.php?logout=true>Logout</a></li>";
						print "<h5 style='color:#eb5d1e'>  Welcome " . $_COOKIE['type'];
						print "  " .$_COOKIE['email'];
					}?>
 <?php 
		$hostname="localhost";
		$database="Shopee";
		$db_login="root";
		$db_pass="";

		$dlink = mysqli_connect($hostname, $db_login, $db_pass) or die("Could not connect");
		mysqli_select_db($dlink,$database) or die("Could not select database");
		if($_REQUEST['place_order']== 'true'){
			$cart = unserialize($_COOKIE["orders"]);
		
			foreach ($cart as $prodid) {
        if($prodid["quantity"]!=0){

            $query = "insert into purchase(userid,prodid,quantity,date,status) values('".$_COOKIE['userid']."','".$prodid['prodid']."','".$prodid['quantity']."','".date("Y-m-d H:i:s")."','".("Pending")."');";
                            
            mysqli_query($dlink,$query) or die(mysqli_error($dlink));

            $query = "update products set quantity = quantity - " .$prodid['quantity']." where prodid = ".$prodid['prodid'].";";
            mysqli_query($dlink,$query) or die(mysqli_error($dlink));

        }
      }
		}
?>
      <div id="myNav" class="menu_sid">
         <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
         <div class="menu_sid-content">
            <a href="index.php">Home</a>
            <a href="index.php?login=true&#login">Log in</a>
            <a href="index.php?register=true&#register">Register</a>
            <a href="products.php?">Products</a>
         </div>

      </div>
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
            <ul class="social_icon">
               <li><a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
               <li><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
               <li><a href="javascript:void(0)"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
         </div>
         <div class="header_full_bg">
            <div class="header_top">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="logo">
                           <a href="index.html"><img src="images/logo.png" alt="#"/></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="banner">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-5">
                        <div class="banner_text">
                           <h1>Pro<br> Body Builder Protien</h1>
                           <a class="get_btn" href="#about" role="button" >About Protien</a> <a class="get_btn" href="#contact" role="button">Contact Us</a>
                        </div>
                     </div>
                     <div class="col-md-7">
                        <img class="bann_img" src="images/banner_ing.png" alt="#"/>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- our protien  -->

      <div class="section-title">
          <p>Orders</p>
		  <?php 
							$hostname="localhost";
							$database="samplewebsite";
							$db_login="root";
							$db_pass="";

              				$dlink = mysqli_connect($hostname, $db_login, $db_pass) or die("Could not connect");
							mysqli_select_db($dlink,$database) or die("Could not select database");
							
							$month = $_GET['month'];
							$day = $_GET['day'];
							if($_COOKIE["type"]=="Admin"){
							
								if($_REQUEST['sorted']){
									$query = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Pending' AND DATE(date) = '2023-$month-$day';";	
									$query2 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Accepted' AND DATE(date) = '2023-$month-$day';";
									$query3 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Completed' AND DATE(date) = '2023-$month-$day';";
									$query4 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Return/Refund' AND DATE(date) = '2023-$month-$day';";
								}else{

									$query = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Pending';";
									$query2 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Accepted';";
									$query3 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Completed';";
									$query4 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Return/Refund';";
								}
	
										$result = mysqli_query($dlink, $query);
										$result2 = mysqli_query($dlink, $query2);
										$result3 = mysqli_query($dlink, $query3);
										$result4 = mysqli_query($dlink, $query4);	
										if ($result) {
											// Fetch the result
											$row = mysqli_fetch_assoc($result);
											$row2 = mysqli_fetch_assoc($result2);
											$row3 = mysqli_fetch_assoc($result3);
											$row4 = mysqli_fetch_assoc($result4);
											$shit = $row['count'];
											$shit2 = $row2['count'];
											$shit3 = $row3['count'];
											$shit4 = $row4['count'];
										}							
							}	
							else{
										$query = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Pending' AND userid = '" . $_COOKIE['email'] . "';";
										$query2 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Accepted' AND userid = '" . $_COOKIE['email'] . "';";
										$query3 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Completed' AND userid = '" . $_COOKIE['email'] . "';";
										$query4 = "SELECT COUNT(*) AS count FROM purchase WHERE Status = 'Return/Refund' AND userid = '" . $_COOKIE['email'] . "';";

										$result = mysqli_query($dlink, $query);
										$result2 = mysqli_query($dlink, $query2);
										$result3 = mysqli_query($dlink, $query3);
										$result4 = mysqli_query($dlink, $query4);	
										if ($result) {
											// Fetch the result
											$row = mysqli_fetch_assoc($result);
											$row2 = mysqli_fetch_assoc($result2);
											$row3 = mysqli_fetch_assoc($result3);
											$row4 = mysqli_fetch_assoc($result4);
											$shit = $row['count'];
											$shit2 = $row2['count'];
											$shit3 = $row3['count'];
											$shit4 = $row4['count'];
										}										
							}	
								
										

									print('	<table style="width:100%">
										<tr style="color:black">');
										if($_REQUEST['sorted']){

											print('
												<th><a href="myorders.php?Pending=true&&sorted=true&&day='.$day.'&&month='.$month.'">Pending('.$shit.')</a></th>
												<th><a href="myorders.php?Accepted=true&&sorted=true&&day='.$day.'&&month='.$month.'">Accepted('.$shit2.')</a></th>
												<th><a href="myorders.php?Completed=true&&sorted=true&&day='.$day.'&&month='.$month.'">Completed('.$shit3.')</a></th>
												<th><a href="myorders.php?Return=true&&sorted=true&&day='.$day.'&&month='.$month.'">Return/Refund('.$shit4.')</a></th></tr>'
										);

											
										}else{

											print('<th><a href="myorders.php?Pending=true">Pending('.$shit.')</th>
											<th><a href="myorders.php?Accepted=true">Accepted('.$shit2.') </th>
											<th><a href="myorders.php?Completed=true">Completed('.$shit3.')</th>
											<th><a href="myorders.php?Return=true">Return/Refund('.$shit4.')</th></tr>');	
											


										}
							
																																							
										
										print('	
										<tr style="color:black">
																<th>Product</th>
																<th>Description</th>
																<th>Total </th>
																<th>Date Ordered</th>
																<th>Status</th>																										
										</tr>');
										
									
										if($_REQUEST['Pending'] == "true"){
											if ($_COOKIE["type"] == "Admin") {
												if($_REQUEST['sorted']){
													$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.date, purchase.status ,purchase.purchase_id
														FROM products
														INNER JOIN purchase ON products.prodid = purchase.prodid
														WHERE purchase.status = 'Pending' AND DATE(purchase.date) = '2023-$month-$day';";

												}else{

													$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status,purchase.purchase_id
														FROM products
														INNER JOIN purchase ON products.prodid = purchase.prodid
														WHERE purchase.status = 'Pending';";
												}
												$result2 = mysqli_query($dlink, $query);
												$total = 0;
												$selectedStatus = '';

												if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
													$selectedStatus = $_POST['status'];
													
													// Update the status of the selected item
													if (isset($_POST['purchase_id']) && is_array($_POST['purchase_id'])) {
														$purchaseIds = $_POST['purchase_id'];
												
														foreach ($purchaseIds as $purchaseId) {
															$query = "UPDATE purchase SET status = '$selectedStatus' WHERE status = 'Pending' AND purchase_id = '$purchaseId';";
															$result = mysqli_query($dlink, $query);															
														}
														header("Refresh: 0");	
													}
												}
												while ($row = mysqli_fetch_assoc($result2)) {
													$total += $row['total'];
												
													print('
														<tr style="color:black">
															<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>
															<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
															<th>'. $row['total'] .' </th>
															<th>'. $row['date'] .'</th>
															<th>
																<form method="post">
																	<input type="hidden" name="purchase_id[]" value="'. $row['purchase_id'] .'">
																	<select name="status" onchange="this.form.submit()">    
																		<option value="Pending" >Pending</option>      
																		<option value="Accepted">Accepted</option>
																		<option value="Completed" >Completed</option>
																		<option value="Return/Refund">Return/Refund</option>    
																	</select>
																</form>
															</th>
															<th>'.$selectedStatus.'</th>
														</tr>');
														
												}

											}else{
													$query = "SELECT products.productimage, products.productdesc, purchase.quantity,purchase.total, purchase.date, purchase.status
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.userid = '" . $_COOKIE['email'] . "' AND purchase.status = 'Pending';";
													$result2 = mysqli_query($dlink, $query);
													$total = 0;
													while ($row = mysqli_fetch_assoc($result2)) {
														$total+= $row['total'];
														printf('
															<tr style="color:black">
																					<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>					
																					<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
																					<th>'. $row['total'] .' </th>
																					<th>'. $row['date'] .'</th>
																					<th>'. $row['status'] .'</th>																										
															</tr>',$skincares[$rounds]["product"]);
														}
													}	
												
										}

										// Modify the column headers to display the row count
											else if($_REQUEST['Accepted'] == "true"){
												if ($_COOKIE["type"] == "Admin") {
													if($_REQUEST['sorted']){
														$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status ,purchase.purchase_id
															FROM products
															INNER JOIN purchase ON products.prodid = purchase.prodid
															WHERE purchase.status = 'Accepted' AND DATE(purchase.date) = '2023-$month-$day';";
											
												}
											else{
											
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status,purchase.purchase_id
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.status = 'Accepted';";
												}
													$result2 = mysqli_query($dlink, $query);
													$total = 0;
													$selectedStatus = '';
											
												if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
													$selectedStatus = $_POST['status'];
													
													// Update the status of the selected item
													if (isset($_POST['purchase_id']) && is_array($_POST['purchase_id'])) {
														$purchaseIds = $_POST['purchase_id'];
												
														foreach ($purchaseIds as $purchaseId) {
															$query = "UPDATE purchase SET status = '$selectedStatus' WHERE status = 'Accepted' AND purchase_id = '$purchaseId';";
															$result = mysqli_query($dlink, $query);															
														}
														header("Refresh: 0");	
													}
												}
												while ($row = mysqli_fetch_assoc($result2)) {
													$total += $row['total'];
												
													print('
														<tr style="color:black">
															<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>
															<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
															<th>'. $row['total'] .' </th>
															<th>'. $row['date'] .'</th>
															<th>
																<form method="post">
																	<input type="hidden" name="purchase_id[]" value="'. $row['purchase_id'] .'">
																	<select name="status" onchange="this.form.submit()">    
																		<option value="Accepted">Accepted</option>   
																		<option value="Pending" >Pending</option>                           
																		<option value="Completed" >Completed</option>
																		<option value="Return/Refund">Return/Refund</option>    
																	</select>
																</form>
															</th>
															<th>'.$selectedStatus.'</th>
														</tr>');
														
												}
												
											}else{
													$query = "SELECT products.productimage, products.productdesc, purchase.quantity,purchase.total, purchase.date, purchase.status
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.userid = '" . $_COOKIE['email'] . "' AND purchase.status = 'Accepted';";
													$result2 = mysqli_query($dlink, $query);
													$total = 0;
													while ($row = mysqli_fetch_assoc($result2)) {
														$total+= $row['total'];
														printf('
															<tr style="color:black">
																					<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>					
																					<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
																					<th>'. $row['total'] .' </th>
																					<th>'. $row['date'] .'</th>
																					<th>'. $row['status'] .'</th>																										
															</tr>',$skncares[$rounds]["product"]);
														}
													}	
										

										}
						
									else if($_REQUEST['Completed'] == "true"){
										if ($_COOKIE["type"] == "Admin") {
											if($_REQUEST['sorted']){
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status ,purchase.purchase_id
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.status = 'Completed' AND DATE(purchase.date) = '2023-$month-$day';";
										
											}else{
										
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status,purchase.purchase_id
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.status = 'Completed';";
											}
											$result2 = mysqli_query($dlink, $query);
											$total = 0;
											$selectedStatus = '';
										
											if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
												$selectedStatus = $_POST['status'];
												
												// Update the status of the selected item
												if (isset($_POST['purchase_id']) && is_array($_POST['purchase_id'])) {
													$purchaseIds = $_POST['purchase_id'];
											
													foreach ($purchaseIds as $purchaseId) {
														$query = "UPDATE purchase SET status = '$selectedStatus' WHERE status = 'Completed' AND purchase_id = '$purchaseId';";
														$result = mysqli_query($dlink, $query);															
													}
													header("Refresh: 0");	
												}
											}
											while ($row = mysqli_fetch_assoc($result2)) {
												$total += $row['total'];
											
												print('
													<tr style="color:black">
														<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>
														<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
														<th>'. $row['total'] .' </th>
														<th>'. $row['date'] .'</th>
														<th>
															<form method="post">
																<input type="hidden" name="purchase_id[]" value="'. $row['purchase_id'] .'">
																<select name="status" onchange="this.form.submit()">    
																	<option value="Completed" >Completed</option>
																	<option value="Pending" >Pending</option>  
																	<option value="Accepted">Accepted</option>                            
																	<option value="Return/Refund">Return/Refund</option>    
																</select>
															</form>
														</th>
														<th>'.$selectedStatus.'</th>
													</tr>');
													
											}
											
										}else{
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity,purchase.total, purchase.date, purchase.status
												FROM products
												INNER JOIN purchase ON products.prodid = purchase.prodid
												WHERE purchase.userid = '" . $_COOKIE['email'] . "' AND purchase.status = 'Completed';";
												$result2 = mysqli_query($dlink, $query);
												$total = 0;
												while ($row = mysqli_fetch_assoc($result2)) {
													$total+= $row['total'];
													printf('
														<tr style="color:black">
																				<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>					
																				<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
																				<th>'. $row['total'] .' </th>
																				<th>'. $row['date'] .'</th>
																				<th>'. $row['status'] .'</th>																										
														</tr>',$skincares[$rounds]["product"]);
													}
												}	
										
									
									}
									else if($_REQUEST['Return'] == "true"){
										if ($_COOKIE["type"] == "Admin") {
											if($_REQUEST['sorted']){
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status ,purchase.purchase_id
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.status = 'Return/Refund' AND DATE(purchase.date) = '2023-$month-$day';";
										
											}else{
										
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity, purchase.total, purchase.date, purchase.status,purchase.purchase_id
													FROM products
													INNER JOIN purchase ON products.prodid = purchase.prodid
													WHERE purchase.status = 'Return/Refund';";
											}
											$result2 = mysqli_query($dlink, $query);
											$total = 0;
											$selectedStatus = '';
										
											if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
												$selectedStatus = $_POST['status'];
												
												// Update the status of the selected item
												if (isset($_POST['purchase_id']) && is_array($_POST['purchase_id'])) {
													$purchaseIds = $_POST['purchase_id'];
											
													foreach ($purchaseIds as $purchaseId) {
														$query = "UPDATE purchase SET status = '$selectedStatus' WHERE status = 'Return/Refund' AND purchase_id = '$purchaseId';";
														$result = mysqli_query($dlink, $query);															
													}
													header("Refresh: 0");	
												}
											}
											while ($row = mysqli_fetch_assoc($result2)) {
												$total += $row['total'];
											
												print('
													<tr style="color:black">
														<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>
														<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
														<th>'. $row['total'] .' </th>
														<th>'. $row['date'] .'</th>
														<th>
															<form method="post">
																<input type="hidden" name="purchase_id[]" value="'. $row['purchase_id'] .'">
																<select name="status" onchange="this.form.submit()">    
																	
																	<option value="Return/Refund">Return/Refund</option> 
																	<option value="Pending" >Pending</option>  
																	<option value="Accepted">Accepted</option>                            
																	<option value="Completed" >Completed</option>
																</select>
															</form>
														</th>
														<th>'.$selectedStatus.'</th>
													</tr>');
													
											}
											
										}else{
												$query = "SELECT products.productimage, products.productdesc, purchase.quantity,purchase.total, purchase.date, purchase.status
												FROM products
												INNER JOIN purchase ON products.prodid = purchase.prodid
												WHERE purchase.userid = '" . $_COOKIE['email'] . "' AND purchase.status = 'Return/Refund';";
												$result2 = mysqli_query($dlink, $query);
												$total = 0;
												while ($row = mysqli_fetch_assoc($result2)) {
													$total+= $row['total'];
													printf('
														<tr style="color:black">
																				<th><img src="'. $row['productimage'] .'" width="80" height="80" alt="" class=""></th>					
																				<th>'. $row['productdesc'] .'<br>x'. $row['quantity'] .'</th>
																				<th>'. $row['total'] .' </th>
																				<th>'. $row['date'] .'</th>
																				<th>'. $row['status'] .'</th>																										
														</tr>',$skincares[$rounds]["product"]);
													}
												}
										
									
									}
										print('
										<tr style="color:black">
										<th></th>
										<th></th>
										<th>Total: '. $total .'</th>
										<th></th>
										<th></th>
										</tr>
										</table>');
										

																			
							mysqli_close($dlink);
					?>
                   

      <!--  contact -->
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Request a call back</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 offset-md-3">
                  <form id="request" class="main_form">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Full Name" type="type" name="Full Name"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email " type="type" name="Email "> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">                          
                        </div>
                        <div class="col-md-12">
                           <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message</textarea>
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn">Send</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
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