var vistas = {

    global : function(){

        /*Funciones generales del sitio*/

    },
    home : function(){

        /*Función default*/
      ajaxData('lib/Execute.php?e=Mhmproperties/getBuildingsFeatured','GET',{},'true',function(json){

        console.log(json);

      });
    }

};