<?php
session_start();
if(isset($_SESSION['administrador']))
{
    if($_POST['marca']!=""){
    include('../../php/conexion.php');
    $marca = utf8_decode($_POST['marca']);
    $registros=mysqli_query($conexion,"select marca from marcas where marca='$marca'");
    if(mysqli_num_rows($registros)==0)
    {
    mysqli_query($conexion,"insert into marcas (marca) values ('$marca')");
    cerrarconexion();
    header('location:formmarcas.php?validado=1&alert='.$_POST['marca']);
    }
    else
    {
        header('location:formmarcas.php?validado=3&alert='.$_POST['marca']);
    }
    }
    else if($_POST['marca']==""){
        header('location:formmarcas.php?validado=2');

    }
    
}

else
{
    header('location:../index.php');
}
?>