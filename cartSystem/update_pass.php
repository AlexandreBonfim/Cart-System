<?php
	session_start();
	require_once ("includes/data_base.php");
	
	//recebi id
	$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
	$salt = '1%1cAu!g+>K53PY}';
	$pass = md5('12345678' . $salt);
	$sql= "UPDATE user SET Password = '$pass' WHERE Id = :id";
	
	$insert_sql = $DBH->prepare($sql);
	//$insert_sql->bindParam(':pass', $password);
	$insert_sql->bindParam(':id', $id, PDO::PARAM_INT);
 
	if ($insert_sql->execute()){
 		echo  "<script>alert('update password ok...!!!!.');</script>";		
  		echo "<meta http-equiv='refresh'content='0, url=admin.php'>";
	}else{
    echo "Erro ao cadastrar";
    print_r($insert_sql->errorInfo());
	}

?>
	