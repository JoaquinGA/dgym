<?php

    require_once('../Bd.php');

    session_start();    

    $permiso = $_SESSION['permiso'];

    $id_usuario = $_SESSION['id_usuario'];

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

                        $("#boton_actualizar_precio").click(function(){

                            if($('#input_actualizar_precio').val() == ""){
                                toastr.error('Debe rellenar el campo con algun precio!','Error al actualizar el precio');
                            }else{


                                var parametros = ("precio=" + $('#input_actualizar_precio').val());


                                $.ajax({
                                        url: "actualizarPrecio.php",
                                        type: "GET",
                                        data: parametros,
                                        success: respuestaAjaxActualizaPrecio,
                                        error: errorAjaxActualizaPrecio     
                                });


                                function respuestaAjaxActualizaPrecio(dieta){ 

                                    toastr.success('Precio actualizado correctamente.');
                                    $('#contenedor').load('paginas/inicio.php');
                                }


                                function errorAjaxActualizaPrecio(error){
                                    alert("Error en la peticion ajax.");
                                    for(var i in error){
                                        console.log(error[i]);
                                    }
                                }


                            }

                        });

                      });







 



               </script>


                <section class="content-header">
                    <h1>
                        Cambiar cuota
                        <small>Elija el precio de la mensualidad</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a><i class="fa fa-dashboard"></i>Home</a></li>
                        <li class="active">Cambiar cuota</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">






                    <div class="col-md-2 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                
                            </div>

                            <div class="box-body">


                                    <div class="input-group">
                                        <span class="input-group-addon">€</span>
                                        <input id="input_actualizar_precio" type="text" class="form-control" value="<?php echo(Bd::obtenerPrecioCuota()); ?>">
                                        <span class="input-group-addon">.00</span>
                                    </div><br>                             


                                <button id="boton_actualizar_precio" class="btn btn-success">Enviar</button>

                            </div>
                        </div>

                    </div>







                </section><!-- /.content -->