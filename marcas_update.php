<?php 

session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
    

if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    $marca="";
    
    $idMarca=$_GET['marca'];
    
    if (isset($_POST['marca'])) {
        $marca=$_POST['marca'];
    }
   
    $con=new mysqli("localhost","root","","marcas");
    if ($con->connect_errno!=0) {
        echo "Erro<br>".$con->connect_erro;
        exit;
    }
    else{
        $sql='update marcas set marca=? where id=?';
        $stm=$con->prepare($sql);
        if ($stm!=false) {
            $stm->bind_param('si',$marca, $idMarca);
            $stm->execute();
            $stm->close();


           

            header("refresh:5; url=index.php");
            }
        else{
            }
        }
    }
else{
   
    header("refresh:5; url=index.php");
    }

}
else{
   
    header('refresh:2;url=login.php');
}