                

    <script type="text/javascript">

        $(document).ready(function(){

            peticionAjaxHistorial();
            
        });   


        function peticionAjaxHistorial(){
                //Peticion ajax
                $.ajax({
                        url: "muestraHistorial.php",
                        type: "GET",
                        dataType: "json",
                        success: respuestaAjaxHistorial,
                        error: errorAjaxHistorial 
                }); 
        }


        function respuestaAjaxHistorial(array){

            

            var cadena = "";
            var aux_permiso = "";


            for (var i in array){
                cadena += ("<tr><td>"+array[i].fecha+"</td><td>"+array[i].evento+"</td></tr>");
            }
      


            $('#tabla_historial').html("");

            //Añade cabecera
            $('#tabla_historial').append("<tr><th>Fecha</th><th>Evento</th></tr>");
            //Añade lineas de usuario
            $('#tabla_historial').append(cadena);

        }

        function errorAjaxHistorial(error){
            alert("Error en la peticaaaaion ajax al obtener el historial.");
            for(var i in error){
                console.log(error[i]);
            }
        }        


    </script>



    <section class="content-header">
        <h1>
            Historial de usuarios
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Home</li>
            <li>Usuarios</li>
            <li class="active">Historial</li>
        </ol>
    </section>

<!-- ===================================== CUERPO ==================================================-->

    <section class="content">

        <!-- ================  TABLA USUARIOS REGISTRADOS =========================-->

        <div class="col-md-9">
            <div class="box box-info">

                <div class="box-header">
                    <h3 class="box-title">Historial de eventos</h3>
                </div>

                <div class="box-body no-padding">
                    <table class="table  table-striped">
                        <tbody id="tabla_historial">


                            <!--  Filas de usuario-->

                        </tbody>
                    </table>
                </div>

            </div>
        </div> 



    </section><!-- /.content -->