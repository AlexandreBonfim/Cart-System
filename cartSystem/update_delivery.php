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
<title>Delivery</title>
    
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
	$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
	$_SESSION['testid'] = $id;
	
	$sql = "SELECT * FROM delivery";
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
			include('form_login.php');
			else:?>
       	    		<!-- consertar depois-->
		<form class="form-horizontal" action="send_update_delivery.php" method="post" >		
			<table align="center" width="657" border="0">
				 <tr>
			        <td><label>Status:</label> </td>
			        <td><select name="chose">
        	        <option value="">-Selecione-</option>
            		    <?php 
	   					 while($row=$sth->fetch(PDO::FETCH_ASSOC)){                         //depois ajeitar                        
					       echo "<option value='".$row['id']."'>".$row['type']."</option>"; 
					     }
						?>
		  	    	</select><br><br>
                    <input type="submit" name="submit" value="Change">
                    <input type="submit" name="submit2" value="Packing Slip">
                    </form>
                    </td>
					</td>	         
                 </tr>
              </table>
  
             <?php endif; ?>
        </section>
    </div>
</div>


</body>
</html>


