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
      <?php 
          if ($_COOKIE['email'] == ""){
					print('<li><a href="index.php?login=true&#login">Login</a></li>
					<li><a href="index.php?register=true&#register">Register</a></li>');
					}
					else{
                 
						
                 
						print "<li><a style='color:black' href=index.php?logout=true>Logout</a></li>";
						print "<h5 style='color:#eb5d1e'>  Welcome " . $_COOKIE['type'];
						print "  " .$_COOKIE['email'];
					}?>
          <?php
                            $hostname="localhost";
                            $database="shopee";
                            $db_login="root";
                            $db_pass="";

                            $dlink = mysqli_connect($hostname, $db_login, $db_pass) or die("Could not connect");
                            mysqli_select_db($dlink,$database) or die("Could not select database");


                            //Register
                            if($_REQUEST['uname'] !=""){
                              $query="select * from user where email='".$_REQUEST['email']."'";
                              $query1="select * from user";	
                              $result = mysqli_query($dlink,$query) or die(mysqli_error($dlink));
                              $result1 = mysqli_query($dlink,$query1) or die(mysqli_error($dlink));
                              $num_results = mysqli_num_rows($result);
                              $num_results1 = mysqli_num_rows($result1);
                              $usertype="Admin";
                              
                              if($num_results1 > 0){
                                
                                $usertype="Customer";
                              }
              
                              if($num_results == 0){
                                $query="insert into user(custname,address,email,paswrd,contact,usertype) values('".$_REQUEST['uname']."','".$_REQUEST['address']."','".$_REQUEST['email']."','".$_REQUEST['paswrd']."','".$_REQUEST['contact']."','".$usertype."')";
                                $result = mysqli_query($dlink,$query) or die(mysqli_error($dlink));
                                echo "<meta http-equiv='refresh' content='0;url=index.php?login=true&#login'>";
                              }else{
                                $alreadyauser = "true";	
                              }	
              
                            }


                            //Login
                            if($_REQUEST['loginuser'] == "true"){
                              $query = "select * from user where email='" .$_REQUEST['email']."'&& paswrd='".$_REQUEST['paswrd']."'";
                              $result = mysqli_query($dlink,$query) or die(mysqli_error($dlink));
                              $num_results = mysqli_num_rows($result);
                              $row = mysqli_fetch_array($result);
                              if ($num_results==0)  {  
                                echo "<meta http-equiv='refresh' content='0;url=index.php?registered=false&login=true&#login'>";
              
                              }
                              else{
                                setcookie("email" , $row['email'],time()+3600);
                                setcookie("type" , 	$row["usertype"],time()+3600);
                                echo "<meta http-equiv='refresh' content='0;url=index.php?registered=true'>";
                              }	
                              
                              
              
                              mysqli_close($dlink);
                            }	
                                

                            //If account is already registered
                            if($_REQUEST['register'] == "true"|| $alreadyauser == "true"){
                                if($alreadyauser == "true")print("<h4 style='color:red' >Already Registered</h4>");
            
                                //Register form
                               print('<form style="color:black" action=index.php?#register method=post >
                                <h2 id = "register">Registraion form</h2>
                                    Enter Name<input type=text name=uname><br>
                                    Enter Email<input type=text name=email><br>
                                    <input type=hidden name=register value="true" >
                                    Enter Password<input type=text name=paswrd><br>
                                    Enter Contact<input type=text name=contact><br> 
                                    Enter Adress<input type=text name=address><br>  
                                <input type=submit value=submit>
                                </form>)');
                            }
                            
                            //If username of password is invalid
                            else if($_REQUEST['login'] == "true"){
                                 if($_REQUEST['registered']  == "false")print("<h4 style='color:red'>Invalid Username or Password</h4>");

                              //Login form
                               print('<form style="color:black" action=index.php method=post>
                               <h2 id = "login">Login</h2>
                               Enter Email<input type=text name=email ><br>
                               <input type= "hidden" name = loginuser value= "true" >
                               Enter Password<input type=text name=paswrd><br>
                               <input type=Submit value=submit>
                               </form>');

                            }
                            
                            //Logout
                            else if($_REQUEST['logout'] == "true"){
                              echo "<meta http-equiv='refresh' content='0;url=index.php'>";
                              setcookie('email',"",time()-1);  
                              setcookie('type',"",time()-1);
                            }
                        ?>
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

      <div class="">
      <?php	

if ($_COOKIE['type'] == "Admin"){
  $hostname="localhost";
  $database="Shopee";
  $db_login="root";
  $db_pass="";
  
    // setcookie("email","",time()+3600);  
    // setcookie("type","",time()+3600);

  $dlink = mysqli_connect($hostname, $db_login, $db_pass) or die("Could not connect");
  mysqli_select_db($dlink,$database) or die("Could not select database");


  // Get the current year and month
  $year = date('Y');
  $month = date('m');

  // Get the number of days in the current month
  $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

  // Get the name of the current month, F in format('F') means the full name of the month
  $date = new DateTime("$year-$month-01");
  $month_name = $date->format('F');

  // Get the index of the first day of the month (0 = Sunday, 1 = Monday, etc.)
  //The first argument, 'w', specifies that we want to retrieve the day of the week as a numeric value (0 for Sunday, 1 for Monday, and so on).
  //strtotime function creates a timestamp representing the first day of the given month and year.
  $first_day_index = (int) date('w', strtotime("$year-$month-01"));

  // Start the table and print the month name
  echo "<table width=100% border=2 style='background-color:white;' ><caption style='background-color:black;'>$month_name $year</caption>";

  // Print the table headers (days of the week)
  print "<tr>";
  echo "<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th>";
  echo "<th>Thu</th><th>Fri</th><th>Sat</th>";
  echo "</tr>";

  // Start a new row for the first week
  echo "<tr>";

  // Print blank cells for the days before the first day of the month
  for ($i = 0; $i < $first_day_index; $i++) {
    echo "<td></td>";
  }

  // Print the cells for the days of the month
  for ($day = 1; $day <= $num_days; $day++) {
    // Start a new row at the beginning of each week
    if ($day > 1 && ($day - 1 + $first_day_index) % 7 == 0) {
      echo "</tr><tr>";
    }
    $query2 = "SELECT COUNT(*) AS count FROM Purchase WHERE DATE_FORMAT(date, '%d') = ".$day." && DATE_FORMAT(date, '%m') = ".$month;
    $result2 = mysqli_query($dlink,$query2) or die(mysqli_error($dlink));
    $row2 = mysqli_fetch_array($result2);

    if($row2['count'] > 0)
      echo "<td align=center><a href='myorders.php?Pending=true&&sorted=true&&day=".$day."&&month=".$month."'> $day (".$row2['count'].")</a></td>";

    else
      echo "<td align=center>$day</td>";
    }
                  

  // Print blank cells for the days after the last day of the month
  for ($i = $num_days + $first_day_index; $i < 35; $i++) {
    echo "<td></td>";
  }

  // End the last row and the table
  echo "</tr></table>";

}
?>
                  </div>
                   
      <!-- end our protien  -->
      <!-- about -->
      <div id="about" class="about">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="titlepage">
                     <h2>About Us</h2>
                     <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or</p>
                     <a class="read_more" href="Javascript:void(0)"> Read More</a>
                  </div>
               </div>
               <div class="col-md-6 pad_right0">
                  <div class="about_img ">
                     <figure><img src="images/about.png" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end about -->
      <!-- growyhing -->
      <div class="growyhing">
         <div class="container">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="body_img">
                     <figure><img src="images/body.png" align="#"/></figure>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="titlepage">
                     <h2>Growyhing Your Body From Protien</h2>
                     <a class="read_more" href="Javascript:void(0)"> Read More</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end growyhing -->
      <!-- testimonial -->
      <div id="testimonial" class="testimonial">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Testimonial</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-5">
                  <div class="body_blu_img">
                     <figure><img src="images/tesr.png" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-md-7 pad_right0">
                  <div class="testimo_ban_bg">
                     <div id="testimo" class="carousel slide testimo_ban" data-ride="carousel">
                        <ol class="carousel-indicators">
                           <li data-target="#testimo" data-slide-to="0" class="active"></li>
                           <li data-target="#testimo" data-slide-to="1"></li>
                           <li data-target="#testimo" data-slide-to="2"></li>
                        </ol>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end testimonial -->
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