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



                    function mostrarDieta(id_dieta){

                        var parametros = ("id="+id_dieta);


                        $.ajax({
                                url: "muestraDieta.php",
                                type: "GET",
                                dataType: "json",
                                data: parametros,
                                success: respuestaAjaxMuestraDieta,
                                error: errorAjaxMuestraDieta         
                        });


                        function respuestaAjaxMuestraDieta(dieta){
                            $("#titulo_caja_dietas").html(dieta.nombre);
                            $("#caja_dietas").html("");
                            $("#caja_dietas").html("<div class='col-md-6 col-xs-12'><div class='box box-default'><div class='box-header'><h3 class='box-title' id='titulo_caja_dietas'>"+dieta.funcion+"</h3></div><div class='box-body'>"+dieta.descripcion+"</div></div></div><div class='col-md-6 col-xs-12'><div class='box box-default'><div class='box-header'><h3 class='box-title'>Tabla de comidas</h3></div><div class='box-body'>"+dieta.tabla+"</div></div>  <button class='btn btn-warning' onclick='volver_lista_dietas()'>Volver</button>  <button class='btn btn-danger pull-right' onclick='borrarDieta("+dieta.id_dieta+")'>Eliminar</button> </div>");
                            
                        }


                        function errorAjaxMuestraDieta(error){
                            alert("Error en la peticion ajax.");
                            for(var i in error){
                                console.log(error[i]);
                            }
                        }                            
                    }




                    function asignarDieta(id){
                        
                        
                    }



                    function borrarDieta(id){


                            var parametros = ("id="+id);

                            $.ajax({
                                url: "eliminaDieta.php",
                                type: "POST",
                                data: parametros,
                                success: respuestaAjaxEliminar,
                                error: errorAjaxEliminar
                            });

                            function respuestaAjaxEliminar(respuesta){
                                volver_lista_dietas();
                                toastr.error('Dieta eliminada correctamente');                   
                                console.log(respuesta);
                            }

                            function errorAjaxEliminar(){
                                alert("Error en la peticion AJAX al eliminar la dieta.");
                            }
                    }





                    function mostrarCreadorDietas(){
                        $("#titulo_caja_dietas").html("Nueva dieta");
                        $("#caja_dietas").css("display","none");
                        $("#div_formulario_nueva_dieta").css("display","inherit");
                        
                    }



                    function crearDieta(){
                        
                        var nombre = $('#input_nombre').val();
                        var funcion = $('#input_funcion').val();
                        var descripcion = $('#input_descripcion').val();
                        var tabla = $('iframe.cke_wysiwyg_frame').contents().find("body.cke_editable").html();


                        if(nombre != "" && descripcion != "" && funcion != ""){

                            var parametros = ("nombre="+nombre+"&funcion="+funcion+"&descripcion="+descripcion+"&tabla="+tabla);

                            $.ajax({
                                url: "insertaDieta.php",
                                type: "POST",
                                data: parametros,
                                success: respuestaAjaxAnnadir,
                                error: errorAjaxAnnadir
                            });


                            function respuestaAjaxAnnadir(respuesta){

                                if(respuesta == "0"){
                                    toastr.error('El nombre de la dieta ya existe!','Error al crear la dieta');
                                }else{
                                    if(respuesta == "1"){
                                        $('#input_nombre').val("");                                        
                                        $('#input_funcion').val("");
                                        $('#input_descripcion').val(""); 
                                        $('iframe.cke_wysiwyg_frame').contents().find("body.cke_editable").html("");                                      
                                        $("#titulo_caja_dietas").html("Dietas disponibles");
                                        $("#caja_dietas").css("display","inherit");
                                        $("#div_formulario_nueva_dieta").css("display","none");

                                        peticionAjaxDietas();

                                        toastr.success('Dieta añadida correctamente');
                                    }
                                }


                            }

                            function errorAjaxAnnadir(){
                                alert("Error en la peticion Ajax");
                            }


                        }else{

                            toastr.error('Debe rellenar al menos nombre, función y descripcion!','Error al crear la dieta');
                        }

                    }





                    $(document).ready(function(){
                        peticionAjaxDietas();
                        //$('iframe.cke_wysiwyg_frame').contents().find("body.cke_editable").append("<table align='center' border='1' cellpadding='1' cellspacing='0' style='width:500px'><thead><tr><th scope='row'>&nbsp;</th><th scope='col'>Lunes</th><th scope='col'>Martes</th><th scope='col'>Miercoles</th><th scope='col'>Jueves</th><th scope='col'>Viernes</th></tr></thead><tbody><tr><th scope='row'>Desalluno</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Media Ma&ntilde;ana</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Almuerzo</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Merienda</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th scope='row'>Cena</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p>&nbsp;</p>");
                        
                        

                    });


                    function volver_lista_dietas(){
                        
                        
                        $("#caja_dietas").css("display","inherit");
                        peticionAjaxDietas();
                        $("#titulo_caja_dietas").html("Dietas disponibles");
                        
                    }


                    function peticionAjaxDietas(){

                        $.ajax({
                                url: "muestraDietas.php",
                                type: "GET",
                                dataType: "json",
                                success: respuestaAjaxDietas,
                                error: errorAjaxDietas         
                        });


                        function respuestaAjaxDietas(array){

                            var cadena = "";

                            for(var i in array){

                                cadena += ("<div class='col-lg-2 col-xs-6'><div class='small-box bg-green'><div class='inner' style='color:white'><h4>"+array[i].nombre+"</h4><p>"+array[i].funcion+"</p></div><div onclick='mostrarDieta("+array[i].id_dieta+")' id='mas_info_usuarios' class='small-box-footer'>Ver dieta <i class='fa fa-arrow-circle-right'></i></div></div></div>");

                            }

                        $('#div_formulario_nueva_dieta').css("display","none");
                        $('#caja_dietas').html("");

                        $('#caja_dietas').html(cadena);
                        $('#caja_dietas').append("<div class='col-lg-2 col-xs-6'><div class='small-box bg-green'><div class='inner' style='color:white'><h4>&nbsp;</h4><p>&nbsp;</p></div><div class='icon'><i class='fa fa-plus'></i></div><div onclick='mostrarCreadorDietas()' id='boton_crear_dieta' class='small-box-footer'>Nueva dieta <i class='fa fa-arrow-circle-right'></i></div></div></div>");


                        }



                        function errorAjaxDietas(error){
                            alert("Error en la peticion ajax al recibir las dietas.");
                            for(var i in error){
                                console.log(error[i]);
                            }
                        }





                    }



                </script>




                <section class="content-header">
                    <h1>
                        Dietas
                        <small>Consulta y creación de dietas</small>
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
                                <h3 class="box-title" id="titulo_caja_dietas">Dietas disponibles</h3>
                            </div>

                            <div class="box-body">



                                <div id="caja_dietas" class="row">

                                </div>






                                <div id="div_formulario_nueva_dieta" style="display:none">
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
                                            <button class="btn btn-success" onclick="crearDieta()">Crear</button>
                                            <button class="btn btn-warning" onclick="volver_lista_dietas()">Volver</button>
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