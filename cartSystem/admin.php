<!DOCTYPE html>
<!-- session and database -->
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
<!-- Select query-->
<?php
$query = "SELECT user.Id, user.F_name, user.User, user.Password, type.type from user INNER JOIN type on user.type=type.id";
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


<div id="main">
    <div class="container">
        <div id="nav-trigger">
    	    <span>Menu</span>
        </div>
        <!-- Menu -->
		<nav id="nav-main">
            <ul>
                <li><a href="edit.php?id=<?php echo $_SESSION['id']; ?>">Edit Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <nav id="nav-mobile"></nav>
		
        <!-- Table -->
        <section>
			<?php
			if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false):
			include('form_login.php');
			else:?>
       	    <div class="container theme-showcase" role="main"> 
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>UserName</th>
                                <th>Type</th>
                                <th>Reset Password</th>
                                <th>Change type</th>                                
							</tr>
						</thead>
						<tbody>
                        
							<?php 
								//while to get each row from database
								while ($row = $sth->fetch(PDO::FETCH_ASSOC)): ?>
									<tr>           
                                		<td><?php echo $row['F_name'];	 ?></td>
										<td><?php echo $row['User']; 	 ?></td>
                                        <td><?php echo $row['type']; ?></td>
                                        <td align="center">
                                        	<!-- button to update  pass -->
	                                        <a  id="updatePsw" href="update_pass.php?id=<?php echo $row['Id']; ?>">
												<span class="glyphicon glyphicon-cog text-danger" aria-hidden="true"></span>
											</a>										
										</td>
                                        <td align="center">
											<!-- button to update  type-->
	                                        <a id="updateType" href="update_type.php?id=<?php echo $row['Id']; ?>">
												<span class="glyphicon glyphicon-transfer text-danger" aria-hidden="true"></span>
											</a>
                                                																					
										</td>
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

</div>


</body>
</html>


