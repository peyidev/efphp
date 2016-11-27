var vistas = {

    global : function(){

        /*Funciones generales del sitio*/

    },
    home : function(){

        /*Función default*/
      ajaxData('lib/Execute.php?e=Mhmproperties/getBuildingsFeatured','GET',{},'true',function(json){

        var feauturedHtml = '';
        var delay         = 300;
        var roomsData     = '';

        for(var ft in json)
        {
          var shortVar = json[ft];

          console.log(shortVar);
          if(shortVar['bool_mainfeatured'] == 1)
          {
            var mainFt = '#main-ft-';
            $(mainFt + 'name').html(shortVar['nombre']);
            $(mainFt + 'desc').html(shortVar['cms_description']);

            var object = shortVar['id_serialized_amenitie'];
            var amenities = '';
            var amenitiesInicio = '<p><span class="amenities-red-box slider-sun"></span><label>';
            var amenitiesFin = '</label></p>';
            for(var obj in object)
            {
              amenities += amenitiesInicio + object[obj] + amenitiesFin;
            }
            $(mainFt + 'ameni').html(amenities);

            var imgHtml = '<img src="' + shortVar['img_building'] + '" class="slider-hill" alt="slider image ' + shortVar['seoalt'] + '" title="'+ shortVar['seotitle'] +'">';

            $(mainFt + 'img').html(imgHtml);

          }
          else
          {

            var rooms         = shortVar['rooms'];
            feauturedHtml     += '<div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="' + delay + 'ms">';
              feauturedHtml     += '<div class="single-service">';
                feauturedHtml     += '<div class="wow scaleIn feautured-box-container" data-wow-duration="500ms" data-wow-delay="' + delay + 'ms">';
                  if(shortVar['fromfee'] || shortVar['fromfee'] > 0)
                    feauturedHtml   += '<div class="p-red-card"><p>From $ <label for="">' + shortVar['fromfee'] + '</label>/person</p></div>';
                  feauturedHtml     += '<img src="' + shortVar['img_building'] + '"  alt="' + shortVar['seoalt'] + '" title="'+ shortVar['seotitle'] +'">';
                feauturedHtml     += '</div>';
                feauturedHtml += '<div class="v1-property-card-info">';
                  feauturedHtml += '<p class="v1-p-type">';
                    feauturedHtml += shortVar['buildingtype'] + ' FOR RENT';
                  feauturedHtml += '</p>';
                  feauturedHtml += '<p class="v1-p-address">';
                    feauturedHtml += '<i class="fa fa-location-arrow"></i>';
                    feauturedHtml += '<span class="v1-p-a-street">';
                      feauturedHtml += shortVar['nombre'];
                    feauturedHtml += '</span>';
                  feauturedHtml += '</p>';
                  feauturedHtml += '<p class="v1-p-data">';
                    for (var index in rooms)
                    {
                      roomsData += '<label>';
                      roomsData += rooms[index]['nombre'];
                      roomsData += ': $';
                      roomsData += rooms[index]['pricefrom'];
                      roomsData += ' - $';
                      roomsData += rooms[index]['priceto'];
                      roomsData += '</label>';
                    }
                    feauturedHtml += roomsData;
                  feauturedHtml += '</p>';
                feauturedHtml += '</div>';
              feauturedHtml += '</div>';
            feauturedHtml += '</div>';




            delay = delay + 300;


          }
        }

        $('#feautured-list').html(feauturedHtml);


      });
    }

};