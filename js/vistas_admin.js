var vistas = {

    global          : function(){

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

            var order = 0;
            if($(this).find('thead tr th:contains("updated at")').text() == "updated at"){

                order = $(this).find('thead tr th:contains("updated at")').index();

            }

            $(this).DataTable({
                "order": [[ order, "desc" ]],
                "processing": true,
                "serverSide": true,
                "ajax": ("../lib/Execute.php?e=Administrador/createAjaxTable/"  + tabla + "&extraValue=" + extra + "&mainValue=" + main)
            });

        });




        $('body').on("keyup",".ajax-search",function(){

            var cuantos = $(this).val();
            var padre = $(this).parent();

            if(cuantos.length >= 4){


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


            $( '<div id="dialog-confirm" title="Confirm Action!"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This action will permanently delete this record. Are you Sure?</p></div>' ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "Delete": function() {

                        ajaxData('../lib/Execute.php?e=Administrador/deleteRow','GET',param,'false',function(json){

                            location.reload();
                        });

                    },
                    Cancel: function() {
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
    home            : function(){

        /*Función default*/


    },
    building_vista  : function(){

        $('.table-admin').on('click','.edit-inplace',function(e){

            e.preventDefault();



            $('.gallery-left').empty();
            $('.gallery-right').empty();


            var params = $(this).attr('id');

            reloadPlaces(params,"update");

            $('.close-gallery').click(function(){

                $('.places-opt').remove();

            });


            $('.gallery-right').fadeIn('slow');
            $('.gallery-left').toggleClass('hide-insert');



        });


        $('.table-admin').on('click','.edit-places',function(e){

            e.preventDefault();
            $('.places-opt').remove();
            $('.gallery-opt').remove();

            $('<tr class="places-opt"><td class="places-opt-canvas" colspan="10"><div class="close-gallery"><i class="fa fa-close fa-fw fa-2x"></i></div><div class="gallery-left"></div><div class="gallery-right"></div></td></tr>').insertAfter($(this).parent().parent());

            var params = $(this).attr('id');
            reloadPlaces(params,"insert");

            $('.close-gallery').click(function(){

                $('.places-opt').remove();

            });

        });


        $('.table-admin').on('click','.edit-gallery',function(e){

            e.preventDefault();
            $('.places-opt').remove();
            $('.gallery-opt').remove();

            $('<tr class="gallery-opt"><td class="gallery-opt-canvas" colspan="10"><div class="close-gallery"><i class="fa fa-close fa-fw fa-2x"></i></div><div class="gallery-left"></div><div class="gallery-right"></div></td></tr>').insertAfter($(this).parent().parent());

            var params = $(this).attr('id');
            reloadPictures(params);

            $('.close-gallery').click(function(){

                $('.gallery-opt').remove();

            });

            $('.gallery-opt-canvas .gallery-right').append('<form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>');
            $('.dropzone').dropzone({

                queuecomplete:function(){

                    reloadPictures(params);

                },url : '../lib/Execute.php?e=Mhmproperties/uploadGallery/' + params
            });

        });


        $('.table-admin').on('click','.edit-floorplans',function(e){

            e.preventDefault();
            $('.places-opt').remove();
            $('.gallery-opt').remove();

            $('<tr class="gallery-opt"><td class="gallery-opt-canvas" colspan="10"><div class="close-gallery"><i class="fa fa-close fa-fw fa-2x"></i></div><div class="gallery-left"></div><div class="gallery-right"></div></td></tr>').insertAfter($(this).parent().parent());

            var params = $(this).attr('id');
            reloadPlans(params);

            $('.close-gallery').click(function(){

                $('.gallery-opt').remove();

            });

            $('.gallery-opt-canvas .gallery-right').append('<form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>');
            $('.dropzone').dropzone({

                queuecomplete:function(){

                    reloadPlans(params);

                },url : '../lib/Execute.php?e=Mhmproperties/uploadFloorplans/' + params
            });

        });


        $('.table-admin').on('click','.insert-room',function(e) {

            e.preventDefault();
            $('.cancel-room').fadeIn('slow');
            $('.insert-room').fadeOut('fast');
            $('.gallery-right').fadeIn('slow');

        });


        $('.table-admin').on('click','.cancel-room',function(e) {

          e.preventDefault();
          $('.cancel-room').fadeOut('fast');
          $('.insert-room').fadeIn('slow');
          $('.gallery-right').fadeOut('fast');
          $('.validation-form').trigger('reset');

        });

        function reloadPlaces(params,type){

            var url = '../lib/Execute.php?e=Mhmproperties/getPlacesAdmin/';

            if(type == "update")
                url = '../lib/Execute.php?e=Mhmproperties/getPlacesUpdateAdmin/';


            ajaxData(url + params,'GET',{},'true',function(json){

                $('.places-opt-canvas .gallery-left').empty();

                $('.gallery-right').html(json['result']);
                $('.gallery-right .selectpicker').selectpicker();
                $('.input .form-control[name="id_building"]').parent().parent().parent().remove();
                $('.gallery-right .form-operation').html('<i class="fa fa-search-plus fa-plus-square-o"></i> Insert new room type');
                $('.places-opt-canvas .gallery-left').append("<table  class='table table-striped' ></table>" +
                                                              "<div class='insert-room room-btn'><i class='fa fa-plus'></i>Add</div>" +
                                                              "<div class='cancel-room room-btn'><i class='fa fa-times'></i>Cancel</div>");
                var parent = "";

                for(var x = 0; x < json['rows'].length; x++){

                    //json['rows'][x]
                    $('.places-opt-canvas .gallery-left .table').prepend("<tbody><tr><td>" + json['rows'][x]['nombre'] + "</td><td>" + json['rows'][x]['pricefrom'] + "</td><td>" + json['rows'][x]['priceto'] + "</td><td>" + json['rows'][x]['order_place'] + "</td><td><a href='?s=place-update&id=" + json['rows'][x]['id'] + "' id='" + json['rows'][x]['id_building'] + "-" + json['rows'][x]['id'] + "' class='edit-inplace center-data'><i class='fa fa-pencil fa-fw fa-2x'></i></a></td><td><a href='?s=place&id=" + json['rows'][x]['id'] + "' class='delete-admin center-data'><i class='fa fa-close fa-fw fa-2x'></i></a></td></tr></tbody>");
                    parent = json['rows'][x]['id_building'];

                }

                if(parent == '')
                  parent = params;

                $('.gallery-right .validation-form').append('<input type="hidden" name="id_building" value="' + parent + '" />');


                $('.places-opt-canvas .gallery-left .table').prepend('<thead><tr><th>Name</th><th>Price from</th><th>Price to</th><th>Display order</th><th>Edit</th><th>Delete</th></tr></thead>');




            });

        }

        function reloadPlans(params){
            ajaxData('../lib/Execute.php?e=Mhmproperties/getPlans/' + params,'GET',{},'true',function(json){

                $('.gallery-opt-canvas .gallery-left').empty();

                for(var x = 0; x < json.length; x++){


                    $('.gallery-opt-canvas .gallery-left').append("<div class='gallery-element' id='img-" + json[x]['id'] + "'><img src='../" + json[x]['img_building'] + "' />" +
                    "<span class='gallery-order'>"
                    +  json[x]['order_img'] +
                    "<a href='?s=gallery_floorplans&id=" + json[x]['id'] + "' class='delete-admin delete-mini-pic'><i class='fa fa-close fa-fw close-img-cross'></i></a>" +
                    "</span>" +
                    "</div>");

                }

                $('.gallery-opt-canvas .gallery-left').sortable({
                    out: function( event, ui ) {
                        var moved = ui.item.attr('id');
                        var next = ui.item.next('.gallery-element').attr('id');
                        paramsOrder = moved + "|" + next + "|" + params;

                        ajaxData('../lib/Execute.php?e=Mhmproperties/updateOrderPlans/' + paramsOrder,'GET',{},'true',function(json){

                            reloadPlans(params);

                        });

                    }
                });



            });


        }
        function reloadPictures(params){


            ajaxData('../lib/Execute.php?e=Mhmproperties/getGallery/' + params,'GET',{},'true',function(json){

                $('.gallery-opt-canvas .gallery-left').empty();

                for(var x = 0; x < json.length; x++){


                    $('.gallery-opt-canvas .gallery-left').append("<div class='gallery-element' id='img-" + json[x]['id'] + "'><img src='../" + json[x]['img_building'] + "' />" +
                        "<span class='gallery-order'>"
                            +  json[x]['order_img'] +
                            "<a href='?s=gallery_building&id=" + json[x]['id'] + "' class='delete-admin delete-mini-pic'><i class='fa fa-close fa-fw close-img-cross'></i></a>" +
                        "</span>" +
                    "</div>");

                }

                $('.gallery-opt-canvas .gallery-left').sortable({
                    out: function( event, ui ) {
                        var moved = ui.item.attr('id');
                        var next = ui.item.next('.gallery-element').attr('id');
                        paramsOrder = moved + "|" + next + "|" + params;

                        ajaxData('../lib/Execute.php?e=Mhmproperties/updateOrder/' + paramsOrder,'GET',{},'true',function(json){

                            reloadPictures(params);

                        });

                    }
                });



            });

        }

    },
    building_update_vista : function(){

        $('.add-new-record-update a').attr('href','?s=building-vista');


    },
    moveinreports   : function(){

      var url = '../lib/Execute.php?e=Mhmproperties/getAllMoveInReports/';
      var urlFilter = '../lib/Execute.php?e=Mhmproperties/getMoveInReportsFilter/';
      var urlSave = '../lib/Execute.php?e=Mhmproperties/updateReportById/';
      var urlRemove = '../lib/Execute.php?e=Mhmproperties/removeReportById/';
      var urlComplete = '../lib/Execute.php?e=Mhmproperties/completeTodoById/';
      var urlCompleteRep = '../lib/Execute.php?e=Mhmproperties/completeRepById/';
      var globalResultado = [];
      var objectToEditIndex;
      var parentton;


      var tableHtmlBaseIni = '<table id="movein" class="display" cellspacing="0" width="100%"><thead><tr><th class="hide-onedit">Name</th><th>Location</th><th>Apt</th><th class="hide-onedit">Date</th><th>Status</th><th class="hide-onedit">Hereby Tendered</th><th>Actions</th></tr></thead><tfoot><tr><th class="hide-onedit">Name</th><th>Location</th><th>Apt</th><th class="hide-onedit">Date</th><th>Status</th><th class="hide-onedit">Hereby Tendered</th><th>Actions</th></tr></tfoot><tbody>';

      var trIn = '<tr>';
      var tdIn = '<td>';
      var tableHtmlBaseMid = '';
      var tableHtmlBaseMidRep = '';
      var tdFi = '</td>';
      var trFi = '</tr>';
      var tableHtmlBaseFin = '</tbody></table>';


      //Table 1
      $.ajax(
        {type:"GET",
          url:url,
          data:{},
          success: function(json)
          {
            var resultado = $.parseJSON(json);

            for(var ind in resultado )
              globalResultado[resultado[ind].id] = resultado[ind];

            for(var obj in globalResultado )
            {
              var item = globalResultado[obj];
              tableHtmlBaseMid += trIn;
                tableHtmlBaseMid += '<td class="hide-onedit">' + item.first_name + ' ' + item.last_name + tdFi;
                tableHtmlBaseMid += tdIn + item.location + tdFi;
                tableHtmlBaseMid += tdIn + item.apt + tdFi;
                tableHtmlBaseMid += '<td class="hide-onedit">' + item.updated_at + tdFi;
                tableHtmlBaseMid += tdIn + item.status + tdFi;
                tableHtmlBaseMid += '<td class="hide-onedit">' + item.hereby_name + tdFi;
                tableHtmlBaseMid += tdIn + '<i class="fa fa-pencil btn btn-primary editReportByAttr" title="Edit Report" attr="'+obj+'"></i>';
                tableHtmlBaseMid += '<i class="fa fa-file-pdf-o btn btn-warning m-l-sm exportPdf" title="Export to PDF" attr="'+obj+'"></i>';
                tableHtmlBaseMid += '<i class="fa fa-check btn btn-success m-l-sm completeRepByAttr" title="Complete" attr="'+obj+'"></i>';
                tableHtmlBaseMid += '<i class="fa fa-times btn btn-danger m-l-sm removeReportByAttr" title="Remove Report" attr="'+obj+'"></i>' + tdFi;
              tableHtmlBaseMid += trFi;

            }

            $('.tableDinamica').html(tableHtmlBaseIni + tableHtmlBaseMid + tableHtmlBaseFin);
            $('#movein').DataTable({"order": [[ 3, "desc" ]]});

          }
        }
      );


      //Table 2
      $.ajax(
        {type:"GET",
          url:urlFilter,
          data:{},
          success: function(json)
          {
            var tableHtmlBaseIniSec = '<table id="movein-rep" class="display" cellspacing="0" width="100%"><thead><tr>' +
              '<th class="hide-onedit">Location</th>' +
              '<th>Apt</th>' +
              '<th class="hide-onedit">Date</th>' +
              '<th>Zone</th>' +
              '<th>Who</th>' +
              '<th>Comment</th>' +
              '<th>Repair Status</th>' +
              '<th>Actions</th>' +
              '</tr></thead><tbody>';

            var resultado = $.parseJSON(json);
            var fixResult = [];

            for(var ind in resultado )
              fixResult[resultado[ind].id] = resultado[ind];

            for(var obj in fixResult )
            {
              var item = fixResult[obj];
              tableHtmlBaseMidRep += trIn;
              tableHtmlBaseMidRep += tdIn + item.address + tdFi;
              tableHtmlBaseMidRep += tdIn + item.apt + tdFi;
              tableHtmlBaseMidRep += '<td class="hide-onedit">' + item.created_at + tdFi;
              tableHtmlBaseMidRep += tdIn + item.location + tdFi;
              tableHtmlBaseMidRep += tdIn + item.who + tdFi;
              tableHtmlBaseMidRep += tdIn + item.comment + tdFi;
              tableHtmlBaseMidRep += tdIn + item.repair_status + tdFi;

              tableHtmlBaseMidRep += tdIn + '<i class="fa fa-check btn btn-success completeTask" title="Complete" attr="'+obj+'"></i>' + tdFi;
              tableHtmlBaseMidRep += trFi;

            }
            $('.tableDinamica-2').html(tableHtmlBaseIniSec + tableHtmlBaseMidRep + tableHtmlBaseFin);
            $('#movein-rep').DataTable({"order": [[ 0, "desc" ]]});

          }
        }
      );

      $('.tableDinamica-2').on('click', '.completeTask',        function(e){
        var conf = confirm("Confirm this action");
        if (conf == true) {
          var todoId = $(this).attr('attr');

          $.ajax({
            type: "GET", url: urlComplete, data: {'id' : todoId}, success: function (json) {
              if(json.trim() == 'OK')
              {
                location.reload();
              }
            }
          });
        } else {
          return;
        }

      });
      $('.tableDinamica').on('click',   '.editReportByAttr',    function(e){
        cancelEdit();

        $('#main_content').addClass('edit-mode-report');
        $('#edit_content').addClass('edit-mode-report-big');
        $('#edit_content').removeClass('edit-report');

        objectToEditIndex = $(this).attr('attr');
        parentton = $(this).closest('tr');
        parentton.addClass('background-obvio');



        injectData(globalResultado[objectToEditIndex]);

      });
      $('.tableDinamica').on('click',   '.completeRepByAttr',   function(e){
        var conf = confirm("Confirm this action");
        if (conf == true) {
          cancelEdit();

          var todoId = $(this).attr('attr');

          $.ajax({
            type: "GET", url: urlCompleteRep, data: {'id' : todoId}, success: function (json) {
              if(json.trim() == 'OK')
              {
                location.reload();
              }
            }
          });
        } else {
          return;
        }

      });
      $('.tableDinamica').on('click',   '.exportPdf',           function(e){

        $('#main_content').addClass('edit-mode-report');
        $('#edit_content').addClass('edit-mode-report-big');
        $('#edit_content').removeClass('edit-report');

        objectToEditIndex = $(this).attr('attr');
        parentton = $(this).closest('tr');
        parentton.addClass('background-obvio');

        injectData(globalResultado[objectToEditIndex]);

        var pdf = new jsPDF('p', 'pt', 'letter');

        source = $('.containerpdfdiv')[0];


        margins = {
          top:      10,
          bottom:   10,
          left:     20,
          width:    800
        };

//        console.log(source.children('.row'));
//
//        ppp.replace('class="col-lg-2', 'style="width:100px;" class="col-lg-2');
//        ppp.replace('col-lg-1', 'style="width:100px;" class="col-lg-1');
//        ppp.replace('col-lg-4', 'style="width:100px;" class="col-lg-4');
//
//        console.log(ppp);

        pdf.fromHTML(
          source, // HTML string or DOM elem ref.
          margins.left, // x coord
          margins.top, { // y coord
            'width': margins.width, // max width of content on PDF
          },

          function (dispose) {
            pdf.save('Report.pdf');
          }, margins);

//        cancelEdit();
      });



      $('.tableDinamica').on('click',   '.removeReportByAttr',  function(e){

        objectToEditIndex = $(this).attr('attr');

        $.ajax({
          type: "GET", url: urlRemove, data: {'id' : objectToEditIndex}, success: function (json) {
            if(json.trim() == 'OK')
            {
              location.reload();
            }
          }
        });

      });

      $('.cancel-edit').click(function(){
        cancelEdit();
      });

      function cancelEdit(){
        if(!parentton)
          return
        $('#main_content').removeClass('edit-mode-report');
        $('#edit_content').removeClass('edit-mode-report-big');
        $('#edit_content').addClass('edit-report');
        parentton.removeClass('background-obvio');
      }
      function sendOkMessage(){
        alert('Move-In Report Updated');
      }
      function injectData(data){

        var checkType = ['','Good', 'Fair', 'Poor'];
        //Request JSON
        var dataParsed = $.parseJSON(data.request_condition);

        //Report JSON
        var dataParsedReport = $.parseJSON(data.report_condition);


        for(var index in dataParsed ) {
          var item = dataParsed[index];
          $('#' + index + ' span').removeClass('checkbox-1 checkbox-2 checkbox-3');
          $('#' + index + ' span').addClass('checkbox-' + (item.checkbox ? item.checkbox : 1)).html(checkType[item.checkbox] ? checkType[item.checkbox] : 'Good');
          $('#' + index + ' .hiddenSiNo').html(checkType[item.checkbox] ? checkType[item.checkbox] : 'Good');
          $('#' + index + ' label').html(item.info ? item.info : 'N/A');
          $('#' + index + ' p').html('<input type="checkbox" value="1" id="' + index + '-yesno" name="' + index + '-yesno"><label for="' + index + '-yesno"></label>');
          $('#' + index + ' input:text').attr('name', index + '-who');
          $('#' + index + ' textarea').attr('name', index + '-comment');
        }

        if(dataParsedReport)
          for(var indexReport in dataParsedReport ) {
            var itemReport = dataParsedReport[indexReport];
            $('#'+indexReport + ' input:checkbox').attr('checked', (itemReport.yesno ? true : false));
            $('#'+indexReport + ' input:text').val(itemReport.who?itemReport.who:'');
            $('#'+indexReport + ' input:text').html(itemReport.who?itemReport.who:'');
            $('#'+indexReport + ' textarea').html(itemReport.comment?itemReport.comment:'');
          }
        else{
          $('input:checkbox').attr('checked', false);
          $('input:text').val(null);
          $('textarea').html('');
        }



      }



      $('.save-edit').click(function(){
        var objects = $('#edit-form-id').serializeArray();
        var infoData = {};
        for(var obj in objects ) {
          infoData[objects[obj]['name']] = objects[obj]['value'];
          if(objects[obj]['name'].split('yesno').length > 1)
            infoData['repair'] = true;
        }
        infoData['id'] = objectToEditIndex;


        $.ajax({
            type: "GET", url: urlSave, data: infoData, success: function (json) {
              if(json.trim() == 'OK')
              {
                cancelEdit();
                sendOkMessage();
                location.reload();
              }
            }
          }
        );
      });
      $('#get-pending-repairs').click(function(){
        cancelEdit();
        $('.tableDinamica').fadeOut();
        $('.tableDinamica-2').fadeIn();
      });
      $('#get-pending-reports').click(function(){
        cancelEdit();
        $('.tableDinamica-2').fadeOut();
        $('.tableDinamica').fadeIn();
      });
      $('.btn-all-reports').click(function(e){
        $('.btn-all-reports').removeClass('active');
        $(this).addClass('active');
      });











//
//      $(document).ready(function() {
//        $('#example').DataTable();
//      } );


    }



};