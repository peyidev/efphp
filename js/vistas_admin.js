var vistas = {

    global : function(){

        validator.startValidations();



        $('#menu-control-lateral').click(function(){


            if(!$(this).hasClass('open')){

                $(this).addClass('open');
                $(this).find('.menu-control-arrow').removeClass('fa-chevron-right');
                $(this).find('.menu-control-arrow').addClass('fa-chevron-left');
                $(this).animate({"left" : "260px"});
                $('#main-menu-lateral').animate({"width" : "260px"});

            }else{
                $(this).removeClass('open');
                $(this).find('.menu-control-arrow').removeClass('fa-chevron-left');
                $(this).find('.menu-control-arrow').addClass('fa-chevron-right');
                $(this).animate({"left" : "0"});
                $('#main-menu-lateral').animate({"width" : "0px"});
            }

        });

	    $('.message-popup').dialog({"modal" : true});

        $(".date" ).datepicker({ dateFormat: 'yy-mm-dd' });

        //ephp/lib/Execute.php?e=Administrador/createAjaxTable
        var table = $('.title-general').attr('id');
        var extra = $('#extra-value').val();
        var main = $('#main-value').val();

        $(".table-admin-base").each(function(){

            var tabla = $(this).attr('id');
            tabla = tabla.split('-tabla-');
            if(typeof extra == "undefined" )
                if(typeof tabla[1] != "undefined" )
                    extra = tabla[1];

            tabla = tabla[0];



            $(this).DataTable({
                "order": [[ 0, "desc" ]],
                "processing": true,
                "serverSide": true,
                "ajax": ("../lib/Execute.php?e=Administrador/createAjaxTable/"  + tabla + "&extraValue=" + extra + "&mainValue=" + main)
            });

        });




        $('body').on("keyup",".ajax-search",function(){

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

                ajaxData('../lib/Execute.php?e=Dbo/ajaxSearch','GET',param,'true',function(json){

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

        $(".table-admin").on('click','.popup-admin',function(e){

            e.preventDefault();
            $('#table-detail').remove();

            var url = $(this).attr('href');
            ajaxData(url,'GET',{},'true',function(result){

                $(".table-admin-render").unbind();

                $('<div id="table-detail" title="Detalle">' + result + '</div>').dialog({
                    resizable: false,
                    height:500,
                    width:1000,
                    modal: true
                });

                $(".table-admin-render").DataTable({
                    "order": [[ 0, "desc" ]]
                });

                $('.selectpicker').selectpicker();
                $(".date" ).datepicker({ dateFormat: 'yy-mm-dd' });


            },"true");

        });
		
    },
    home : function(){

        /*Función default*/


    },

    lead_admin: function(){


        $(".table-admin").on('click','.si-style',function(e){

            alert("este sí");

        });

    },
    establecimiento_vista_detail : function(){

        $('.disabled').prop('disabled', true);
        $('.left-form-establecimiento .btn-primary').html("Activar edición");

        $('.left-form-establecimiento .btn-primary').click(function(e){

            e.preventDefault();
            $('.btn-primary').html("Actualizar");
            $('.dropdown-toggle').removeClass('disabled');
            $('.disabled').prop('disabled', false);
            $('.selectpicker').prop('disabled', false);

            $('.btn-primary').unbind();
            $('.btn-primary').click(function(){

                $('.validation-form').submit();

            });


        });

    },
    llamada_vista : function(){

        var d = new Date();
        var year = d.getFullYear() + "";
        year = year.substr(2,2);
        var tmp_folio = Math.floor((Math.random() * 1000) + 1);
        var folio =  utils.pad(year,2) + "" + utils.pad(d.getMonth(),2) + "" + utils.pad(d.getUTCDate(),2) + "" + utils.pad(d.getHours(),2) + "" + utils.pad(tmp_folio,4) ;

        $('[name="folio"]').hide();
        $('[name="id_motivo"]').parent().parent().hide();
        $('button[type="submit"]').hide();

        $('[name="id_tipo_llamada"]').change(function () {

            var val = $(this).find('option[value="' + $(this).val() + '"]').text();

            if(val == "Llamada válida"){

                $('.disabled').prop('disabled', false);
                $('[name="id_proyecto"]').prop('disabled', false);

                $('.disabled').removeClass('disabled');
                $('button[type="submit"]').hide();


            }else{

                $('button[type="submit"]').show();
                $('[name="id_proyecto"]').prop('disabled', true);

            }
        });


        $('[name="id_proyecto"]').change(function () {
            $('[name="folio"]').val(folio);
            $('#folio').remove();
            $('[name="id_motivo"]').parent().parent().parent().show();
            $('[name="folio"]').parent().append("<h2 id='folio'>" + folio + "</h2>");

        });


        $('[name="id_motivo"]').change(function () {

            var params = {

                "folio" : $('[name="folio"]').val(),
                "id_proyecto" : $('[name="id_proyecto"]').val(),
                "id_motivo" : $('[name="id_motivo"]').val(),
                "id_admin" : $('[name="id_admin"]').val()

            };

            console.log(params);
            ajaxData('../lib/Execute.php?e=Medios/insertLlamada&table-insert=llamada','POST',params,'false',function(json){

                $('#call-form').html(json);
                $('.selectpicker').selectpicker();
                $(".date" ).datepicker({ dateFormat: 'yy-mm-dd' });

            },"true");

        });
        $('[name="id_proyecto"]').prop('disabled', true);


    },

    llamada_vista_seguimiento : function(){


        $('#proyecto-select').change(function(){

            var url = window.location.href;
            url = utils.updateQueryStringParameter(url,"proyecto",$(this).val());
            console.log(url);
            window.location.href = url;


        });


    },
    sucursal_vista_calidad : function(){

        $(".table-admin").on('click','.completar',function(e){

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


            $( '<div id="dialog-confirm" title="Completar ruta"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Deseas dar por completada la ruta?</p></div>' ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "Completar ruta": function() {

                        ajaxData('../lib/Execute.php?e=Medios/completarRuta','GET',param,'false',function(json){

                            console.log(json);
                        },"true");

                    },
                    Cancelar: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });

        });

    }

};