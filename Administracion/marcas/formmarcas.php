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
    <?php if(isset($_GET['validado'])){ 
        if($_GET['validado']==1){
        ?>
    <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <p class="centrar" style="text-align: center;">La marca <strong> <?php echo $_GET['alert']; ?> </strong>se ha agregado correctamente<p>
    </div>
    <?php }
        else if($_GET['validado']==2)
        {   ?>
            <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <p class="centrar">No has agregado ninguna marca <p>
    </div>
    <?php
        }
        else if($_GET['validado']==3){
        ?>
        <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <p class="centrar">Ya existe la marca <strong> <?php echo $_GET['alert']; ?> </strong><p>
    </div>

        <?php
        }
        else if($_GET['validado']==4){
        ?>
        <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <p class="centrar" style="text-align: center;">La marca <strong> <?php echo $_GET['alert']; ?>
     </strong>se ha actualizado correctamente por <strong> <?php echo $_GET['marcanueva']; ?><strong><p>
    </div>
        <?php
        }
    }
        ?>
    <link rel="stylesheet" type="text/css" href="../../css/administracion.css">
    <div class="tadmin">Añadir Marcas</div>
    <div class="formulario">
            <form  method="POST" action="anadirmarcas.php">
                    <div class="form-group">
                      <label for="exampleInputText1">Añadir Marca</label>
                      <input type="text" class="form-control" id="exampleInputText1"  name="marca">

                    </div> 
                    
                    <button type="submit" class="btn btn-primary">Añadir</button>
                  </form>
    </div>
    
    <div class="mostrarmarc">
        
    <?php
    
    include('../../php/conexion.php');
    $registros=mysqli_query($conexion,"select * from marcas order by id desc");
    cerrarconexion();
    
        ?>
        <table class="table table-hover">
            <?php
while($fila=mysqli_fetch_array($registros))
{
?>
  <thead>
    <tr class="active">
      <td><?php echo utf8_encode($fila['marca']);?></td>
      <td><a href="formmodificarmarcas.php?marcavieja=<?php echo utf8_encode($fila['marca']);?>"><button type="button" class="btn btn-success">Editar</button></a></td>
      <td><a href="#"><button type="button" class="btn btn-danger">Eliminar</button></a></td>
    </tr>
  

        <?php
    }
    ?>
    </table>
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

