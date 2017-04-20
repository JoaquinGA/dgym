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



                        function envia_sugerencia(id){

                            if(($('#input_asunto').val() == "") || ($('#input_mensaje').val() == "")){
                                toastr.error('Debe rellenar los campos Asunto y Mensaje!','Error al enviar la sugerencia');
                            }else{

                                



                                var parametros = ("id="+id+"&asunto=" + $('#input_asunto').val() + "&mensaje=" + $('#input_mensaje').val());


                                $.ajax({
                                        url: "insertaSugerencia.php",
                                        type: "GET",
                                        data: parametros,
                                        success: respuestaAjaxMuestraDieta,
                                        error: errorAjaxMuestraDieta         
                                });


                                function respuestaAjaxMuestraDieta(dieta){
                                    $('#input_asunto').val(""); 
                                    $('#input_mensaje').val(""); 
                                    toastr.success('Sugerencia enviada correctamente.');
                                }


                                function errorAjaxMuestraDieta(error){
                                    alert("Error en la peticion ajax.");
                                    for(var i in error){
                                        console.log(error[i]);
                                    }
                                }


                            }


 
                            
                        }


                    $(document).ready(function(){









 

                    });


               </script>


                <section class="content-header">
                    <h1>
                        Sugerencias
                        <small>Ayudenos a mejorar</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a><i class="fa fa-dashboard"></i>Home</a></li>
                        <li class="active">Sugerencias</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">






                    <div class="col-md-6 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title" id="titulo_caja_dietas">Nueva sugerencia</h3>
                            </div>

                            <div class="box-body">

                                <div class="form-group">
                                    <label>Asunto</label>
                                    <input type="text" id="input_asunto" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>Mensaje</label>
                                    <textarea class="form-control" id="input_mensaje" rows="6"></textarea>
                                </div>

                                <button id="boton_enviar_sugerencia" class="btn btn-success" onclick="envia_sugerencia(<?php echo($id_usuario); ?>);">Enviar</button>

                            </div>
                        </div>

                    </div>







                </section><!-- /.content -->