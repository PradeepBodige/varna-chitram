

<link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<meta content="width=device-width, initial-scale=1">


<style>


body{
	background-image: url(images/1.jpg);
}

.checkout{
	background-color:#7fffd4;
	border:1px solid;
	border-radius: 10px;

}

.glyphicon{
	font-size: 300%;
}

.btnn{
background-color:#1589ff;
border:1px solid;
	border-radius: 10px;

}

}

.a-box{

width: 50%;
height: 50%;
left: 300px;
top: 10px;
position:absolute;
}

#view{
	width:70%;
	height:72%;
	border:1px solid;
	position:absolute;
	left:150px;
	top:120px;
	font-size:27px;
	color:white;

}
table{
	color:#9eb9d4;
}
</style>
<?php # Script 19.10 - view_cart.php
// This page displays the contents of the shopping cart.
// This page also lets the user update the contents of the cart.
// Set the page title and include the HTML header:
$page_title = 'View Your Shopping Cart';
include ('html/nav.html');
$total=0;
echo '<div id="view">';
// Check if the form has been submitted(to update the cart):
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
// Change any quantities:
foreach ($_POST['qty'] as $k => $v) {
// Must be integers!
$pid = (int) $k;
$qty = (int) $v;
if ( $qty == 0 ) { // Delete.
unset ($_SESSION['cart'][$pid]);
} elseif ( $qty > 0 ) { // Change quantity.
$_SESSION['cart'][$pid]
['quantity'] = $qty;
}
} // End of FOREACH.
} // End of SUBMITTED IF.
// Display the cart if it's not empty...
if (!empty($_SESSION['cart'])) {
// Retrieve all of the information for the prints in the cart:
require ('mysqli_connect.php'); // Connect to the database.
$q = "SELECT print_id,country, CONCAT_WS(' ', first_name, middle_name, last_name) AS artist, print_name
FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.print_id IN (";
foreach ($_SESSION['cart'] as $pid => $value) {
$q .= $pid . ',';
}
$q = substr($q, 0, -1) . ') ORDER BY artists.last_name ASC';
$r = mysqli_query ($dbc, $q);
// Create a form and a table:

echo '<form action="view_cart.php" method="post">
<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
<tr>
<td align="left" width="30%"><b>Artist</b></td>
<td align="left" width="30%"><b>Print Name</b></td>
<td align="left" width="30%"><b>country</b></td>
<td align="left" width="10%"><b>Price</b></td>
<td align="center" width="10%"><b>Qty</b></td>
<td align="right" width="20%"><b>Total Price</b></td>
</tr>';
// Print each item...
$sum = 0; // Total cost of the order.
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
// Calculate the total and sub-totals.
$subtotal = $_SESSION['cart'][$row['print_id']]['quantity'] * $_SESSION['cart'][$row['print_id']]['price'];
$total += $subtotal;
// Print the row:
echo "\t<tr>
<td align=\"left\">{$row['artist']}</td>
<td align=\"left\">{$row['print_name']}</td>
<td align=\"left\">{$row['country']}</td>
<td align=\"left\">\${$_SESSION['cart'][$row['print_id']]['price']}</td>
<td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['print_id']}]\"
value=\"{$_SESSION['cart'][$row['print_id']]['quantity']}\" /></td>
<td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
</tr>\n";
} // End of the WHILE loop.
mysqli_close($dbc); // Close the database connection.
// Print the total, close the table, and the form:
echo '<tr>
<td colspan="5" align="right"><b>Total:</b></td>
<td align="right">$' . number_format ($total, 2) . '</td>
</tr>
</table>';
$sum=$total;


 echo '<div align="center"><input class="btnn" type="submit" name="submit" value="Update My Cart" /></div>
</form><p align="center">Enter a quantity of 0 to remove an item.
<br /><br />';
echo "<button class='checkout'><a href=\"checkout.php?total=$sum\">Checkout</a></button>";
} else {
echo '<div class="a-box"><span class="glyphicon glyphicon-shopping-cart"><p>Your cart is currently empty.</p></div>';
}
echo "</div>";
include ('html/foot.html');
?>