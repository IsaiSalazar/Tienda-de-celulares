<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Zona privada</title>

<link rel="stylesheet" href="../../css/normalizar.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="zona_clientes.css">
<link href='https://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../iconos/css/font-awesome.min.css">
<link rel="stylesheet" href="../../css/hover-min.css">
<!-- bootstrap -->
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>


<script src="../../javascript/bootstrap.min.js"></script>
<!-- bootstrap -->

<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="../../CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<!-- End css3menu.com HEAD section -->
</head>
<body>

<header>
<div class="cabecera"></div>
<nav>
<!-- Start css3menu.com BODY section -->
<nav class="navbar navbar-expand-lg navbar-light " id="main_navbar" style="background-color: #EBF9FA;"  >
        <img class="logo" href="#" style=" position:absolute;margin-top:5px;left:40%;width:180px; height:70px" src="../../imagenes/logo.png">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color: #EBF9FA;">
                    <ul class="navbar-nav mr-auto">
                    
                            <a class="nav-link" href="../../index.php">Inicio<span class="sr-only">(current)</span></a>
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
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
<!-- End css3menu.com BODY section -->
</nav>

<div style="max-width:900px;margin: 20px auto 0px auto;">
<p style="font-family:'Ceviche One',cursive; font-size:24px"><a style=" text-decoration:none" href="#"><span style="color:black">Bienvenido/a</span><span style="color:black">
<?php
	if(isset($_SESSION['nombre_cliente'])) 
		echo $_SESSION['nombre_cliente'];

	if(!isset($_SESSION['nombre_cliente']) && isset($_COOKIE['nombre_cliente'])) 
		echo $_COOKIE['nombre_cliente'];
?>
</span></a></p>
</div>



</header>

<div class="main">

 <!-- contenido -->
	<div id="botones" style=" max-width:510px;margin: 70px auto 0px auto;">
		<div id="boton" onClick="ver_modificar_datos()" class="hvr-bounce-to-left" style=" width:150px; height:50px; background-color:#F90; margin-right:30px; border-radius:10px; cursor:pointer; text-align:center; padding: 10px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; float:left"><strong>VER / MODIFICAR DATOS</strong>
    		<div style="color:#FFF;font-size:80px; margin-top:-20px"><i class="fa fa-search" aria-hidden="true"></i>
        	</div>
    	</div>
		<div onClick="ver_pedidos()" class="hvr-bounce-to-left" style="width:150px; height:50px; background-color: blue; margin-right:30px;border-radius:10px;cursor:pointer; text-align:center; padding: 10px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;float:left"><strong>VER PEDIDOS</strong>
    		<div style="color:#FFF;font-size:80px"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </div>
		</div>
		
        <a style="text-decoration:none; color:#000" href="destruir_cookie_sesion.php">
		<div class="hvr-bounce-to-left" style=" width:150px; height:50px; background-color: yellow;border-radius:10px; cursor:pointer; text-align:center; padding: 10px; font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; float:left"><strong>DESCONECTAR</strong>
    		<div style="color:#FFF;font-size:80px"><i class="fa fa-power-off" aria-hidden="true"></i>
            </div>
    	</div>
		</a>
		
		
	</div>
	<div style="clear:both"></div> 
<center><img id="carga" style="display:none; margin-top:50px" src="../../imagenes/cargando.gif"> </center>
<div  style="display:none;" id="div_respuesta"></div> 
<div  style="display:none;" id="div_pedidos"></div>   
</div>

<footer><p>Todos los derechos reservados tiendaonline.com</p></footer>

</body>

<script type="text/javascript" src="zona_clientes.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</html>