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
    <form class="form-horizontal" action="?go=save" method="POST">
     <div class="form-group">
   	 <div class="col-sm-4">
     <input type="hidden" name="id" value="<?php echo $ready_sql['Id']; ?>";>
     <label>Name:</label>
     <input type="text" class="form-control" id="name" name="name" value=" <?php echo $ready_sql['name']; ?>";>
  	 </div>
     </div>
     <div class="form-group">
  	 <div class="col-sm-4">
 	   <label>Description:</label>
       <input type="text" class="form-control" id="description" name="description" value="<?php echo $ready_sql['description']; ?>">
 	 </div>
     </div>
     <div class="form-group">
 	 <div class="col-sm-4">
       <label>Price:</label>
       <input type="text" class="form-control" id="price" name="price" value="<?php echo $ready_sql['price']; ?>">
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
<?php
// pega os dados do formuário
if(@$_GET['go'] == 'save'){
	$id = $_POST['id'];
	$name =$_POST['name']; 
	$description= $_POST['description']; 
	$price = $_POST['price']; 

}elseif (empty($name) || empty($description) || empty($price))//validação para evitar dados vazios
{
  echo "fill up all fields";
exit;
}

// insere no banco

$sql= "UPDATE products SET name = :name, description = :description, price = :price WHERE Id = :id";
	
$insert_sql = $DBH->prepare($sql);
$insert_sql->bindParam(':name', $name);
$insert_sql->bindParam(':description', $description);
$insert_sql->bindParam(':price', $price);
$insert_sql->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($insert_sql->execute()){
 	echo  "<script>alert('update ok...!!!!.');</script>";		
	echo "<meta http-equiv='refresh'content='0, url=staff_home.php'>";
}else{
    echo "Erro ao cadastrar";
    print_r($insert_sql->errorInfo());
}

?>

<footer>
</footer><!-- /footer -->



</div><!-- /#wrapper -->


</body>
</html>


