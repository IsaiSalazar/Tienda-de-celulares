<?php 
session_start();

	if(isset($_SESSION['administrador'])){
	
	
		$idmarca=$_POST['idmarca'];
		include('../../php/conexion.php');
		$registros1=mysqli_query($conexion,"select id_producto from productos where id_categoria='$idmarca'");
		while($fila1=mysqli_fetch_array($registros1)){
		
			$registros2=mysqli_query($conexion,"select nombre from imagenes where id_producto='$fila1[id_producto]'");
			while($fila2=mysqli_fetch_array($registros2)){
				
				unlink("../productos/imagenes/".$fila2['nombre']);	
				
			}
			
			mysqli_query($conexion,"delete from imagenes where id_producto='$fila1[id_producto]'");
			mysqli_query($conexion,"delete from productos where id_producto='$fila1[id_producto]'");	
			
		
		}
		mysqli_query($conexion,"delete from categorias where id='$idmarca'");
		mysqli_query($conexion,"DELETE FROM comentarios WHERE id_categoria='$idmarca'");
		cerrarconexion();
	
	
	
	}
	
	else {
		
		header('location:../index.html');
		
		
		}



?>