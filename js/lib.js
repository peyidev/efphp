var execute = new function(){

    this.run = function(){

        var seccion = "home";

        if(utils.getParameterByName("s")){
            seccion = utils.getParameterByName("s");
        }

        vistas.global();

        try{

            eval("vistas." + seccion + "()");

        }catch(err){

            console.log(err);
        }


    };

};

var validator = {

    startValidations : function(){

        $('.validation-form').submit(function(e){

            e.preventDefault();

            var validated = true;

            $(this).find('input').each(function(){
                try{
                    if(!validator.validateInput($(this).attr('class'),$(this).val(),$(this))){
                        validated = false;
                    }
                }catch(err){
                    console.log(err);
                }
            });

            if(validated){
                $(this).unbind().submit();
            }else{
                $("<div class='message-validation'>Valida todos los datos requeridos</div>").dialog({"modal" : true});
            }


        });

    },


    validateInput : function(type, val, selector){

        type = type.split(" ");
        var valid = true;
        for(var i = 0; i < type.length; i++){

            var tmp = type[i];
            tmp = tmp.split('validation-');

            if(tmp.length > 1){

                if(!validator.validator(tmp[1],val, selector)){
                    valid = false;

                }
            }
        }

        return valid;

    },

    validator : function(type, val, selector){

        var validated = true;

        switch(type){

            case "tel":
                var patt = new RegExp("^[1-9]{10}$");
                var telefono = val;
                if (!patt.test(telefono)){
                    validated = false;
                }
                break;

            default:
                if(typeof val === "undefined" || val == "" ){
                    validated = false;
                }

                break;
        }

        if(!validated){
            validator.changeColor(selector,"error");
        }else{
            validator.changeColor(selector,"regular");
        }

        return validated;

    },

    changeColor : function(selector, type){


        switch(type){

            case "error":
                $(selector).css({"color":"#cc0000"});
                $(selector).parent().parent().find('.input').find('.form-control').css({"border":"1px solid #cc0000"});
                break;
            case "regular":
                $(selector).css({"color":"inherit"});
                $(selector).parent().parent().find('.input').css({"color":"inherit"});

                break;

        }


    }

};

var utils = {

    getParameterByName: function(name){

        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));

    },

    createTable: function(selector, objects, data, column){

        console.log(data.length);

        try{
            var table = "<table id='rand'>";

            var headFoot = "";

            for(var i = 0; i < column.length; i++){

                headFoot+="<th>" + column[i] + "</th>";

            }

            table+= "<thead><tr>" + headFoot + "</tr></thead>";
            table+= "<tfoot><tr>" + headFoot + "</tr></tfoot>";

            var body = "";

            for(var i = 0; i < data.length; i++){

                body+= "<tr>";

                for(var j = 0; j < objects.length; j++){


                    body+= "<td>" + data[i][j][objects[j]] + "</td>";

                }

                body+= "</tr>";
            }

            table += body;
            table += "</table>";
            $(selector).append(table);


            $("#rand").DataTable();
            return true;

        }catch(err){

            console.log(err);

        }



    }

}


