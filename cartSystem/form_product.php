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
<title>Administrator</title>
    
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
	
	// pega o ID da URL
	$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

	$sql = "SELECT * FROM products WHERE Id='$id'";
	$result_sql = $DBH->prepare($sql);
	$result_sql->bindParam(':id', $id, PDO::PARAM_INT);

	$result_sql->execute();

	$ready_sql = $result_sql->fetch(PDO::FETCH_ASSOC);
	
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
        <div id="nav-trigger">
            <span>Menu</span>
        </div>
        <nav id="nav-main">
            <ul>
                <li><a href="staff_home.php">Home</a></li>
                <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <nav id="nav-mobile"></nav>

        <section>
			<?php
			if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false):
			include('/forms/form_login.php');
			else:?>
				 <div class="container text-left ">
   <form class="form-horizontal" action="?go=Add" method="POST">
     <div class="form-group">
 	 <div class="col-sm-4">
       <label>Name:</label>
        <input type="text" class="form-control" id="name" name="name">
  	 </div>
     </div>
     <div class="form-group">
  	 <div class="col-sm-4">
        <label>Description:</label>
        <input type="text" class="form-control" id="description" name="description">
  	 </div>
     </div>
     <div class="form-group">
  	 <div class="col-sm-4">
        <label>Price:</label>
        <input type="text" class="form-control" id="price" name="price">
  	 </div>
     </div>
 	 <div class="form-group">
     <div class="col-sm-offset-1 col-sm-8">
        <button type="submit" name="submit" class="btn btn-default">Add</button>
   		<button type="reset" name="submit" class="btn btn-default">Reset</button>
   	 </div>
     </div>
  </div>


             <?php endif; ?>
        </section>
    </div>
</div><!-- #main -->
<?php
	
	if(@$_GET['go'] == 'Add'){
			$name = $_POST['name'];
			$description= $_POST['description'];
			$price = $_POST['price'];
			
	if(empty($name)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($description)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}elseif(empty($price)){
		echo  "<script>alert('fill up all fields.');history.back();</script>";
	}else{
		$query = $DBH->prepare("SELECT * FROM products WHERE name= '$name'"); //connection class problem i will fix that later
		$query->execute();
		$check = $query->fetch(PDO::FETCH_ASSOC);
		if ($check > 0){
			echo "<script>alert('product already exist.');history.back();</script>";
		}else{
			$query1 = "INSERT INTO products(name, description, price) VALUES ('$name','$description','$price');";			
			$sth = $DBH->prepare($query1);
				$sth->bindParam(1, $name, PDO::PARAM_STR);
				$sth->bindParam(2, $description, PDO::PARAM_STR);
				$sth->bindParam(3, $price, PDO::PARAM_STR);

			$sth->execute();
			echo "<script>alert('register prduct sucessul.');</script>";
			echo "<meta http-equiv='refresh'content='0, url=staff_home.php'>";
		}
	  }
	}
											
?>

<footer>
</footer><!-- /footer -->



</div><!-- /#wrapper -->


</body>
</html>


