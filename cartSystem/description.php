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
 
 // pega o ID da URL
$id = $_GET['id'];

if (empty($id)){
	echo ' nenhum item selecionado';	
}
 $sql = "select * from products WHERE Id='$id'";
 $sth = $DBH->prepare($sql);  
 $sth->bindParam(':Id', $id, PDO::PARAM_INT);
 $sth->execute();

 $row = $sth->fetch(PDO::FETCH_ASSOC);		


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
                <li><a href="home.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <nav id="nav-mobile"></nav>

        <section>
          		<div class="container theme-showcase" role="main"> 
			<div class="page-header">
				<h1><?php echo $row['name']; ?></h1>
			</div>

            <div>
            	<p> <?php echo $row['description']?> </p>
                
            </div>

       <!-- test qtd    
       		<div align="right">
            	<label for="q">Quantity: </label>
                		<select>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>

						</select>
            </div>-->

            <div align="right">
            	
            	<b>	$ <?php echo $row['price']; 
						// depois do interrogação (action=add&) add no da an lembre-se!!!
				?> </b><br><br>
            </div>
			
			<div class="pull-right">
  				<p><a href="cart.php?action=add&id=<?php echo $id; ?>"><button type="button">Add Cart</button></a></p>
			</div>   

        </section>
    </div>
</div><!-- #main -->


<footer>
</footer><!-- /footer -->



</div><!-- /#wrapper -->


</body>
</html>
















