<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	

 ?>



<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<?php 

if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (!isset($_GET['modelo'])|| !is_numeric($_GET['modelo'])) {
		echo "<script>alert('Erro');</script>";
		
		header("refresh:5;url=index.php");
	}
	$id=$_GET['modelo'];
	$con=new mysqli("localhost","root","","marcas");


	if ($con->connect_errno!=0) {
		echo "Erro".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from modelos where id= ?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$id);
			$stm->execute();
			$res=$stm->get_result();
			$mod=$res->fetch_assoc();
			$stm->close();

		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			
			
			header("refresh:5; url=index.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<h1>Modelos</h1>
<?php 
if (isset($mod)) {
	echo "<br>";
	echo utf8_encode($mod['id_marca']);
	echo "<br>";
	echo utf8_encode($mod['modelo']);
	echo "<br>";
	echo utf8_encode($mod['ano']);
	echo "<br>";
	
}
else{
 echo "Erro";
}

?>

</body>
</html>



<?php
}
else{
	
	header('refresh:2;url=login.php');
}
  ?>