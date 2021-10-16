<?php
session_start();
?>
<?php if(isset($_SESSION['administrador'])){?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administracion</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css">
     
    <script src="../../js/jquery-3.1.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/administracion.css">
    <style type="text/css">
    .mostrarmarc
{
    margin: 50px auto 0px auto;
    max-width: 700px;
    width: 100%;

}
    </style>
</head>
<body>
    <div class="tmarc"><strong>Actualizar Marcas</strong></div>
    <div class="formulario">
            <form  method="POST" action="modificarmarcas.php">
                    <div class="form-group">
                      <label for="exampleInputText1">Actualizar Marca</label>
                      <input type="text" class="form-control" id="exampleInputText1"  name="marcanueva">
                      <input type="hidden" name="marcavieja" value="<?php echo $_GET['marcavieja'] ?>">
                    </div> 
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                  </form>
    </div>
    
    
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>

</body>
</html>

<?php 
}

else{
    header('location:../index.php');
}
?>
