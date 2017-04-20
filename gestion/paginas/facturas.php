<?php
    require_once('../Bd.php');
    session_start();    
    $permiso = $_SESSION['permiso'];
?>   

    <script type="text/javascript">



            //Opciones de personalización del toast
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };





        $(document).ready(function(){

            $('#input_buscar').attr("placeholder","Buscar por nombre...");

            //Peticion ajax para pintar la tabla de usuarios
            if(<?php echo($_SESSION['permiso']); ?> != 2){
                peticionAjaxUsuarios();
            }else{
                peticionAjaxBuscar("<?php echo($_SESSION['usuario']); ?>");
            }
            


            //BUSCAR FILAS POR NOMBRE
            $('#input_buscar').keyup(function(){
                peticionAjaxBuscar($('#input_buscar').val());
            }); 

        });




    function descargarPdf(idUsuario,idPago){
        

        window.location="imprimirFactura.php?id_pago="+idPago+"&id_usuario="+idUsuario;
/*
        var parametros = ("id_usuario="+idUsuario+"&id_pago="+idPago);

        $.ajax({
            url: "imprimirFactura.php",
            type: "POST",
            data: parametros,
            success: respuestaAjaxImprimirFactura,
            error: errorAjaxImprimirFactura
        });


        function respuestaAjaxImprimirFactura(respuesta){
            console.log("Factura descargada correctamente."+respuesta);
        }

        function errorAjaxImprimirFactura(){
            console.log("Error al imprimir la factura.");   
        }
*/
    }

//===================== PETICION AJAX RECIBE USUARIOS ================================


    function peticionAjaxUsuarios(){
            //Peticion ajax
            $.ajax({
                    url: "muestraTodosPagos.php",
                    type: "GET",
                    dataType: "json",
                    success: respuestaAjaxUsuarios,
                    error: errorAjaxUsuarios         
            }); 
    }

        function respuestaAjaxUsuarios(array){

            var cadena = "";
            var aux_permiso = "";     
      
            var permiso_usuario_actual = "<?php echo($permiso); ?>";

            for (var i in array){

                
                var cadena_pagar;
                
                cadena_descargar = "<button class='btn btn-xs btn-warning' style='text-align:center' onclick='descargarPdf("+array[i].id_usuario+","+array[i].id_pago+")'><i class='fa fa-save'></i></button>";
                


                cadena += ("<tr><td>"+array[i].id_pago+"</td><td>"+array[i].dni+"</td><td>"+array[i].nombre+"</td><td>"+array[i].fecha_pago+"</td><td>"+cadena_descargar+"</td></tr>");
            }
                
            

            $('#tabla_usuarios').html("");

            //Añade cabecera
            $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th style='width: 40px'>Dni</th><th>Nombre</th><th>Fecha pago</th><th>Descargar</th></tr>");
            //Añade lineas de usuario
            $('#tabla_usuarios').append(cadena);

        }

        function errorAjaxUsuarios(error){
            alert("Error en la peticaaaaion ajax.");
            for(var i in error){
                console.log(error[i]);
            }
    }


    function peticionAjaxBuscar(nombre){

            var parametros = ("nombre="+nombre);


            $.ajax({
                    url: "buscaUsuariosTodosPagos.php",
                    type: "GET",
                    dataType: "json",
                    data: parametros,
                    success: respuestaAjaxUsuarios,
                    error: errorAjaxBuscaUsuarios         
            }); 




        function errorAjaxBuscaUsuarios(error){
            alert("Error en la peticion ajax.");
            for(var i in error){
                console.log(error[i]);
            }
        }

        




    }






    </script>


                <section class="content-header">
                    <h1>
                        Facturas
                        <small>Descargar facturas</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                        <li class="active">Facturas</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

        <div class="row">



                    <!-- ================  TABLA USUARIOS REGISTRADOS =========================-->

                    <div class="col-md-9 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title">Tabla de facturas</h3>
                            </div>

                            <div class="box-body no-padding">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody id="tabla_usuarios">


                                            <!--  Filas de usuario-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>  

                   


        </div>


                </section><!-- /.content -->