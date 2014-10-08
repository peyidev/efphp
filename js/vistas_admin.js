var vistas = {

    global : function(){
	
        $( ".date" ).datepicker();
		$(".table-admin").DataTable();
		
		$(".delete-admin").click(function(e){
			
			e.preventDefault();
			var id = $(this).attr("href");
			id = id.split("&id=");
			console.log(id);
			var tabla = id[0].split("?s=");
			tabla = tabla[1];
			id = id[1];
			
			var param = {
				table : tabla,
				id : id
			};
			

			$( '<div id="dialog-confirm" title="¿Deseas eliminar el registro?"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Este registro seré eliminado y no podrá ser recuperado. ¿Estás seguro?</p></div>' ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					"Eliminar el registro": function() {
						
						ajaxData('../lib/Execute.php?e=Administrador/deleteRow','GET',param,'false',function(json){

							 location.reload();
				      });
						
					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
			});
			
		});
		
    },
    home : function(){

        /*Función default*/


    }

};