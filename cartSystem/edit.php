<?php
	session_start();	
	require_once "/includes/data_base.php";

?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

<!-- title and meta -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<meta name="description" content="A simple responsive navigation menu using HTML, CSS, and a bit of jQuery." />
<title>Gezz Supllier</title>
    
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



<?php
	
	// get id from URL
	$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

	//Validation
	if (empty($id)){
	echo "NO ID FOR ALTERATION ";
    exit;
	}else{
	$sql = "SELECT Id, F_name, S_name, DOB, Email, User, Password, Address, Phone FROM user WHERE Id='$id'";
	$result_sql = $DBH->prepare($sql);
	$result_sql->bindParam(':id', $id, PDO::PARAM_INT);

	$result_sql->execute();

	$ready_sql = $result_sql->fetch(PDO::FETCH_ASSOC);
	}
	if(!is_array($ready_sql)){
	echo "Nunhum contato encontrado";
    exit;	

}
?>

<body>

<div id="wrapper">


<header>
    <div id="title" class="container">
        <h1>Gezz Supplier</h1>
        <h2>Produtcs as good as heaven</h2>
    </div>
</header>

<!-- menu -->
<div id="main">
    <div class="container">
        <div id="nav-trigger">
            <span>Menu</span>
        </div>
        <nav id="nav-main">
            <ul>
<!-- chechkin type-->
<?php			
if($_SESSION['type'] == '1'):?>
	<li><a href="home.php">Home</a></li>
    <li><a href="products.php">Products</a></li>
    <li><a href="cart.php">Cart</a></li>
    <li><a href="myorders.php">Orders</a></li>
    <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
	<li><a href="logout.php">Logout</a></li>
<?php elseif($_SESSION['type'] == '2'):?>
	<li><a href="admin.php">Home</a></li>
    <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
	<li><a href="logout.php">Logout</a></li>
<?php elseif($_SESSION['type'] == '3'):?>
	<li><a href="staff_home.php">Home</a></li>
    <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
	<li><a href="logout.php">Logout</a></li>
<?php elseif($_SESSION['type'] == '4'):?>
	<li><a href="delivery.php">Home</a></li>
    <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
	<li><a href="logout.php">Logout</a></li>
<?php endif;?>
            
				
            </ul>
        </nav>
        <nav id="nav-mobile"></nav>
	<!-- form -->
  	<section>
        <?php
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false):
			include('form_login.php');
		else:?>
    	<div class="container theme-showcase" role="main"> 
			<div class="page-header">
				<h1>Edit Account</h1>
		</div>    
     <div class="container text-left">
    <form class="form-horizontal" action="update.php" method="POST">
      <div class="form-group">
  	 <div class="col-sm-4">
   	  <input type="hidden" name="id" value="<?php echo $ready_sql['Id'];?>";>
        <label>Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $ready_sql['F_name'] ?>";>
  	 </div>
      </div>
      <div class="form-group">
  	 <div class="col-sm-4">
        <label>Surname:</label>
        <input type="text" class="form-control" id="sname" name="sname" value="<?php echo $ready_sql['S_name'] ?>">
  	 </div>
      </div>
      <div class="form-group">
  	 <div class="col-sm-4">
        <label>DOB:</label>
        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $ready_sql['DOB'] ?>">
  	 </div>
      </div>
       <div class="form-group">
  	 <div class="col-sm-4">
        <label>Email:</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $ready_sql['Email'] ?>">
  	 </div>
      </div>
       <div class="form-group">
  	 <div class="col-sm-4">
        <label>User:</label>
        <input type="text" class="form-control" id="user" name="user" value="<?php echo $ready_sql['User'] ?>">
  	 </div>
      </div>
       <div class="form-group">
   <div class="col-sm-4">
        <label>Password:</label>
        <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $ready_sql['Password'] ?>">
  	 </div>
      </div>
       <div class="form-group">
  	  <div class="col-sm-4">
          <label>Address</label>
  	    <input type="text" class="form-control" id="address" name="address" value="<?php echo $ready_sql['Address'] ?>">
  	  </div>
       </div>
       <div class="form-group">
  	  <div class="col-sm-4">
          <label>Phone</label>
  	    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $ready_sql['Phone'] ?>">
  	  	</div>
		</div>
		<div class="form-group">
		<div class="col-sm-offset-1 col-sm-8">
         <button type="submit" name="submit" class="btn btn-default">Update</button>
       	</div>
       	</div>
  </div>

<?php endif; ?>
        </section>
    </div>
</div><!-- #main -->

<footer>
</footer>


</body>
</html>