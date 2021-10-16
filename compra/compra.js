//----------------------- stock ---------------------------//
function comprobar_stock(cantidad){
	
	var id_producto=document.formu_compra.id_producto.value;
	var cantidad_producto=document.formu_compra.cantidad_producto.value;
	
	$.ajax({
					
		type:"POST",
		url:"compra/comprobar_stock.php",
		data:{"id_producto":id_producto,"cantidad_producto":cantidad_producto},
	
			success:function(respuesta){
				
				if(respuesta=="exito"){
				
					volar();
				
				}else{
					
					
					swal({
  						title: '¡Imposible!',
  						text: 'Quedan '+cantidad+' unidades en nuestros almacenes. Gracias.',
  						type: 'error',
  						confirmButtonText: 'De acuerdo'
					})				
					//alert("Debe elegir una cantidad menor ya que no hay suficiente stock para este producto en nuestros almacenes. Gracias.");
					
				}
				
			}
				
	});
		
}
//----------------------- stock ---------------------------//

function volar(){
	
	$("#a").effect('transfer', { to: $('#b') }, 500,aniadir_productos);
	
	
}

function aniadir_productos(){
	
	var nombre_producto=document.formu_compra.nombre_producto.value;
	var precio_producto=document.formu_compra.precio_producto.value;
	var cantidad_producto=document.formu_compra.cantidad_producto.value;
	// stock
	var id_producto=document.formu_compra.id_producto.value;
	// stock

	$("#b").effect("bounce",900);
	document.getElementById('player').play();
	
	$.ajax({
					
		type:"POST",
		url:"compra/mostrar_compra.php",
		data:{"nombre_producto":nombre_producto,"precio_producto":precio_producto,"cantidad_producto":cantidad_producto,"id_producto":id_producto},
			
		success:function(respuesta){
				
			$("#mostrar_compra").html(respuesta);
			$("#mostrar_compra").show("fast");
			
		}
			
	});
				
	//$("#mostrar_compra").load("compra/mostrar_compra.php");

	
	
}

$(function(){
     
     	$.ajax({
			
			url:"compra/mostrar_compra.php",
			
			success:function(respuesta){
				
				$("#mostrar_compra").html(respuesta);
				$("#mostrar_compra").show("fast");
			
			
			}
			
			
		});
		
     
	 
});


function eliminar_producto(indice){
	
		
		$.ajax({
			
			url:"compra/eliminar.php",
			data:{"indice":indice},
			
			beforeSend:function(){
				
				$("#n"+indice).show("fast");
				
				
			},

			
			
			success:function(respuesta){
				
				//$("#mostrar_compra").load("compra/mostrar_compra.php");
				
				$.ajax({
			
					url:"compra/mostrar_compra.php",
					
			
					success:function(respuesta){
						
						
						$("#mostrar_compra").html(respuesta);
						$("#mostrar_compra").show("fast");
						
					}			
				});		
			
			}
			
			
		});
	
	
	
	}



