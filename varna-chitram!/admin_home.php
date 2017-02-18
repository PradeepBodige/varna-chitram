<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8" />
<title>Login</title>
 <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<meta content="width=device-width, initial-scale=1">

<style>

p{
  color: white;
}
.glyphicon {
    font-size: 150px;
}

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
</style>
	
<link href="bootstrap.min.css" rel="stylesheet">
<link href ="ie10-viewport-bug-workaround.css" rel="stylesheet">
<script src= "ie-emulation-modes-warning.js"></script>

</head>



<?php # Script 19.5 - admin_home.php
$page_title = 'picture perfect';
include ('html/admin_header.html');
?>
<style>
#content{
	position:absolute;
	left:150px;
	top:120px;
	border: 1px solid;
    width: 70%;
    height: 72%;
}
</style>
<div id="content">
<p>Welcome to Admin Portal</p>
<p>Welcome to Admin Portal</p>
<p>Welcome to Admin Portal</p></div>
<?php include ('html/foot.html'); ?>