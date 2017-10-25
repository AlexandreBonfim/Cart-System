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

<!-- select for table -->
<?php
$query = "SELECT `order`.id, `order`.date, `order`.total, `delivery`.type FROM `order` INNER JOIN `delivery` ON `order`.status=`delivery`.id WHERE `order`.status = '1';";
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

<!-- menu-->
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

        <section>
	  <?php
	    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false):
		include('form_login.php');
  			 else:?>
	  <div class="container theme-showcase" role="main"> 
			<div class="page-header">
				<h1>Cart</h1>
			</div>
        	<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Order</th>
								<th>Status</th>
                                <th>Date</th>
                                <th>Total</th>
                              </tr>
						</thead>
						<tbody>
                        
							<?php 
								while ($row = $sth->fetch(PDO::FETCH_ASSOC)): ?>
									<tr>           
										<td><?php echo $row['id'];	    ?></td>
										<td><?php echo $row['type']; ?></td>
                                        <td><?php echo $row['date'];    ?></td>
                                        <td><?php echo $row['total'];   ?></td>

									</tr>    
								<?php endwhile; ?>
						</tbody>
					</table>
	
       <?php endif; ?>

        </section>
    </div>
</div>

	

<footer>
</footer>

</body>
</html>


