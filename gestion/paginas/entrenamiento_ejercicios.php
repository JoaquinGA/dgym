<?php

    require_once('../Bd.php');

    session_start();    

    $permiso = $_SESSION['permiso'];

    $id_usuario = $_SESSION['id_usuario'];

?>        

               <script type="text/javascript">


                    $(document).ready(function(){

                        var parametros = ("id="+ <?php echo(Bd::obtenerEntrenamientoDeUsuario($id_usuario)); ?>);


                        $.ajax({
                                url: "muestraEntrenamiento.php",
                                type: "GET",
                                dataType: "json",
                                data: parametros,
                                success: respuestaAjaxMuestraDieta,
                                error: errorAjaxMuestraDieta         
                        });


                        function respuestaAjaxMuestraDieta(dieta){
                            $("#titulo_caja_dietas").html(dieta.nombre);
                            $("#caja_dietas").html("");
                            $("#caja_dietas").html("<div class='col-md-6 col-xs-12'><div class='box box-default'><div class='box-header'><h3 class='box-title' id='titulo_caja_dietas'>"+dieta.funcion+"</h3></div><div class='box-body'>"+dieta.descripcion+"</div></div></div><div class='col-md-6 col-xs-12'><div class='box box-default'><div class='box-header'><h3 class='box-title'>Tabla de comidas</h3></div><div class='box-body'>"+dieta.tabla+"</div></div></div>");
                            
                        }


                        function errorAjaxMuestraDieta(error){
                            alert("Error en la peticion ajax.");
                            for(var i in error){
                                console.log(error[i]);
                            }
                        }   

                    });


               </script>


                <section class="content-header">
                    <h1>
                        Dietas
                        <small>Dietas asignada actualmente</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                        <li>Entrenamientos</li>
                        <li class="active">Ejercicios</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">






                    <div class="col-md-12 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title" id="titulo_caja_dietas">Entrenamiento asignado</h3>
                            </div>

                            <div class="box-body">



                                <div id="caja_dietas" class="row">

                                </div>

                            </div>
                        </div>

                    </div>







                </section><!-- /.content -->