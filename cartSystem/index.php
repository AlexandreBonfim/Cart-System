<!DOCTYPE html>
<?php 
//first thing to do is start my session to carry the data.
session_start(); 
//connection com data base.
require_once "/includes/data_base.php";
?>

<html lang="en" class="no-js">

<head>

<!-- title and meta -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<meta name="description" content="A simple responsive navigation menu using HTML, CSS, and a bit of jQuery." />
<title>Gezz Supplier</title>
    
<!-- css -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/base.css" />
<link rel="stylesheet" href="css/style.css" />
    
<!-- js -->
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>


</head>

<?php
//Condition for a new user.
if(isset($_POST['newaccount'])){
	header("Location:form_add.php");	
}
	
//create variable to salt password.
$salt = '1%1cAu!g+>K53PY}';
	
//Condition for sign
if(isset($_POST['sign'])){
  $username = $_POST['username'];
  $password = $_POST['password'];  
  $password = md5($password . $salt);//hashing and salting password	.  	  

//selecting data from database and compare with variables from method post.
  $sql = $DBH->prepare("SELECT * FROM user WHERE user= :username and password= :password LIMIT 1");
  $sql ->bindValue(':username', $username);
  $sql ->bindValue(':password', $password);
  $sql ->execute();
	
  $row = $sql->fetch(PDO::FETCH_ASSOC);
	  
if(!empty($row)){
	$_SESSION['loggedin'] = true; //use for condition
	$_SESSION['username'] = $username; //create session username to carry that data
	$_SESSION['id']       = $row['Id'];//create session id to carry that data 
	$_SESSION['type']     = $row['Type'];//create session type of user to carry that data		
	
//method recaptcha
if(isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
}
	if(!$captcha){
    	session_destroy();
	  	echo "<script>alert('Check ReCAPTCHA');</script>";
		echo "<meta http-equiv='refresh'content='0, url=index.php'>";
        exit;
    }
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ldrew8UAAAAAMIN2LUQ3xgegh3h13ONIFayXSpR&response=".$captcha.				"&remoteip=".$_SERVER['REMOTE_ADDR']);
if($response.success==false){
   echo '<h2>You are spammer ! Get the @$%K out</h2>';  
}				

//Check empty text fileds
}elseif(empty($username)){
	echo  "<script>alert('fill up all fields.');history.back();</script>";	
}elseif(empty($password)){
	echo  "<script>alert('fill up all fields.');history.back();</script>";				 
}else {
	$_SESSION['loggedin'] = false;
}	  

//Condition for different types of user  		
if($row['Type'] == '1'){
	header("Location: home.php");
	die();
}elseif($row['Type'] == '2'){
	header("Location: admin.php");	
	die();
}elseif($row['Type'] == '3'){
	header("Location: staff_home.php");
	die();
}elseif($row['Type'] == '4'){
	header("Location: delivery.php");
	die();  
}}

?>

<body>

<div id="wrapper">


<header>
    <div id="title" class="container">
        <h1>Gezz Supplier</h1>
        <h2>Produtcs as good as heaven</h2>
    </div>
</header><!-- /header -->


<div id="main">
    <div class="container">


        <nav id="nav-mobile"></nav>

        <section>

        
<?php //Check if loggedin or not
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false):
	include('form_login.php');
else: 
 	header ("Location: home.php");  	
endif; 
?>
			

        </section>
    </div>
</div><!-- #main -->


<footer>

</footer><!-- /footer -->



</div><!-- /#wrapper -->


</body>
</html>