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

<!-- select query for table -->
<?php
	$query = "select * from products";
    $sth = $DBH->prepare($query);  
    $sth->execute();
?>

<body>

<div id="wrapper">

<!-- header -->
<header>
    <div id="title" class="container">
        <h1>Gezz Supplier</h1>
        <h2>Produtcs as good as heaven</h2>
    </div>
</header>

<!--menu -->
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
                <li><a href="myorders.php">Orders</a></li>                
                <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <nav id="nav-mobile"></nav>
		
        <!-- table -->
        <section>
           <div class="container theme-showcase" role="main"> 
			<div class="page-header">
				<h1>Products</h1>
			</div>
           <div class="container theme-showcase" role="main"> 
			<div class="row">
				<div class="col-md-12">
					<table  width="800" class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								//feed the rows
								while ($row = $sth->fetch(PDO::FETCH_ASSOC)): ?>
									<tr>           
										<td ><?php echo "<a href='description.php?id=".$row['Id']."'>".$row['name']."</a></td>"; //link for description passing the id product ?></td>
										<td ><?php echo $row['price']; ?></td>
									</tr>    
								<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		   </div>

        </section>
    </div>
</div>

<footer>
</footer>

</body>
</html>