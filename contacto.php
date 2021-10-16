<?php
session_start();
include("php/conexion.php");
$form_path='formulario/formoid_files/formoid1/form.php'; require_once $form_path;
$registros1=mysqli_query($conexion,"SELECT * FROM marcas ORDER BY marca ASC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Zona de Contacto</title>
<link rel="stylesheet" href="iconos/css/font-awesome.min.css">
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/normalizar.css">
<link href='https://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Menu_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
<!-- End css3menu.com HEAD section -->
    
</head>

<body>
<header>
<div class="cabecera"></div>

    
<?php 
if(isset($_SESSION['nombre_cliente']) || isset($_COOKIE['nombre_cliente'])){
?>
<div style="max-width:920px; margin:20px auto -50px auto; padding-left:20px">
	
		<p style="font-family:'Ceviche One',cursive; font-size:24px"><a style=" 	 		text-decoration:none" href="clientes/zona_clientes"><span style="color:  		#F90">Bienvenido/a</span><span style="color:#FFF">
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
  
</header>
<div class="main">
	<div style="margin-top:100px; margin-bottom:30px">
		{{Formoid}}
    </div>
</div>

<footer style="margin-top:-10px" class="wow bounceInDown" data-wow-duration="1.5s">
	<p>Todos los derechos reservados tiendaonline.com</p>
</footer>

</body>
</html>