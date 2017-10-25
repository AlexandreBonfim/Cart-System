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

<!-- create session and array -->
<?php
if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	
	 //adicion o product
	 
	if(isset($_GET['action'])){ //consertar
		
		// ADICIONA AQUI
	if($_GET['action'] == 'add'){
		$id = $_GET['id'];		
			if(!isset($_SESSION['cart'][$id])){ // se nao tiver coloca 1
					$_SESSION['cart'][$id] = 1;
				}else{ // caso, exista coloca + 1 
					$_SESSION['cart'][$id] += 1;
				}
			}
		}
	
			if(isset($_GET['del'])){
  				$del = $_GET['del'];				
					$count = $_SESSION['cart'][$del]; 
					$_SESSION['cart'][$del] = $count - 1;
					
					if($count -1 == '0'){
						unset($_SESSION['cart'][$del]);
					}
			}
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
					<table width="600">
						<thead>
							<tr align="center">
								<th>Product</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total</th>
								<th>Ações</th>
							</tr>
						</thead>
						<tbody>
    	                 <?php

								$totalall = 0;
									foreach($_SESSION['cart'] as $id => $qtd):
										 $query   = "select * from products WHERE Id='$id'";
										 $sth   = $DBH->prepare($query);  
										 $sth   ->execute();

										 $row   = $sth->fetch(PDO::FETCH_ASSOC);											
										 
										 $name   	= $row['name'];
										 $price 	= $row['price'];
										 $total 	= $row['price'] * $qtd;
									     $totalall += $total;
									
	
						?>
	                        <tr align="center"> 
										<td><?php echo $name; ?></td>
										<td><?php echo $qtd; ?></td>
										<td><?php echo $price; ?></td>
										<td><?php echo number_format($total,2,",","."); ?></td>
                                        <td>
	                                        <a href="cart.php?del=<?php echo $row['Id']; ?>">
												<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
											</a>										
										</td>
                                                  
										
							</tr>
                        <?php endforeach;
						$_SESSION['total'] = $totalall;
						$_SESSION['qtd'] = $qtd;
						?>
                        	<tr>
                                   <th>Total</th>
                                   <td colspan="3" align="right">£<?php echo $totalall;?></td>
                            </tr>
                        </tbody>
                      </table>

			<div class="pull-right">
				<p><a href="finished_cart.php"><button type="button"  style="margin:5px" >Buy</button></p>
			</div>
            <?php endif;?>
        </section>
    </div>
</div><!-- #main -->


<footer>
</footer>

</body>
</html>