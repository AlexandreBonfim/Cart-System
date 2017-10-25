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

$sql = "select * from products";
$sth = $DBH->prepare($sql);  
$sth->execute();
	
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
       	    	<div class="container theme-showcase" role="main"> 
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Products</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								//Para obter os dados pode ser utilizado um while percorrendo assim cada linha retornada do banco de dados:
								while ($row = $sth->fetch(PDO::FETCH_ASSOC)): ?>
									<tr>           
										<td><?php echo $row['name']; ?></td>
										<td>
	                                        <a id="updateProd" href="form_update_products.php?id=<?php echo $row['Id']; ?>">
												<span class="glyphicon glyphicon-cog text-danger" aria-hidden="true"></span>
											</a>										
                                        </td>
									</tr>    
								<?php endwhile; ?>
						</tbody>
					</table>
	
             <?php endif; ?>
        </section>
    </div>
</div><!-- #main -->



<footer>
</footer><!-- /footer -->



</div><!-- /#wrapper -->


</body>
</html>


