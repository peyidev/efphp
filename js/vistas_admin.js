var vistas = {

    global : function(){

        validator.startValidations();

	    $('.message-popup').dialog({"modal" : true});

        $(".date" ).datepicker({ dateFormat: 'yy-mm-dd' });

        //ephp/lib/Execute.php?e=Administrador/createAjaxTable
        var table = $('.title-general').attr('id');
		$(".table-admin").DataTable({
            "order": [[ 0, "desc" ]],
            "processing": true,
            "serverSide": true,
            "ajax": ("../lib/Execute.php?e=Administrador/createAjaxTable/"  + table)
        });

        $('.ajax-search').keyup(function(){

            var cuantos = $(this).val();
            var padre = $(this).parent();

            if(cuantos.length >= 5){


                var table = $(this).attr('name');
                table = table.split("_");
                table = table[1];

                var param = {
                    "q" : $(this).val(),
                    "table" : table
                };

                ajaxData('../lib/Execute.php?e=Utils/ajaxSearch','GET',param,'true',function(json){

                    $result = "<div class='result-query' id='result-" + table + "'>";

                    $.each(json,function(i,val){

                        $result += "<p class='result-query-item'>";

                        $.each(val, function(j,valInt){

                            var idTmp = j.split("nombre");

                            if(j == "id"){
                                $result += "<input type='hidden' class='result-hidden' value='" + valInt + "' />";
                            }

                            if(idTmp.length > 1){
                                $result += valInt + " ";
                            }

                        });

                        $result += "</p>";

                    });

                    $result += "</div>";
                    var selector = '#result-' + table;
                    $(padre).find(selector).remove();
                    $(padre).append($result);

                    $(selector).find('.result-query-item').click(function(){

                        $(padre).find(selector).remove();
                        var valor = $(this).find('.result-hidden').val();

                        $(padre).find('.ajax-search').val(valor);

                    });


                });

            }

        });

		$(".table-admin").on('click','.delete-admin',function(e){
			
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

        $(".cms-style").wysihtml5({
            toolbar: {
                fa: true,
                html: true
            }
        });

        $('.add-new-record').click(function(){

            $('.admin-right-column').toggleClass('admin-only-right');
            $('.admin-left-column').toggleClass('admin-only-left');
            $('.admin-generic').toggleClass('admin-only-generic');

        });
		
    },
    home : function(){

        /*Función default*/


    }

};