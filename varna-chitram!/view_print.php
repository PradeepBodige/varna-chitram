 <?php # Script 19.6 - browse_prints.php
// This page displays the available prints (products).
// Set the page title and include the HTML header:
$page_title = 'view items';


?>
 <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<meta content="width=device-width, initial-scale=1">

<style>
.glyphicon {
    font-size: 150px;
}

.col-md-12{
  align-content: center;
}
body{
  background-image:url(images/1.jpg);
  color: white;
}
h1{
  color:white;
}
h5{
  color: #ffd700;
}

.a-box{
border: 1px;
border-radius: 1px;
padding: 20px;
box-sizing: 100%;
color: white;
}
@media (min-width: 900px) {
.a-box {
width:50%;
}
}

#submit{
  color: white;
  background:no-repeat;
  width: 100%;
  text-align: center;
  border-color: #1e69b5;
  padding: 2%;
}
.checkbox{
  padding-left: 12px;
}

.btn{
 background:no-repeat;
  width: 100%;
  text-align: center;
  border-color: #1e69b5;
}

.container{
  padding:5%;
  padding-bottom: 10%;

}

#view{
	width:70%;
	height:72%;
	border:1px solid;
	position:absolute;
	left:150px;
    
	top:120px;
}

#main{
	    position: absolute;
    left: 150px;
    top: 120px;
    border: 1px solid;
    width: 70%;
    height: 72%;
   
}
</style>
	
<link href="bootstrap.min.css" rel="stylesheet">
<link href ="ie10-viewport-bug-workaround.css" rel="stylesheet">
<script src= "ie-emulation-modes-warning.js"></script>




<?php
$row=false;

//$ex=$GET['pid'];
//$_GET['pid']=1;
//echo $ex;
if(isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ){
	
	//Make sure there is print ID
	
	$pid=$_GET['pid'];
	
	//get the print information

	require ('mysqli_connect.php');
	
	//connect to the database
	
	$q="SELECT CONCAT_WS('',first_name,middle_name,last_name) AS artist,print_name,price,description,size,image_name from artists a,prints p where a.artist_id=p.artist_id and p.print_id=$pid";
	
	$r=mysqli_query($dbc,$q);
	
	if(mysqli_num_rows($r) == 1){
		
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		
		$page_title=$row['print_name'];
		
		include('html/nav.html');
		echo "<div style='color:white;' id=\"main\">";
		echo "<div align=\"center\"><b>{$row['print_name']}</b> by {$row['artist']}</br>";
		
		echo (is_null($row['size'])) ? '(No size information available)' :$row['size'];
		
	//echo "<br/>\${$row['price']}" 
	echo "<a href=\"add_cart.php?pid=$pid\">Add to Cart</a></div><br />";
	
// Get the image information and display the image:
if ($image = @getimagesize ("uploads/$pid")) {
	
echo "<div style='width:auto; height:auto;' id =\"img\" align=\"center\"><img src=\"show_image.php?image=$pid&name=" . urlencode
($row['image_name']) . "\" $image[3] alt=\"{$row['print_name']}\" /></div>\n";
} else {
echo "<div align=\"center\">No image available.</div>\n";
}
// Add the description or a default message:
echo '<p align="center">' . ((is_null($row['description'])) ? '(No description available)' :
$row['description']) . '</p>';
echo "</div>";
} // End of the mysqli_num_rows( ) IF.
mysqli_close($dbc);
} // End of $_GET['pid'] IF.
if (!$row) { // Show an error message.
$page_title = 'Error';
include ('html/nav.html');


$message = "Access to this page has been denied , Error message!";
echo "<script type='text/javascript'>alert('$message');
                                     document.location = 'checkout.php';</script> ";


/*echo '<div style="font-size: 40px;font-family:arial;position:absolute;left:100px;
top:136px; color:white;" align="center">This page has been accessed in error!</div>';*/
}
// Complete the page:
include ('html/foot.html');

?>
<style>
#img{
	width:500px;
	height:500px;
	background-size:contain;
}
</style>