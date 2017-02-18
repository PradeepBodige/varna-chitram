<style>
	body{
		background-image: url(images/1.jpg);
	}
</style>

<?php # Script 19.9 - add_cart.php
// This page adds prints to the shopping cart.
// Set the page title and include theHTML 
header:$page_title = 'Add to Cart';
include ('html/nav.html');
echo '<div id="add_cart">';
if (isset ($_GET['pid']) && filter_var($_GET['pid'],FILTER_VALIDATE_INT,array('min_range' => 1)) ) { 
// Checkfor a print ID.
$pid = $_GET['pid'];

// Check if the cart already contains one of these prints;
// If so, increment the quantity:
if (isset($_SESSION['cart'][$pid])) {
$_SESSION['cart'][$pid]
['quantity']++; // Add another.
// Display a message:
$message = "Another copy of the print has been added to your shopping cart.";
echo "<script type='text/javascript'>alert('$message');
                                     </script> ";


} else { // New product to the cart.
// Get the print's price from the database:
require ('mysqli_connect.php');
// Connect to the database.
$q = "SELECT price FROM prints WHERE print_id=$pid";
$r = mysqli_query ($dbc, $q);
if (mysqli_num_rows($r) == 1) { //Valid print ID.
// Fetch the information.
list($price) = mysqli_fetch_array ($r, MYSQLI_NUM);
// Add to the cart:
$_SESSION['cart'][$pid] = array('quantity' => 1, 'price' => $price);
// Display a message:


$message = " print has been added to your shopping cart.";
echo "<script type='text/javascript'>alert('$message');
                                     document.location = 'browse_prints.php';</script> ";



} else { // Not a valid print ID.
echo '<div align="center">This page has been accessed in error!</div>';
}
mysqli_close($dbc);
} // End of isset($_SESSION['cart'][$pid] conditional.
} else { // No print ID.


$message = "Access to this page has been denied , Error message!";
echo "<script type='text/javascript'>alert('$message');
                                     </script> ";


}
echo '</div>';
include ('html/foot.html');
?>
<style>
#add_cart{
	position:absolute;
	left:150px;
	top:120px;
	border:1px solid;
	width:70%;
	height:60%;
	font-size:30px;
    color: white;
}
</style>