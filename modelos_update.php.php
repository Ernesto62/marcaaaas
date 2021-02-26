<?php 

session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
    

if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    $id_marca="";
    $modelo="";
    $ano="";

    
    $idModelo=$_GET['modelo'];
    
    


        

    if (isset($_POST['modelo'])) {
        $modelo=$_POST['modelo'];
    }
     if (isset($_POST['ano'])) {
        $ano=$_POST['ano'];
    }
    $con=new mysqli("localhost","root","","marcas");
    if ($con->connect_errno!=0) {
        echo "Erro<br>".$con->connect_erro;
        exit;
    }
    else{
        $sql='update modelos set id=?, id_marca=?, modelo=?, ano=? where id_modelo=?';
        $stm=$con->prepare($sql);
        if ($stm!=false) {
            $stm->bind_param('issi',$id_marca,$modelo,$ano,$idModelo);
            $stm->execute();
            $stm->close();


           

            header("refresh:5; url=index.php");
            }
        else{
            }
        }
    }
else{
     echo "Erro";
   
    header("refresh:5; url=index.php");
    }
}
else{

   
    header('refresh:2;url=login.php');
}
?>