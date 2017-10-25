<?php	
	session_start();
	include ('pdf/mpdf.php');
	require_once('/includes/data_base.php');
	require_once("date.php");
	
	$site = new site();


	//recebi id
	
	if(isset($_POST['submit'])):
		$status = $_POST['chose'];
		$id   =	$_SESSION['testid'];
	endif;	

	$query= "UPDATE `order` SET `status`='$status' WHERE `id` = '$id'";
	
	$insert_query= $DBH->prepare($query);
	//$insert_sql->bindParam(':pass', $password);
	$insert_query->bindParam(':id', $id, PDO::PARAM_INT);
 
	if ($insert_query->execute()){
 		echo  "<script>alert('update type ok...!!!!.');</script>";	
		echo "<meta http-equiv='refresh'content='0, url=delivery.php'>";
	}else{
    echo "Erro ao cadastrar";
    print_r($insert_query->errorInfo());
	}
	
	if(isset($_POST['submit2'])){

		$id   =	$_SESSION['testid'];
		
			$sql = "SELECT user.fname, user.address, user.ID, `order`.id, `order`.data from user INNER JOIN 
		`order` on user.ID=`order`.user_id WHERE `order`.id = $id";
		
		$query = "SELECT user.F_name, user.Address, user.Id, `order`.id, `order`.date from user INNER JOIN 
		`order` on user.Id=`order`.user_id WHERE `order`.id = $id";
		
        $sth = $DBH->prepare($query);  
        $sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC); 		   
		
		$query2 = "SELECT `products`.`name`, `cart`.`id_prod` FROM products INNER JOIN `cart` on `products`.Id=`cart`.`id_prod` WHERE `cart`.id_order = $id";
        $sth2 = $DBH->prepare($query2);  
        $sth2->execute();

		while ($rowprod = $sth2->fetch(PDO::FETCH_ASSOC)):
			$idProd   = $rowprod['id_prod'];
			$nameProd = $rowprod['name'];
		endwhile;
		 
		$pagina = 
		'<html>
			<body>
				<h1>Gezzz Supplier</h1>
				<p>Address: 16, Adelaide road</p>
				<p>Dublin 2, Dublin - Ireland</p>
				<p>Phone: 089 967 0117</p><br><br>
				<table width="800">

					<tr>
						<td><b>OrderNumber:</b> '.$row['id'].'</td>
						<td><b>CustomerName:</b>'.$row['F_name'].'</td>
					</tr>
					<tr>	
						<td><b>OrderDate:</b> '.$row['date'].'</td>
						<td><b>Date:</b> '.$site-> getData().'</td>
					</tr>	
					<tr>	
						<td><b>CustomerAccount:</b> '.$row['Id'].'</td>
						<td><b>Ship To:</b>'.$row['Address'].'</td>
					</tr>						
				</table><br><br><br>
				<table border="5" width="800">
					<tr>
								<th>Id Product</th>
								<th>Product Name</th>
                     </tr>       

					<tr>
						<td align="center">'.$idProd.'</td>
						<td align="center">'.$nameProd.'</td>
					</tr>						
				</table>
			</body>
		</html>
		';
		

$arquivo = "Cadastro01.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
	}
?>
	

