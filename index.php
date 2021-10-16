<?php
    session_start();
    include('php/conexion.php');
    $registros=mysqli_query($conexion,"select * from marcas order by marca asc");
    $registros2=mysqli_query($conexion,"select id_producto,nombre, precio,id_marca,cantidad from productos where inicio=1 AND cantidad!=-2 limit 0,12");
    
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda de Celulares</title>
    <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css">
    
    <link rel="stylesheet" type="text/css" href="css/estilos.css">  
    <link rel="stylesheet" href="css/bootnavbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/font-awesome.css">

	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script src="js/main.js"></script>
</head>
<body>

    <header >
    <?php
if(isset($_GET['alert']) && $_GET['alert']=="validado") {
?>
<div style="text-align:center; margin-bottom:1px" class="alert alert-success alert-dismissible" role="alert">
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span 			    aria-hidden="true">&times;</span></button>
    <p class="centrar"><strong>Se ha completado su registro correctamente. Inicie sesión para poder comprar.</strong></p>
    </div>
<?php  
}
if(isset($_GET['compra_realizada'])) {
?>
	<div style="text-align:center; margin-bottom:1px" class="alert alert-success alert-dismissible" role="alert">
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span 			    aria-hidden="true">&times;</span></button>
    	<p style="color: #666; font-weight:bold" class="centrar">Compra realizada con éxito<br>Para más detalles métase en su zona privada y revise sus pedidos. Gracias :).</p>
    </div>
<?php
}
// paypal
if(isset($_GET['compra_cancelada'])) {
?>
	<div style="text-align:center; margin-bottom:1px" class="alert alert-danger alert-dismissible" role="alert">
 		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span 			    aria-hidden="true">&times;</span></button>
    	<p style="color: #666; font-weight:bold" class="centrar">Compra cancelada</p>
    </div>
<?php
}
// paypal
?>
        <div class="cabecera"></div>
        
        <nav class="navbar navbar-expand-lg navbar-light " id="main_navbar" style="background-color: #EBF9FA;"  >
        <img class="logo" href="#" style=" position:absolute;margin-top:5px;left:40%;width:180px; height:70px" src="imagenes/logo.png">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color: #EBF9FA;">
                    <ul class="navbar-nav mr-auto">
                    
                            <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
                        </li>
                        <?php 

                        if(isset($_SESSION['nombre_cliente']) || isset($_COOKIE['nombre_cliente'])){

                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="clientes/zona_clientes/index.php">Cuenta</a>
                        </li>
                        <?php
                        }
                        else{
                            ?>
                            <li class="nav-item">
                            <a class="nav-link" href="#" onclick="mostrar_ventana_modal()">Iniciar Sesion</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="clientes/form_registro_clientes.php" >Registro</a>
                            </li>
                            <?php
                        }
                        ?>

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
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="buscador.php" method="post">
                    <input class="input1" type="search" name="buscar" placeholder="Buscar..."/>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
            <div class="flexslider">
                    <ul class="slides">
            
                        <li>
                            <img src="imagenes/cel.jpg" alt="">
                            <section class="caption">
                                
                            </section>
                        </li>
            
                        <li>
                            <img src="imagenes/promocion.jpg" alt="">
                            <section class="caption">
                                
                            </section>
                        </li>
            
                        <li>
                            <img src="imagenes/promo.png" alt="">
                            <section class="caption">
                                
                            </section>
                        </li>
            
                    </ul>
                </div>
    </header>

    <div class="main">
    <?php
    while($fila2=mysqli_fetch_array($registros2)){
	$registros3=mysqli_query($conexion,"select nombre from imagenes where id_producto='$fila2[id_producto]' and prioridad=1");
		$fila3=mysqli_fetch_array($registros3);
    ?>
    <a href="detalleproducto.php?id_marca=<?php echo $fila2['id_marca']; ?>&id_producto=<?php echo $fila2['id_producto']; ?>">
    <div id="i" class="productosmain hvr-buzz-out"><img src="Administracion/productos/imagenes/<?php 
    if(mysqli_num_rows($registros3)>0)echo $fila3['nombre']; else echo "no-disponible.jpg"; ?>" width="100%" alt="portatil1">
    <div class="precio"><?php echo $fila2['nombre']; ?></div>
    </div></a>
    <?php
    }
cerrarconexion();
?>
        <div class="limpiar"></div>
    </div>



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


<div id="b"  class="carrito">
	<div  style=" width:50px; height:120px; float:left; padding:4px; background-color:#333; border-radius:10px 0px 0px 10px; margin-left:-50px; cursor: pointer">
    		
    		<i style=" margin-top:33px; margin-left:200px; color:#f33; font-size:35px" class="fa fa-shopping-basket" aria-hidden="true"></i>  
      			
    </div>
    <div style="height:200px; padding:4px; overflow:auto" id="mostrar_compra">
        
    </div>
</div>
<footer>
<!-- mibew button --><a id="mibew-agent-button" href="/TiendadeCelulares/chat/chat?locale=es" target="_blank" onclick="Mibew.Objects.ChatPopups['5dea6100a31fd966'].open();return false;"><img src="/TiendadeCelulares/chat/b?i=mblue&amp;lang=es" border="0" alt="" /></a><script type="text/javascript" src="/TiendadeCelulares/chat/js/compiled/chat_popup.js"></script><script type="text/javascript">Mibew.ChatPopup.init({"id":"5dea6100a31fd966","url":"\/TiendadeCelulares\/chat\/chat?locale=es","preferIFrame":true,"modSecurity":false,"forceSecure":false,"style":"","width":640,"height":480,"resizable":true,"styleLoader":"\/TiendadeCelulares\/chat\/chat\/style\/popup"});</script><!-- / mibew button -->
    
<p>Todos los derechos reservadoss</p></footer>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="clientes/inicio_de_sesion/inicio_de_sesion.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="compra/compra.js"></script>
    <script src="js/bootnavbar.js" ></script>
    <script>
        $(function () {
            $('#main_navbar').bootnavbar();
        })
    </script>
<script src="js/bootnavbar.js" ></script>
</body>
</html>