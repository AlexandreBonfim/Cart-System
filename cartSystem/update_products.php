<?php
session_start(); 
require_once 'data_base.php';


// pega os dados do formuário
if($_POST){
	$id = $_POST['id'];
	$name =$_POST['name']; 
	$description= $_POST['description']; 
	$price = $_POST['price']; 

}

//validação para evitar dados vazios
if (empty($name) || empty($description) || empty($price))
{
  echo "fill up all fields";
exit;
}

// insere no banco

$sql= "UPDATE products SET name = :name, description = :description, price = :price WHERE Id = :id";
	
$insert_sql = $DBH->prepare($sql);
$insert_sql->bindParam(':name', $name);
$insert_sql->bindParam(':description', $description);
$insert_sql->bindParam(':price', $price);
$insert_sql->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($insert_sql->execute()){
 	echo  "<script>alert('update ok...!!!!.');</script>";		
	echo "<meta http-equiv='refresh'content='0, url=staff_home.php'>";
}else{
    echo "Erro ao cadastrar";
    print_r($insert_sql->errorInfo());
}
 
 
 
 
 
