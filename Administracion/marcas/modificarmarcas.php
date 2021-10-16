<?php
session_start();
if(isset($_SESSION['administrador']))
{
    if($_POST['marcanueva']!=""){
    include('../../php/conexion.php');
    $marcanueva = utf8_decode($_POST['marcanueva']);
    $marcavieja = utf8_decode($_POST['marcavieja']);
    $registros=mysqli_query($link,"select marca from marcas where marca='$marcanueva'");
    if(mysqli_num_rows($registros)==0)
    {
    mysqli_query($link,"update marcas set marca='$marcanueva' where marca='$marcavieja'");
    cerrarconexion();
    header('location:formmarcas.php?validado=4&alert='.$marcavieja.'&marcanueva='.$marcanueva);
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