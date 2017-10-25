<?php
session_start(); 
require_once '/includes/data_base.php';

$type = $_SESSION['type'];
$salt = '1%1cAu!g+>K53PY}';

// pega os dados do formuário
if($_POST){
	$id = $_POST['id'];
	$name =$_POST['name']; 
	$s_name = $_POST['sname']; 
	$dob = $_POST['dob']; 
	$email = $_POST['email'];  
	$user = $_POST['user']; 
	$password = $_POST['pass'];
	$password = md5($password . $salt); 
	$address = $_POST['address'];
	$phone = $_POST['phone'];

}

//validação para evitar dados vazios
if (empty($name) || empty($s_name) || empty($dob) || empty($email)|| empty($user)|| empty($password)|| empty($address)|| empty($phone))
{
  echo "Volte e preencha todos os campos";
exit;
}

// insere no banco

$sql= "UPDATE user SET 
	F_name = :name, S_name = :sname, 
	Dob = :dob, Email = :email, User = :user,
	Password = :pass, Address = :address, Phone = :phone WHERE Id = :id";
	
$insert_sql = $DBH->prepare($sql);
$insert_sql->bindParam(':name', $name);
$insert_sql->bindParam(':sname', $s_name);
$insert_sql->bindParam(':dob', $dob);
$insert_sql->bindParam(':email', $email); 
$insert_sql->bindParam(':user', $user);
$insert_sql->bindParam(':pass', $password);
$insert_sql->bindParam(':address', $address);
$insert_sql->bindParam(':phone', $phone);
$insert_sql->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($insert_sql->execute()){
 	echo  "<script>alert('update ok...!!!!.');</script>";		
    if($type == '1'){
		header("Location: home.php");
		die();
	  }elseif($type == '2'){
		header("Location: admin.php");	
		die();
	  }elseif($type == '3'){
		header("Location: staff_home.php");
		die();
	  }elseif($type == '4'){
		header("Location: delivery.php");
		die();  
	  }
}else{
    echo "Erro ao cadastrar";
    print_r($insert_sql->errorInfo());
}
 
 
 
 
 
