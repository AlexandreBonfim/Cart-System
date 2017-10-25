<?php
	session_start();
	require_once('/includes/data_base.php');	
	
	$total = $_SESSION['total'];
	$id    = $_SESSION['id'];
	$qtd   = $_SESSION['qtd'];
	
			
			$query = "INSERT INTO `order`( `user_id`, `total`) VALUES ('$id','$total')";
			$sth = $DBH->prepare($query);
				$sth->bindParam(1, $id, PDO::PARAM_STR);
				$sth->bindParam(2, $total, PDO::PARAM_STR);

				$sth->execute();

			$idorder =  $DBH->lastInsertId();

	foreach($_SESSION['cart'] as $prod => $qtd):		
		$query1 = "INSERT INTO cart(id_prod, id_order) VALUES ('$prod','$idorder');";			
			$sth = $DBH->prepare($query1);
			$sth->bindParam(1, $id, PDO::PARAM_STR);
			$sth->bindParam(2, $total, PDO::PARAM_STR);

			$sth->execute();
	endforeach;
	
	echo "<script>alert('compra realizada com sucesso');</script>";
	echo "<meta http-equiv='refresh'content='0, url=index.php'>";
			
?>          