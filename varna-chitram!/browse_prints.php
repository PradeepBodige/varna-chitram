



<?php # Script 19.6 - browse_prints.php
// This page displays the available prints (products).
// Set the page title and include the HTML header:
$page_title = 'Browse the Prints';

include('html/nav.html');


require ('mysqli_connect.php');
// Default query for this page:
$q = "SELECT artists.artist_id, CONCAT_WS(' ', first_name, middle_name, last_name) AS artist,
print_name, price, description, print_id FROM artists, prints WHERE artists.artist_id = prints.
artist_id ORDER BY artists.last_name ASC, prints.print_name ASC";
// Are we looking at a particular artist?
if (isset($_GET['aid']) && filter_var($_GET['aid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
 // Overwrite the query:
$q = "SELECT artists.artist_id, CONCAT_WS(' ', first_name, middle_name, last_name) AS
artist, print_name, price, description, print_id FROM artists, prints WHERE artists.artist_
id=prints.artist_id AND prints.artist_id={$_GET['aid']} ORDER BY prints.print_name";
}
// Create the table head:
echo '<body style=" background-image:url(images/1.jpg);">';
echo '<?php echo $login_session ?><div><h1 align="center" style="color:#f0ffff;">Welcome</h1></div>';  
echo '<div id="browse_print" style="color:white;"><br><br>';
echo '<table border="0" width="70%" cellspacing="3" cellpadding="3" align="center" style="color:white;">
<tr>
<td align="left" width="20%"><b>Items</b></td>
<td align="left" width="20%"><b>Item Name</b></td>
<td align="left" width="40%"><b>Description</b></td>
<td align="left" width="20%"><b>Price</b></td>
</tr>';
// Display all the prints, linked to URLs:
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
// Display each record:
echo "\t<tr>
<td align=\"left\"><a href=\"browse_prints.php?aid={$row['artist_id']}\">{$row['artist']}
</a></td>
<td align=\"left\"><a href=\"view_print.php?pid={$row['print_id']}\">{$row['print_name']}</td>
<td align=\"left\">{$row['description']}</td>
<td align=\"left\">\${$row['price']}</td>
</tr>\n";
} // End of while loop.
echo '</table>';

echo '</div>';
echo '</body>';
mysqli_close($dbc);
include('html/foot.html');
?>
<style>
#browse_print{
	position:absolute;
	top:120px;
	left:150px;
	border: 1px solid;
    width: 70%;
    height: 72%;
}
</style>
