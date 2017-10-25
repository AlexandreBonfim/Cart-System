<?php	
	session_start()/
	require_once('/includes/data_base.php');
	
	//recebi id
	
	if($_POST):
		$type = $_POST['chose'];
		$id   =	$_SESSION['testid'];
	endif;	

	$sql= "UPDATE user SET Type='$type' WHERE Id = '$id'";
	
	$insert_sql = $DBH->prepare($sql);
	//$insert_sql->bindParam(':pass', $password);
	$insert_sql->bindParam(':id', $id, PDO::PARAM_INT);
 
	if ($insert_sql->execute()){
 		echo  "<script>alert('update type ok...!!!!.');</script>";	
		echo "<meta http-equiv='refresh'content='0, url=admin.php'>";
	}else{
    echo "Erro ao cadastrar";
    print_r($insert_sql->errorInfo());
	}

?>