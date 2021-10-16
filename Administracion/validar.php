<?php
session_start();
if(!isset($_SESSION['administrador']))
{
    if($_POST['usuario']=="admin" && $_POST['password']=="123")
    {
    $_SESSION['administrador']=$_POST['usuario'];
    echo "es correcto";
    }
}
if(isset($_SESSION['administrador']))
{
    echo "Hola ".$_SESSION['administrador'];
    echo "<a href='productos/formaniadirproductos.php'>Entrar Marcas</a>";
}
else
{
    header('location:index.html');
}
?>