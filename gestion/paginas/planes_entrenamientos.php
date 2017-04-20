<?php

    require_once('../Bd.php');

    session_start();    

    $permiso = $_SESSION['permiso'];


?>


                <style type="text/css">




                </style>



                <!-- ========= Libreria para editor de texto ========= -->
                <script src="ckeditor/ckeditor.js"></script>


                <script type="text/javascript">



                    //Opciones de personalización del toast
                    toastr.options = {
                      "closeButton": false,
                      "debug": false,
                      "newestOnTop": false,
                      "progressBar": false,
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



                    function mostrarEntrenamiento(id_entrenamiento){

                        var parametros = ("id="+id_entrenamiento);


                        $.ajax({
                                url: "muestraEntrenamiento.php",
                                type: "GET",
                                dataType: "json",
                                data: parametros,
                                success: respuestaAjaxMuestraEntrenamiento,
                                error: errorAjaxMuestraEntrenamiento         
                        });


                        function respuestaAjaxMuestraEntrenamiento(entrenamiento){
                            $("#titulo_caja_entrenamientos").html(entrenamiento.nombre);
                            $("#caja_entrenamientos").html("");
                            $("#caja_entrenamientos").html("<div class='col-md-6 col-xs-12'><div class='box box-default'><div class='box-header'><h3 class='box-title' id='titulo_caja_entrenamientos'>"+entrenamiento.funcion+"</h3></div><div class='box-body'>"+entrenamiento.descripcion+"</div></div></div><div class='col-md-6 col-xs-12'><div class='box box-default'><div class='box-header'><h3 class='box-title'>Tabla de ejercicios</h3></div><div class='box-body'>"+entrenamiento.tabla+"</div></div> <button class='btn btn-warning' onclick='volver_lista_entrenamientos()'>Volver</button>  <button class='btn btn-danger pull-right' onclick='borrarEntrenamiento("+entrenamiento.id_entrenamiento+")'>Eliminar</button> </div>");
                            
                        }


                        function errorAjaxMuestraEntrenamiento(error){
                            alert("Error en la peticion ajax.");
                            for(var i in error){
                                console.log(error[i]);
                            }
                        }                            
                    }




                    function asignarEntrenamiento(id){
                        
                        
                    }



                    function borrarEntrenamiento(id){


                            var parametros = ("id="+id);

                            $.ajax({
                                url: "eliminaEntrenamiento.php",
                                type: "POST",
                                data: parametros,
                                success: respuestaAjaxEliminarEntrenamiento,
                                error: errorAjaxEliminarEntrenamiento
                            });

                            function respuestaAjaxEliminarEntrenamiento(respuesta){
                                volver_lista_entrenamientos();
                                toastr.error('Entrenamiento eliminado correctamente');                   
                                console.log(respuesta);
                            }

                            function errorAjaxEliminarEntrenamiento(){
                                alert("Error en la peticion AJAX al eliminar el entrenamiento.");
                            }
                    }





                    function mostrarCreadorEntrenamientos(){
                        $("#titulo_caja_entrenamientos").html("Nuevo entrenamiento");
                        $("#caja_entrenamientos").css("display","none");
                        $("#div_formulario_nuevo_entrenamiento").css("display","inherit");
                        
                    }



                    function crearEntrenamiento(){
                        
                        var nombre = $('#input_nombre').val();
                        var funcion = $('#input_funcion').val();
                        var descripcion = $('#input_descripcion').val();
                        var tabla = $('iframe.cke_wysiwyg_frame').contents().find("body.cke_editable").html();


                        if(nombre != "" && descripcion != "" && funcion != ""){

                            var parametros = ("nombre="+nombre+"&funcion="+funcion+"&descripcion="+descripcion+"&tabla="+tabla);

                            $.ajax({
                                url: "insertaEntrenamiento.php",
                                type: "POST",
                                data: parametros,
                                success: respuestaAjaxAnnadirEntrenamiento,
                                error: errorAjaxAnnadirEntrenamiento
                            });


                            function respuestaAjaxAnnadirEntrenamiento(respuesta){

                                if(respuesta == "0"){
                                    toastr.error('El nombre del entrenamiento ya existe!','Error al crear el entrenamiento');
                                }else{
                                    if(respuesta == "1"){
                                        $('#input_nombre').val("");                                        
                                        $('#input_funcion').val("");
                                        $('#input_descripcion').val(""); 
                                        $('iframe.cke_wysiwyg_frame').contents().find("body.cke_editable").html("");                                      
                                        $("#titulo_caja_entrenamientos").html("Entrenamientos disponibles");
                                        $("#caja_entrenamientos").css("display","inherit");
                                        $("#div_formulario_nuevo_entrenamiento").css("display","none");

                                        peticionAjaxEntrenamientos();

                                        toastr.success('Entrenamiento añadido correctamente');
                                    }
                                }


                            }

                            function errorAjaxAnnadirEntrenamiento(){
                                alert("Error en la peticion Ajax");
                            }


                        }else{

                            toastr.error('Debe rellenar al menos nombre, función y descripcion!','Error al crear el entrenamiento');
                        }

                    }





                    $(document).ready(function(){
                        peticionAjaxEntrenamientos();
                        //$('iframe.cke_wysiwyg_frame').contents().find("body.cke_editable").append("<table align='center' border='1' cellpadding='1' cellspacing='0' style='width:500px'><thead><tr><th scope='row'>&nbsp;</th><th scope='col'>Lunes</th><th scope='col'>Martes</th><th scope='col'>Miercoles</th><th scope='col'>Jueves</th><th scope='col'>Viernes</th></tr></thead><tbody><tr><th scope='row'>Desalluno</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Media Ma&ntilde;ana</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Almuerzo</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Merienda</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Cena</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p>&nbsp;</p>");
                        
                        

                    });


                    function volver_lista_entrenamientos(){
                        
                        
                        $("#caja_entrenamientos").css("display","inherit");
                        peticionAjaxEntrenamientos();
                        $("#titulo_caja_entrenamientos").html("Entrenamientos disponibles");
                        
                    }


                    function peticionAjaxEntrenamientos(){

                        $.ajax({
                                url: "muestraEntrenamientos.php",
                                type: "GET",
                                dataType: "json",
                                success: respuestaAjaxEntrenamientos,
                                error: errorAjaxEntrenamientos         
                        });


                        function respuestaAjaxEntrenamientos(array){

                            var cadena = "";

                            for(var i in array){

                                cadena += ("<div class='col-lg-2 col-xs-6'><div class='small-box bg-blue'><div class='inner' style='color:white'><h4>"+array[i].nombre+"</h4><p>"+array[i].funcion+"</p></div><div onclick='mostrarEntrenamiento("+array[i].id_entrenamiento+")' id='mas_info_usuarios' class='small-box-footer'>Ver entrenamiento <i class='fa fa-arrow-circle-right'></i></div></div></div>");

                            }

                        $('#div_formulario_nuevo_entrenamiento').css("display","none");
                        $('#caja_entrenamientos').html("");

                        $('#caja_entrenamientos').html(cadena);
                        $('#caja_entrenamientos').append("<div class='col-lg-2 col-xs-6'><div class='small-box bg-blue'><div class='inner' style='color:white'><h4>&nbsp;</h4><p>&nbsp;</p></div><div class='icon'><i class='fa fa-plus'></i></div><div onclick='mostrarCreadorEntrenamientos()' id='boton_crear_entrenamiento' class='small-box-footer'>Nuevo entrenamiento <i class='fa fa-arrow-circle-right'></i></div></div></div>");


                        }



                        function errorAjaxEntrenamientos(error){
                            alert("Error en la peticion ajax al recibir los entrenamientos.");
                            for(var i in error){
                                console.log(error[i]);
                            }
                        }





                    }



                </script>




                <section class="content-header">
                    <h1>
                        Entrenamientos
                        <small>Consulta y creación de entrenamientos</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                        <li>Planes</li>
                        <li class="active">Entrenamientos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">








                    <div class="col-md-12 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title" id="titulo_caja_entrenamientos">Entrenamientos disponibles</h3>
                            </div>

                            <div class="box-body">



                                <div id="caja_entrenamientos" class="row">

                                </div>






                                <div id="div_formulario_nuevo_entrenamiento" style="display:none">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <input id="input_nombre" type="text" class="form-control" placeholder="Nombre...">
                                            </div>
                                            <div class="form-group">
                                                <input id="input_funcion" type="text" class="form-control" placeholder="Función...">
                                            </div>
                                            <div class="form-group">
                                                <textarea type="text" id="input_descripcion" rows="13" class="form-control" placeholder="Descripción..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea class="ckeditor" name="editor1" id="input_tabla" cols="80"></textarea>
                                            <hr>
                                            <button class="btn btn-success" onclick="crearEntrenamiento()">Crear</button>
                                            <button class="btn btn-warning" onclick="volver_lista_entrenamientos()">Volver</button>
                                        </div>
                                    </div>
                                </div>







                            </div>

                        </div>
                    </div> 









         




                </section><!-- /.content -->




            <script>
               //CKEDITOR.config.skin='minimalist';
                CKEDITOR.replace( 'editor1' );
            </script>