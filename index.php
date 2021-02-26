<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	


 ?>



<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>



<?php 
$con=new mysqli("localhost","root","","marcas");
if($con->connect_errno!=0){
	echo "Erro".$con->connect_error;
	exit;
}
else{
	if(!isset($_SESSION['login'])){
		$_SESSION['login']="incorreto";
	}
	if($_SESSION['login']=="correto"){

	 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>





<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h1>Marcas <i class="fas fa-film"></i></h1>
<?php 
$stm=$con->prepare('select * from marcas');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="marcas_show.php?marc='.$resultado['id'].'">';
	echo $resultado['marca'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="marcas_edit.php?marca='.$resultado['id'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="marcas_delete.php?marca='.$resultado['id'].'">Eliminar</a>';
	echo "<br>";
}
$stm->close();
echo "<br>";
echo "<a href='marcas_create.php'>Adicionar</a>"
 ?>
 

		</div>
		<div class="col-md-4">
<h1>Modelos <i class="fas fa-user-friends"></i></h1>
<?php 
$stm=$con->prepare('select * from modelos');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="modelos_show.php?modelo='.$resultado['id'].'">';
	echo $resultado['modelo'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="modelos_edit.php?modelo='.$resultado['id'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="modelos_delete.php?modelo='.$resultado['id'].'">Eliminar</a>';
	echo "<br>";



}

$stm->close();

echo "<br>";
echo "<a href='modelos_create.php'>Adicionar</a>";


 ?>
		</div>

		
	</div>
	
	<div class="row" >
		<div class="col-md-4 offset-sm-4">


		</div>
	</div>
</div>



<?php 
}
else{
	
	header('refresh:2;url=login.php');
}

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