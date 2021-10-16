<?php
session_start();
 include('php/conexion.php');
 // paginador
 $registros0=mysqli_query($conexion,"select id_producto from productos where id_marca='$_GET[id_marca]'") or die ("Error al conectar con la tabla".mysqli_error($conexion));
 $numero_total_registros=mysqli_num_rows($registros0);
 
 $TAMANO_PAGINA = 8;
        $pagina = false;

        if (isset($_GET["pagina"]))
            $pagina = $_GET["pagina"];
        
	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	$total_paginas = ceil($numero_total_registros / $TAMANO_PAGINA);
	/*
$registros1=mysqli_query($conexion,"select * from productos order by nombre asc LIMIT ".$inicio."," .$TAMANO_PAGINA) or die ("Error al conectar con la tabla".mysql_error($conexion));
	*/
 // paginador
 $registros1=mysqli_query($conexion,"select * from marcas order by marca asc");
 if(isset($_GET['name']) && $_GET['name']=="mayormenor"){
 	$registros2=mysqli_query($conexion,"select id_producto, precio,cantidad from productos where id_marca='$_GET[id_marca]' AND cantidad!=-2 order by precio desc LIMIT ".$inicio."," .$TAMANO_PAGINA);
 }
 
 else{
	 
	$registros2=mysqli_query($conexion,"select id_producto, precio,cantidad from productos where id_marca='$_GET[id_marca]' AND cantidad!=-2 order by precio asc LIMIT ".$inicio."," .$TAMANO_PAGINA); 
	 
 }
 $registros4=mysqli_query($conexion,"select marca from marcas where id='$_GET[id_marca]'");
 $fila4=mysqli_fetch_array($registros4);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Productos</title>
<link rel="stylesheet" href="iconos/css/font-awesome.min.css">
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/normalizar.css">
<link rel="stylesheet" href="css/hover-min.css">
<link href='https://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
<!-- bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<!-- bootstrap -->
<script type="text/javascript">
function f_ordenar(id){
	
	var name=document.form1.ordenar.value;
	location.href="mostrarproductos.php?name="+name+"&id_marca="+id;
	
}
</script>


<!-- Menu -->
	<link rel="stylesheet" href="CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<!-- End css3menu.com HEAD section -->
</head>
<body>
<header>
<div class="cabecera"></div>
<nav class="wow bounceInDown" data-wow-duration="1.5s">
<!-- Start css3menu.com BODY section -->
<nav class="navbar navbar-expand-lg navbar-light " id="main_navbar" style="background-color: #EBF9FA;"  >
        <img class="logo" href="#" style=" position:absolute;margin-top:5px;left:40%;width:180px; height:70px" src="imagenes/logo.png">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color: #EBF9FA;">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cuenta</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Marcas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            while($fila=mysqli_fetch_array($registros))
                            {
                            ?>
                                <li><a href="mostrarproductos.php?id_marca=<?php echo $fila['id']; ?>"><?php echo utf8_encode($fila['marca']);?></a></li>
                            <?php } ?>
                                
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
</header>
<div class="main">

<div style="max-width:1000px">
<?php 

if(isset($_SESSION['nombre_cliente']) || isset($_COOKIE['nombre_cliente'])){

?>
<div style="margin-bottom:-4px; float:right">
<p style="font-family:'Ceviche One',cursive; font-size:24px"><a style=" text-decoration:none" href="clientes/zona_clientes"><span style="color:#F90">Bienvenido/a</span><span style="color:#FFF">
<?php
	if(isset($_SESSION['nombre_cliente'])) 
		echo $_SESSION['nombre_cliente'];

	if(!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])) 
		echo $_COOKIE['nombre_cliente'];
?>
</span></a></p>
</div>
<?php
}
?>

<p class="fuente"><span style="color:red">Inicio</span><span style="color:#FFF"> -></span><span style="color:#F90"><?php echo utf8_encode($fila4['marca']); ?></span></p>
<p>
</div>
</br>
<form name="form1">
<select onChange="f_ordenar('<?php echo $_GET['id_marca']; ?>')" class="form-control" name="ordenar">
  <option>Ordenar por...</option>
  <option value="menormayor">Ordenar por precio de menor a mayor</option>
  <option value="mayormenor">Ordenar por precio de mayor a menor</option>
  
</select>
</form></p>
<?php
while($fila2=mysqli_fetch_array($registros2)){
		$registros3=mysqli_query($conexion,"select nombre from imagenes where 	id_producto='$fila2[id_producto]' and prioridad=1");
		$fila3=mysqli_fetch_array($registros3);
?>
<a href="detalleproducto.php?id_marca=<?php echo $_GET['id_marca']; ?>&id_producto=<?php echo $fila2['id_producto'];  ?>"><div class="productosmain hvr-float-shadow"><img src="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros3)>0)echo $fila3['nombre']; else echo "no-disponible.jpg"; ?>" width="100%" alt="portatil1"/><div class="precio"><?php echo $fila2['precio']." Pesos"; ?></div></div></a>
<?php
}
cerrarconexion();
?>
<div class="limpiar"></div>

<div class="centrar-pag">
<nav>
  <ul class="pagination"> 
<?php 
if(isset($_GET['name'])){

	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<li><a href="mostrarproductos.php?name='.$_GET['name'].'&id_marca='.$_GET['id_marca'].'&pagina='.($pagina-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i)
				
				echo '<li><a href="#"><div class="color-pag">'.$pagina.'</div></a></li>';
			else
				
				echo ' <li><a href="mostrarproductos.php?name='.$_GET['name'].'&id_marca='.$_GET['id_marca'].'&pagina='.$i.'">'.$i.'</a></li> ';
		}
		if ($pagina != $total_paginas)
			echo '<li><a href="mostrarproductos.php?name='.$_GET['name'].'&id_marca='.$_GET['id_marca'].'&pagina='.($pagina+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
	}
	echo '</p>';
}

else{
	
	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<li><a href="mostrarproductos.php?id_marca='.$_GET['id_marca'].'&pagina='.($pagina-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i)
				
				echo '<li><a href="#"><div class="color-pag">'.$pagina.'</div></a></li>';
			else
				
				echo ' <li><a href="mostrarproductos.php?id_marca='.$_GET['id_marca'].'&pagina='.$i.'">'.$i.'</a></li> ';
		}
		if ($pagina != $total_paginas)
			echo '<li><a href="mostrarproductos.php?id_marca='.$_GET['id_marca'].'&pagina='.($pagina+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
	}
	echo '</p>';
}
	
	


?>
		</ul>
	</nav>
	</div>
</div>
<footer style="margin-top:-10px" class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados tiendaonline.com</p></footer>


<!-- ventana modal -->
<div style="margin-top:100px" class="modal fade" id="mostrar_ventana_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" id="i" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Inicio de Sesión</h4>
      </div>
      <div class="modal-body">
        <form name="form_inicio_sesion">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="text" name="email" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Password:</label>
            <input type="password" name="password" class="form-control" id="recipient-name">
          </div>
          
          
           <div class="checkbox">
    			<label>
      			<input type="checkbox" id="checkbox_recordar"> Recordar usuario.
    			</label>
 			</div>
          
          
        </form>
      </div>
      
     <!-- imagen de carga -->
      <center><div style="display:none;" id="carga"><img src="imagenes/cargando.gif"/></div></center>
      
      
      <div style="padding-left:10px; font-size:12px">
      	<a href="#" onclick="link_password()">He olvidado mi contraseña</a>
      </div>
      
      <div style="padding:13px; display:none" id="link_password">
      	<form name="form_olvido_password">
      		<div class="form-group">
            	<label for="recipient-name" class="control-label">Email:</label>
            	<input type="text" name="email" class="form-control" id="recipient-name">
          	</div>
      	</form>
        <button type="button" onclick="recuperar_password()" class="btn btn-success">Recuperar Contraseña</button>
      </div>
      
      <div class="modal-footer">
      
      <!-- aler contraseña no correcta -->
      
      <div style="display:none" id="alertlogin" class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span   aria-hidden="true">&times;</span></button>
    <center>Email o password incorrecto</center>
    </div>

    
        <button type="button" onclick="validar_sesion()" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>


<!--carrito-->
<div id="b"  class="carrito">
	<div  style=" width:50px; height:120px; float:left; padding:4px; background-color:#333; border-radius:10px 0px 0px 10px; margin-left:-50px; cursor: pointer">
    		
    		<i style=" margin-top:33px; margin-left:200px; color:#f33; font-size:35px" class="fa fa-shopping-basket" aria-hidden="true"></i>  
      			
    </div>
    <div style="height:200px; padding:4px; overflow:auto" id="mostrar_compra">
        
    </div>
</div>
<!--carrito-->

<script type="text/javascript" src="clientes/inicio_de_sesion/inicio_de_sesion.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="compra/compra.js"></script>


</body>
</html>