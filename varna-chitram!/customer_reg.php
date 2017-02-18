<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Registration</title>


 <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<meta content="width=device-width, initial-scale=1">

<style>

.col-md-12{
  align-content: center;
}
body{
  background-image:url(images/1.jpg);

}
h1{
  color:white;
}
h5{
  color: #ffd700;
}

.a-box{
border: 1px solid #1e69b5;
border-radius: 1px;
padding: 15px;
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


</style>
<link href="bootstrap.min.css" rel="stylesheet">
<link href ="ie10-viewport-bug-workaround.css" rel="stylesheet">
<script src= "ie-emulation-modes-warning.js"></script>
</head>
<body class="container">

<div>
<?php # Script 19.1 - customer_reg.php
// This page allows the administrator to add an artist.

?>
<?php
if ($_SERVER['REQUEST_METHOD'] =='POST')
{ // Handle the form.

// Validate the first and middle names (neither required):
if (!empty($_POST['email']) && !empty($_POST['pass'])) {
$em = trim($_POST['email']);
$ps= trim($_POST['pass']);
// Check for a last_name...

// Add the artist to the database:
require ('mysqli_connect.php');
$q = 'INSERT INTO customer_info (email,pass)VALUES (?, ?)';
$stmt = mysqli_prepare($dbc, $q);
mysqli_stmt_bind_param($stmt,
'ss', $em, $ps);
mysqli_stmt_execute($stmt);
// Check the results....
if (mysqli_stmt_affected_rows($stmt) == 1) {









$message = "You have sucessfully Signed Up.";
echo "<script type='text/javascript'>alert('$message');
                                     document.location = 'index.php';</script> ";
$_POST = array( );
} else { // Error!
$error = 'Please enter the correct details!';
}
// Close this prepared statement:
mysqli_stmt_close($stmt);
mysqli_close($dbc); // Close the database connection.
} 
else { // Error!
$error = 'Please enter the correct details!';
}
}
// End of the submission IF.
// Check for an error and print it:
if (isset($error)) {



echo '<div class="col-md-push-4 col-md-8"><div class="a-box">
              <span style="color:red;" class="glyphicon glyphicon-warning-sign">             
             
' . $error . '</span></div></div><br><br>';




}
// Display the form...

?>


<div class="col-md-push-4 col-md-8">

<form action="customer_reg.php" method="post" class="a-box">
<div class="form-group">
             <h1>Sign Up.</h1>
            </div>
        
         <div class="form-group">
             <hr />
            </div> 

    <div class="form-group">
             <div class="alert alert-danger">
              <span class="glyphicon glyphicon-info-sign"></span>             
             </div>
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input style="width:100%" type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" />
                </div>
                <br>
             <div class="input-group">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-envelope"></span>
                </span>    
              
                <input style="width: 100%" type="text" name="email" class="form-control" placeholder="Your Email" size="20" maxlength="30" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />  
             </div>
            <br>
             <div class="input-group">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-lock"></span>
                </span>

             <input style="width: 100%" type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="20" size="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>" />
             </div>
             <br>
 			<div>
            <input style="width: 100%" class="btn btn-block btn-primary" type="submit" name="submit"  value="submit" />
            </div>
            <br>
            <div class="form-group">
             <a style="padding: 3%;" href="login.php">Sign in Here...</a>
            </div>
        

	        </div>


	   
</form>
<br>
<br>
<br><br>

</div>

<hr style="width: 100%">
<footer>
        <p  class="pull-right"><a href="#">Back to top</a></p>
        <p style="color: white;">&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
 </footer>

<!--========================================================================================================================-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
<!--========================================================================================================================-->

</div>

</body>


</html>
