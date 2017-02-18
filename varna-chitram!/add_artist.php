<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Add an Item</title>
<style type="text/css">
body{
  background-image:url(images/1.jpg);

}
h5{
  color: #1e69b5;
}

form{
	color:#1e69b5;
}

.a-box{
border: 1px solid #1e69b5;
border-radius: 1px;
padding: 12px;
box-sizing

}
@media (min-width: 900px) {
.a-box {
width: 75%;
}
}

.button {
    background-color: solid #4CAF50; /* Green */
    fill: currentColor;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
.checkbox{
  padding-left: 12px;
}




.container{
  padding: 12px;

}
#create{
  width: 100%;
  background:no-repeat;
  color: white;
  text-align: center;
  padding: 6px;
  border-color: #1e69b5;
}

</style>


</head>
<body>

<?php # Script 19.1 - add_artist.php
// This page allows the administrator to add an item.
include ('html/admin_header.html');
?>
<div id="artist_main">
<?php
if ($_SERVER['REQUEST_METHOD'] =='POST')
{ // Handle the form.

// Validate the name and praduct number (neither required):
$fn = (!empty($_POST['first_name'])) ?
trim($_POST['first_name']) : NULL;
$mn = (!empty($_POST['middle_name'])) ?
trim($_POST['middle_name']) : NULL;
// Check for a category...
if (!empty($_POST['last_name'])) {
$ln = trim($_POST['last_name']);
// Add the Item to the database:
require ('mysqli_connect.php');
$q = 'INSERT INTO artists (first_name, middle_name, last_name)VALUES (?, ?, ?)';
$stmt = mysqli_prepare($dbc, $q);
mysqli_stmt_bind_param($stmt,
'sss', $fn, $mn, $ln);
mysqli_stmt_execute($stmt);
// Check the results....
if (mysqli_stmt_affected_rows($stmt) == 1) {
echo '<p style="color:white;">The Item has been added.</p>';
$_POST = array( );
} else { // Error!
$error = 'The new Item could not be added to the database!';
}
// Close this prepared statement:
mysqli_stmt_close($stmt);
mysqli_close($dbc); // Close the database connection.
} else { // No last name value.
$error = 'Please enter the Item\'s name!';
}
} // End of the submission IF.
// Check for an error and print it:
if (isset($error)) {
echo '<h1>Error!</h1>
<p style="font-weight: bold; color: #C00">' . $error . ' Please try again.</p>';
}
// Display the form...

?>
<h1 style="color: white;">Add an Artist</h1>
<form class="a-box" action="add_artist.php" method="post">
<fieldset><legend style="color: white;" >Fill out the form to add an Item:</legend>
<p><b> FirstName</b> <input style="width:100%;" type="text" name="first_name" size="10" maxlength="20"
value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
<p><b>Middle name</b> <input style="width:100%;" type="text" name="middle_name" size="10" maxlength="20"
value="<?php if (isset($_POST['middle_name'])) echo $_POST['middle_name']; ?>" /></p>
<p><b>Last name</b> <input style="width:100%;" type="text" name="last_name" size="10" maxlength="40" value="<?php
if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
</fieldset>
<div align="center"><input id ="submit" type="submit" name="submit" value="Submit" class="button" /></div>
</div>
</form>
<style>
#artist_main{
	
	width:70%;
	overflow:hidden;
	height:72%;
	border:1px solid;
	    position: absolute;
    top: 120px;
    left: 150px;
}
</style>
</body>
</html>
<?php include ('html/foot.html'); ?>