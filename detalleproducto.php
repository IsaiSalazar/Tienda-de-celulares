<?php
session_start();
include('php/conexion.php');
$registros1=mysqli_query($conexion,"select * from marcas order by marca asc");
$registros2=mysqli_query($conexion,"select marca from marcas where id='$_GET[id_marca]'");
$fila2=mysqli_fetch_array($registros2);
$registros3=mysqli_query($conexion,"select * from productos where id_producto='$_GET[id_producto]'"); 
$fila3=mysqli_fetch_array($registros3);

$registros4=mysqli_query($conexion,"select nombre from imagenes where id_producto='$_GET[id_producto]' && prioridad=1"); 
$fila4=mysqli_fetch_array($registros4);
$registros5=mysqli_query($conexion,"select nombre from imagenes where id_producto='$_GET[id_producto]' && prioridad=2"); 
$fila5=mysqli_fetch_array($registros5);
$registros6=mysqli_query($conexion,"select nombre from imagenes where id_producto='$_GET[id_producto]' && prioridad=3"); 
$fila6=mysqli_fetch_array($registros6);
?>
 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Productos</title>
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/normalizar.css">
<link rel="stylesheet" href="css/hover-min.css">
<link href='https://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="iconos/css/font-awesome.min.css">
<!-- comentarios -->
<link rel="stylesheet" href="comentarios/estilos_comentarios.css">
<!--comentario -->

<!-- --------------------------- stock -------------------------- -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.css">
<!-- --------------------------- stock -------------------------- -->

<style>
.ui-effects-transfer { 
border: 3px #666666 solid;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
background-image:url(administracion/productos/imagenes/<?php if(mysqli_num_rows($registros4)>0)echo $fila4['nombre']; else echo "no-disponible.jpg"; ?>);
opacity:0.8;
}
</style>

<!-- bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<!-- bootstrap -->

<!-- Empieza LightBox  -->
<link rel="stylesheet" href="lightbox/vlb_files1/vlightbox1.css" type="text/css" />
<link rel="stylesheet" href="lightbox/vlb_files1/visuallightbox.css" type="text/css" media="screen" />
<script src="lightbox/vlb_engine/visuallightbox.js" type="text/javascript"></script>
<script src="lightbox/vlb_engine/vlbdata1.js" type="text/javascript"></script>
<!-- Termina LightBox -->

<!-- comentarios -->
<!-- Start VideoLightBox.com HEAD section -->
<link rel="stylesheet" href="comentarios/index_videolb/videolightbox.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="comentarios/index_videolb/overlay-minimal.css"/>
<script src="comentarios/index_videolb/swfobject.js" type="text/javascript"></script>
<!-- End VideoLightBox.com HEAD section -->
<!-- comentarios -->

<script type="text/javascript">

function mostrar(){

 $("#texto").show("slow");	
 $("#b_mostrar").hide("fast");
 $("#b_ocultar").show("fast");	

}

function ocultar(){

 $("#texto").hide("slow");	
 $("#b_mostrar").show("fast");
 $("#b_ocultar").hide("fast");	

}

</script>


<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
<!-- End css3menu.com HEAD section -->

<audio id="player" src="compra/Caja-registradora.mp3"></audio>
</head>

<body>
<div class="cabecera"></div>
        
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

<?php
if($fila3["cantidad"]!=-2){
?>

<p class="fuente"><span style="color:red">Inicio</span><span style="color:#FFF"> -></span><span style="color:#F90"><?php echo utf8_encode($fila2['marca']); ?></span><span style="color:#FFF">-></span><span style=" color:#090"><?php echo utf8_encode($fila3['nombre']); ?></span></p>

</div>

<div style="margin:45px auto 0px auto; max-width:900px">
<div style="float:left; margin-right:20px">
<div id="a"><a class="vlightbox1" href="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros4)>0)echo $fila4['nombre']; else echo "no-disponible.jpg"; ?>" title="<?php echo utf8_encode($fila3['nombre']); ?>"><img width="330px" height="247px" src="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros4)>0)echo $fila4['nombre']; else echo "no-disponible.jpg"; ?>"/></a></div>
</br>
<a class="vlightbox1" href="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros5)>0)echo $fila5['nombre']; else echo "no-disponible.jpg"; ?>"><img width="160px" height="120px" src="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros5)>0)echo $fila5['nombre']; else echo "no-disponible.jpg"; ?>"/>&nbsp;</a>
<a class="vlightbox1" href="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros6)>0)echo $fila6['nombre']; else echo "no-disponible.jpg"; ?>"><img width="160px" height="120px" src="administracion/productos/imagenes/<?php if(mysqli_num_rows($registros6)>0)echo $fila6['nombre']; else echo "no-disponible.jpg"; ?>"/></a>
</div>
<p style="font-size:30px; font-family:'Ceviche One', cursive;"><?php echo utf8_encode($fila3['nombre']); ?></p>
<form name="formu_compra">
<span style="font-size:40px; font-family:'Ceviche One', cursive; color:#F00"><?php echo $fila3['precio']; ?> Pesos MX&nbsp;&nbsp;por&nbsp;&nbsp;

<input style="width:65px; color:#333" type="number" name="cantidad_producto" min="1" max="10" value="1">
<input type="hidden" name="nombre_producto" value="<?php echo utf8_encode($fila3['nombre']); ?>">
<input type="hidden" name="precio_producto" value="<?php echo $fila3['precio']; ?>">
<input type="hidden" name="id_producto" value="<?php echo $_GET["id_producto"]; ?>">
<!--<button type="button" onClick="volar()" class="btn btn-danger">COMPRAR YA !!</button>-->

<!-- ----------------stock-------------------------- -->
<?php
if($fila3["cantidad"]>0 || $fila3["cantidad"]==-1){
?>
	<button type="button" onClick="comprobar_stock('<?php echo $fila3["cantidad"]; ?>')" class="btn btn-danger">COMPRAR YA !!</button>
<?php
}else{ 

	echo "??Agotado!";
	
}
?>
<!-- ----------------stock-------------------------- -->

</span>
</form>

<!-- ----------------stock-------------------------- -->
<?php
if($fila3["cantidad"]<=10 && $fila3["cantidad"]>0){
	
	echo "<strong><span style='color:orange'>?? Quedan solo ".$fila3["cantidad"]." unidades !</span></strong>";
}
?>
<!-- ----------------stock-------------------------- -->

<p style="font-size:25px; font-family:'Ceviche One', cursive;">&nbsp;&nbsp;&nbsp;* Caracter??ticas:</p>
<div>
<?php
$array=explode(" ",utf8_encode($fila3['descripcion']));

if(count($array)<35){
	
	for($i=0;$i<count($array);$i++){
	
		echo $array[$i]." ";
	
	}
	
}

else{
	
	for($i=0;$i<35;$i++){
	
		echo $array[$i]." ";
	
		}
	echo "...";
 ?>
	</div>
	<div id="texto" style="display:none">
	<?php
	for($i=35;$i<count($array);$i++){
	
		echo $array[$i]." ";
	
		}

 	?>
</div>
</br>
<button id="b_mostrar" onClick="mostrar()" type="button" class="btn btn-success">Mostrar m??s...</button>
<div id="b_ocultar" style="display:none"><button onClick="ocultar()"  type="button" class="btn btn-danger">Mostrar menos...</button></div>
</div>
<?php
}
 ?>

<!-- comentarios -->
<?php 
include("comentarios/index_comentarios.php");
?>
<!-- comentarios -->

</div>
</div>
<?php
cerrarconexion();
?>

<div class="limpiar"></div>

</div>

<footer class="wow bounceInDown" data-wow-duration="1.5s"><p>Todos los derechos reservados tiendaonline.com</p></footer>

<?php
}
?>

<!-- ventana modal -->
<div style="margin-top:100px" class="modal fade" id="mostrar_ventana_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" id="i" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Inicio de Sesi??n</h4>
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
      	<a href="#" onclick="link_password()">He olvidado mi contrase??a</a>
      </div>
      
      <div style="padding:13px; display:none" id="link_password">
      	<form name="form_olvido_password">
      		<div class="form-group">
            	<label for="recipient-name" class="control-label">Email:</label>
            	<input type="text" name="email" class="form-control" id="recipient-name">
          	</div>
      	</form>
        <button type="button" onclick="recuperar_password()" class="btn btn-success">Recuperar Contrase??a</button>
      </div>
      
      <div class="modal-footer">
      
      <!-- aler contrase??a no correcta -->
      
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
<!-- comentarios -->
<script type="text/javascript" src="comentarios/comentarios.js"></script>
<!-- comentarios -->

<!-- --------------------------- stock -------------------------- -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.js"></script>
<!-- --------------------------- stock -------------------------- -->

</body>
</html>