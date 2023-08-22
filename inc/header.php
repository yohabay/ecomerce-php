<?php
ob_start(); // Add this line at the beginning of the file

include 'lib/Session.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Formate.php';
spl_autoload_register(function($class){
include_once "classess/".$class.".php";
});

$db = new Database();
$fm = new Format();
$pd = new Product();
$cat = new Category();
$ct = new Cart();
$cmr = new Customer();

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: max-age=2592000");
?>



<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title> online shopping</title>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<!-- <link href="css/newstyle.css" rel="stylesheet" type="text/css" media="all"/> -->
<link rel="stylesheet" href="css/styles.css">
<!-- <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/> -->
<link href="css/tougles.css" rel="stylesheet" type="text/css" media="all"/>
<!-- <script src="js/jquerymain.js"></script> -->
<!-- <script src="js/script.js" type="text/javascript"></script> -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<!-- <script type="text/javascript" src="js/nav.js"></script> -->
<!-- <script type="text/javascript" src="js/move-top.js"></script> -->
<!-- <script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script> -->
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>

<style>
	.login {
  background-color: blue; 
border-radius:5px;
border-color:transparent;
}
	.header_top{
		background:black;
		height:4vh;

	}
	.header_top_right{
		display:flex;
		align-items:center;
		justify-content:center;
		width:100%;
		margin-top:-8px;
		
	}
.logo img{
	padding-left:20px;
	width:52px;

}
.logo a{
	color:white;
 display:flex;
}
.logo a h1{
	padding-top:10px;
}
.login{
	background: orange;
	margin-right:20px;
}
.sticky {
  position: fixed;
  top: 0;
  width: 85%;
  z-index: 10000;

}
.menu{
	background:black;
}

.sticky + .content {
  padding-top: 102px;
  

}
.dropdown-content {
  display: none;

}

.dropdown:hover .dropdown-content {
  display: block;
   position: absolute;
   left:18%;
   color:black;
   top:19%;
   background-color: #d6214b;
   z-index: 200;
}
.dropdown:hover .dropdown-content li a{
 font-size:16px;
 text-transform: capitalize;
 
}
.dropdown:hover .dropdown-content li a:hover{
	padding:10px 34px;
}
.wrap {
    width: 85%;
    margin: 0 auto;
    padding: 0 1%;
    background: #fff;
}
.search_box input[type='submit'] {
    border: none;
    cursor: pointer;
    color: #fff;
    font-size: 12px;
    padding: 10px 15px;
    height: 36px;
    margin: 0;
    background: orange;
    background: -moz-linear-gradient(top, #f58220, #206ef5);
    background: -o-linear-gradient(top, #203cf5, #f58220);
    background: -ms-linear-gradient(top, #f58220, #0960eb);
    -webkit-transition: all 0.9s;
    -moz-transition: all 0.9s;
    -o-transition: all 0.9s;
    -ms-transition: all 0.9s;
    transition: all 0.9s;
    position: absolute;
    right: 0;
    top: 0;
}
</style>



</head>
<body>
  <div class="wrap">
		<div class="header_top">
			
			  <div class="header_top_right">
			  <div class="logo">
				<a href="index.php"><img src="admin\img\logo1.png" alt=""/><h1>ONLINE STORE</h1></a>
			</div>
			    <div class="search_box">
				    <form action="search.php" method="get">
				    	<input type="text" value="Search for Products" name="search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}">
				    	<input type="submit" name="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">

									<?php 
							$getData = $ct->checkCartTable();
							if ($getData) {
								$sum = Session::get("sum");
								$qty = Session::get("qty");
								echo "$". $sum." qty: ".$qty;
							}else{
								echo "(Empty)";
							}
									
									 ?>
								</span>
							</a>
						</div>
			      </div>
			<?php 
			if (isset($_GET['cid'])) {
			$cmrId = Session::get("cmrId");
			$delData = $ct->delCustomerCart();
			$delComp = $pd->delCompareData($cmrId);
			Session::destroy();
			}


			?>

		   <div class="login">

				<?php 
				$login = Session::get("cuslogin");
				if ($login == false) {  ?>
						<a href="login.php">Login</a>
				<?php }else{ ?>
				<a href="?cid=<?php Session::get('cmrId') ?>">Logout</a>
				<?php }
				?>

		   	

		   </div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>



			<div class="menu" id="myHeader">
				<ul id="dc_mega-menu-orange" style="text-transform: uppercase;" class="dc_mm-orange">
				<div class="topnav" id="myTopnav">
				<a href="index.php">Home</a>
		<li class="dropdown">
        <a href="topbrands.php" class="dropbtn" onclick="toggleDropdown()">Top Brands</a>
        <div class="dropdown-content" id="dropdownMenu">
          <div class="dropdown-menu">
            <ul>
              <li><a href="fashion.php">Fashion</a></li>
              <li><a href="shoes.php">Shoes</a></li>
              <li><a href="electronics.php">Electronics</a></li>
              <li><a href="beauty.php">Beauty</a></li>
            </ul>
          </div>
        </div>
      </li>
			<?php 
			$chkCart = $ct->checkCartTable();
			if ($chkCart) { ?>
			<a href="cart.php">Cart</a>
			<a href="payment.php">Payment</a>
			<?php } ?>

			<?php 
			$cmrId = Session::get("cmrId");
			$chkOrder = $ct->checkOrder($cmrId);
			if ($chkOrder) { ?>
			<a href="orderdetails.php">Order</a>
			<?php } ?>

			
				<?php 
				$login = Session::get("cuslogin");
				if ($login == true) { ?>
				<a href="profile.php">Profile</a> 
				<?php } ?>
			

				<?php 
				$getPd = $pd->getCompareData($cmrId);
				if ($getPd) {
					?>
			<a href="compare.php">Compare</a> 
			<?php } ?>

			<?php 
				$chekwlist = $pd->checkWlistData($cmrId);
				if ($chekwlist) {
					?>
			<a href="wishlist.php">Wishlist</a> 
			<?php } ?>
			<a href="contact.php">Contact</a>
				<a href="javascript:void(0);" class="icon" onclick="myFunction1()">
			<i class="fa fa-bars"></i>
		 </a>
	    </div>
			<div class="clear"></div>
			</ul>
</div>

<script>
window.onscroll = function() {myFunction()};

var header= document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
function toggleDropdown() {
  var dropdown = document.getElementById("dropdownMenu");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

</script>
<script type="text/javascript" src="js/toggle.js"></script>


