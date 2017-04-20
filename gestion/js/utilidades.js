
/*Función  para onkeypress que me valida la entrada de letras en la que solo me deja escribir
letras y espacios.Y dejo borrar con suprimir o tecla de borrar y tambíén las flechas */

		 function entradaLetras(e) {

	        var c = e.charCode || window.event.keyCode || e;      
	    	return ( (c>=65 && c<=90) || (c>=97 && c<=122) || (c==32) || (c==164) || (c==165) || (c==0));

	      }




/*Función que lo que me hace es restringir solo a números sin puntos y borrar */

	     function entradaNumeros(e){

	     	var c = e.charCode || window.event.keyCode;
	     	return (  (c>=48 && c<=57) || c==0);

	     }


/*Esto lo que me hace es comprobar no */

	     function Entrada_Letra_Nif(e) {

	        var c = e.charCode || window.event.keyCode;

	    	return ( (c>=65 && c<=90) || (c>=97 && c<=122) || (c==164) || (c==165) || (c==0));

	      }

	            
      //  Permitir SOLO números con decimales. El separador es la coma (,):
      function permiteSoloNumerosDecimalesComa(e) {
        var c = e.charCode || window.event.keyCode;
   
        if (c == 44)
          return (this.value.indexOf(",") == -1)
        else
          return ((c >= 48)  && (c <= 57));
      }


      function permiteSoloNumerosConGuiones(e) {
        var c = e.charCode || window.event.keyCode;
   

          return (((c >= 48)  && (c <= 57)) || (c==45));
      }      


		function validarEmail( email ) {
		    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		    if ( !expr.test(email) ){
		    	return false;
		    }else{
		    	return true;
		    }
		        
		}


	
	
	
        function compruebaDni(cadena){



            cadena = cadena.toUpperCase();

            var valido = false;
            var letra = "";
            var nif = "";

            var letras = "TRWAGMYFPDXBNJZSQVHLCKE";



            var modulo = (cadena.substring(0,8))%(23);



            if(cadena.length < 8 || cadena.length > 9 || isNaN(parseInt(cadena.substring(7)))){
                return false;
            }else if(cadena.length == 9){
                if(letras[modulo] == cadena[8]){

                    return true;
                }else{

                    return false;
                }
            }

        }