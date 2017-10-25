<!DOCTYPE html>
<?php
	session_start();	
	require_once ("/includes/data_base.php");
?>
<html lang="en" class="no-js">

<head>
 
<!-- title and meta -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Gezz Supplier</title>
    
<!-- css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

<body>

<div id="wrapper">

<!-- header -->
<header>
    <div id="title" class="container">
        <h1>Gezz Supplier</h1>
        <h2>Produtcs as good as heaven</h2>
    </div>
</header>

<!-- Menu -->
<div id="main">
    <div class="container">
        <div id="nav-trigger">
            <span>Menu</span>
        </div>

        <nav id="nav-mobile"></nav>
<!-- Form -->
<section>
<div class="container text-left ">
  <form class="form-horizontal" action="?go=save" method="POST">
    <div class="form-group">
	 <div class="col-sm-4">
      <label>Name:</label>
      <input type="text" class="form-control" id="name" name="name">
	 </div>
    </div>
    <div class="form-group">
	 <div class="col-sm-4">
      <label>Surname:</label>
      <input type="text" class="form-control" id="sname" name="sname">
	 </div>
    </div>
    <div class="form-group">
	 <div class="col-sm-4">
      <label>DOB:</label>
      <input type="date" class="form-control" id="dob" name="dob">
	 </div>
    </div>
    <div class="form-group">
	 <div class="col-sm-4">
      <label>Email:</label>
      <input type="text" class="form-control" id="email" name="email">
	 </div>
    </div>
    <div class="form-group">
	 <div class="col-sm-4">
      <label>User:</label>
      <input type="text" class="form-control" id="user" name="user">
	 </div>
    </div>
    <div class="form-group">
	 <div class="col-sm-4">
      <label>Password:</label>
      <input type="password" class="form-control" id="pass" name="pass">
	 </div>
    </div>
     <div class="form-group">
	  <div class="col-sm-4">
        <label>Address</label>
	    <input type="text" class="form-control" id="address" name="address">
	  </div>
     </div>
     <div class="form-group">
	  <div class="col-sm-4">
        <label>Phone</label>
	    <input type="text" class="form-control" id="phone" name="phone">
	  </div>
     </div>
     <div class="form-group">
      <div class="col-sm-offset-1 col-sm-8">
        <button type="submit" name="submit" class="btn btn-default">Save</button>
 		<button type="reset" name="submit" class="btn btn-default">Reset</button>
      </div>
     </div>
  </div>   
</section>
    </div>
</div>

<?php
	
	$salt = '1%1cAu!g+>K53PY}';
		
	if(@$_GET['go'] == 'save'){
			$name = $_POST['name'];
			$sname = $_POST['sname'];
			$dob = $_POST['dob'];
			$email= $_POST['email'];
			$user = $_POST['user'];	  	
			$pass = $_POST['pass'];
			$pass = md5($pass . $salt);	
			$address= $_POST['address'];
			$phone = $_POST['phone'];
	
	if(empty($email)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";		
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      		echo  "<script>alert('fill up with a right email.');history.back();</script>";		
	}elseif(empty($name)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($sname)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($dob)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($user)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($pass)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($address)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($phone)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}else{
		$query = $DBH->prepare("SELECT * FROM user WHERE user = '$user'"); //check if the user exist on database
		$query->execute();
		$check = $query->fetch(PDO::FETCH_ASSOC);
		if ($check > 0){
			echo "<script>alert('user already exist.');history.back();</script>";
		}else{
			$query1 = "INSERT INTO user(f_name, s_name, dob, email, user, password, address, phone) VALUES ('$name','$sname','$dob','$email','$user','$pass','$address','$phone');";			//Inserte new acc on database
			$sth = $DBH->prepare($query1);
				$sth->bindParam(1, $name, PDO::PARAM_STR);
				$sth->bindParam(2, $sname, PDO::PARAM_STR);
				$sth->bindParam(3, $dob, PDO::PARAM_STR);
				$sth->bindParam(4, $email, PDO::PARAM_STR);
				$sth->bindParam(5, $user, PDO::PARAM_STR);
				$sth->bindParam(6, $pass, PDO::PARAM_STR);
	 			$sth->bindParam(7, $address, PDO::PARAM_STR);																			
				$sth->bindParam(8, $phone, PDO::PARAM_STR); 

			$sth->execute();
			echo "<script>alert('register sucessul.');</script>";
			echo "<meta http-equiv='refresh'content='0, url=index.php'>";
		}
	  }
	}
											
?>

</div>

<footer>
</footer>


</body>
</html>


