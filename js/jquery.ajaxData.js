/**
 * jQuery ajaxData v0.1
 *
 * Copyright (c) 2011 Pedro Laris (http://peyi.in/)
 * Licensed under the FreeBSD License (See terms below)
 *
 * @author Pedro Laris
 *
 * @projectDescription    jQuery plugin to easily make ajax requests.
 *
 * @version 0.1.0
 *
 * @requires jquery.js
 *
 *
 * TERMS OF USE - jQuery ajaxData
 * Open source under the FreeBSD License.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 *
 *    1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 *    2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY PEDRO LARIS ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL PEDRO LARIS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are those of the authors and should not be interpreted as representing official policies, either expressed or implied, of Pedro Laris, who is the man.
 *
 *
 *
 *
 */

( function() {

    var basepath = "";
    var _jsonFilter = /[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/;


    String.prototype.isJSON = function() {
        return ( _jsonFilter.test( this.replace( /"(\\.|[^"\\])*"/g, '' ) ) );
    }


    String.prototype.parseJSON = function( securityExpression ) {

        securityExpression = securityExpression || 'for(;;);';
        var _jsonObject = null;
        var _jsonExpression = this.replace( securityExpression.toString(), '' );

        if( !_jsonExpression.isJSON() ) {
            //throw new Error( "Invalid JSON format" );
        }

        try {
            _jsonObject = eval( '(' + _jsonExpression + ')' );
        } catch ( err ) {
            //throw new SyntaxError( "Error Parsing JSON format: " + err.message );
        }

        return _jsonObject;

    };


    ajaxData = function( servicio, tipo, params,asyncflag, callback) {

        var _json = null;
        var _params = {};

        var random = Math.round(Math.random()*10000);

        if(typeof(asyncflag) === "undefined"){
            asyncflag = false;
        }else{
            if(asyncflag == "true"){
                asyncflag = true;
            }else{
                asyncflag = false;
            }
        }

        try{
            if(params != ''){
                params.rand = random;
                _params = params;
            }else{
                params = {};
                params.rand = random;
                _params = params;
            }
        }catch(err){
            _params.rand = random;
        }


        $.ajax( {

            url         : basepath + servicio,
            type        : tipo,
            dataType    : 'text',
            async       : asyncflag,
            data		: _params,
            error		: function(xhr, status, error){


                return {"mensajeError" : "Intenta m&aacute;s tarde"};

            },
            success     : function( response ) {

                try {
                    _json = response.toString().parseJSON();

                    if (callback && typeof(callback) === "function") {
                        callback.apply( this, [ _json ] );
                    }

                } catch ( err ) {
                    throw new SyntaxError( 'Cant parse');
                }

            }


        } );


        return _json;
    }

} )(jQuery);