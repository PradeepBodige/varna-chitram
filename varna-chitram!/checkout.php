<style>
	body{
		background-image: url(images/1.jpg);
	}

</style>


<?php # Script 19.11 - checkout.php
// This page inserts the order information into the table.
// This page would come after the billing process.
// This page assumes that the billing process worked (the money has been taken).
// Set the page title and include the HTML header:
$page_title = 'Order Confirmation';
include ('html/nav.html');
echo '<div id="checkout">';
// Assume that the customer is logged in and that this page has access to the customer's ID:
$cid =  $_SESSION['customer_id'];
if($cid == 0 ){
	echo '<p style="color:white;">Please login to Continue</p>';
}
//$_GET['customer_id']; // Temporary.
// Assume that this page receives the order total:
$total = $_GET['total']; // Temporary.

$date=date('m/d/y');
//echo $date;
require ('mysqli_connect.php'); //Connect to the database.
// Turn autocommit off:
mysqli_autocommit($dbc, FALSE);
// Add the order to the orders table...
$q = "INSERT INTO order_info(customer_id,total,order_date) VALUES ($cid, $total,$date)";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {
// Need the order ID:
$oid = mysqli_insert_id($dbc);
// Insert the specific order contents into the database...
// Prepare the query:
$q = "INSERT INTO orders_content_info(order_id, print_id, quantity, price)VALUES (?, ?, ?, ?)";
$stmt=mysqli_prepare($dbc,$q);
mysqli_stmt_bind_param($stmt,'iiid',$oid,$pid,$qty,$price);
$affected=0;
foreach($_SESSION['cart'] as $pid => $item){
$qty=$item['quantity'];
$price=$item['price'];
mysqli_stmt_execute($stmt);
$affected +=mysqli_stmt_affected_rows($stmt);
}
mysqli_stmt_close($stmt);

if($affected == count($_SESSION['cart'])){

mysqli_commit($dbc);

unset($_SESSION['cart']);
unset($_SESSION['customer_id']);



echo '<p style="color:white;">Thank you for your order.You will be notified when the item ship.</p>';
}
else{

mysqli_rollback($dbc);

echo '<p style="color:white;">Your order could not be processed due to a system error.You Will be contacted in order to have the problem fixed.We apologize for the incovenience</p>';

}
} else { // Rollback and report the problem.
mysqli_rollback($dbc);
echo '<p style="color:white;">Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
// Send the order information to the administrator.
}
mysqli_close($dbc);
echo '</div>';
include ('html/foot.html');
?>
<style>
#checkout{
	position:absolute;
	top:120px;
	left:150px;
	width:70%;
	height:72%;
	border:1px solid;
	font-size:30px;
	
}
</style>