<?php

    require_once('../Bd.php');

    session_start();


    $id_usuario = $_SESSION['id_usuario'];




?>

                <script type="text/javascript" src="js/utilidades.js"></script>
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


                $(document).ready(function(){


                    $('#input_peso').keypress(permiteSoloNumerosDecimalesComa);
                    $('#input_altura').keypress(permiteSoloNumerosDecimalesComa);

                    $('#input_telefono').keypress(entradaNumeros); 
                    

                    cargaUsuario(<?php echo($id_usuario); ?>);
                    $('#boton_guardar_cambios').click(function(){
                        modificaUsuario(<?php echo($id_usuario); ?>);
                    });

                });


                    function cargaUsuario(id){


                            var parametros = ("id="+id);

                            $.ajax({
                                    url: "muestraUsuario.php",
                                    type: "GET",
                                    dataType: "json",
                                    data: parametros,
                                    success: respuestaAjaxCargaUsuario,
                                    error: errorAjaxCargaUsuario        
                            }); 


                            function respuestaAjaxCargaUsuario(usuario){

                                $('#input_contrasenna').val(usuario.contrasenna);

                                $('#input_email').val(usuario.email);
                                $('#input_telefono').val(usuario.telefono);
                                $('#input_peso').val(usuario.peso);
                                $('#input_altura').val(usuario.altura);

                            }

                            function errorAjaxCargaUsuario(){
                                alert("Error en la petición ajax al cargar el usuario.");
                            }

                    }


                    function modificaUsuario(id){

                        var contrasenna1 = $('#input_contrasenna').val();
                        var contrasenna2 = $('#input_repetir_contrasenna').val();

                        
                        var email = $('#input_email').val();                        
                        var telefono = $('#input_telefono').val();
                        var peso = $('#input_peso').val();
                        var altura = $('#input_altura').val(); 


                        //Si las contraseñas coinciden
                        if(contrasenna1 == contrasenna2){
                            var parametros = ("id="+id+"&contrasenna="+contrasenna1+"&email="+email+"&telefono="+telefono+"&peso="+peso+"&altura="+altura);

                            $.ajax({
                                    url: "modificaUsuario2.php",
                                    type: "GET",
                                    data: parametros,
                                    success: respuestaAjaxModificarUsuario,
                                    error: errorAjaxModificarRellenarUsuario        
                            });



                            function respuestaAjaxModificarUsuario(){
                                toastr.success('Usuario modificado correctamente!');
                                console.log("El usuario ha sido modificado correctamente.");
                            }

                            function errorAjaxModificarRellenarUsuario(){
                                alert("Error en la petición ajax al modificar el usuario");
                            }

                        }else{
                            //Mostrar mensaje de contraseñas no coinciden
                            toastr.error('Las contraseñas no coinciden!','Error al modificar usuario');                            
                        }


                    }



                </script>





                <section class="content-header">
                    <h1>
                        Editar perfil
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                        <li class="active">Perfil</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">



                    <div class="col-lg-4 col-xs-12">
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-pencil"></i>
                                    <h3 class="box-title"><?php echo($_SESSION['usuario']); ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">




                                    <div class="center-block">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box box-warning">
                                                <div class="box-header">
                                                    <i class="fa fa-pencil"></i>
                                                    <h3 class="box-title">Datos personales</h3>
                                                </div><!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="row">
                                                    


                                                            <div class="col-xs-12">

                                                                   <!-- Input contraseña -->
                                                                <div class="form-group">
                                                                    <input id="input_contrasenna" type="text" class="form-control" placeholder="Contraseña...">
                                                                </div>

                                                                   <!-- Input Repetir contraseña -->
                                                                <div class="form-group">
                                                                    <input id="input_repetir_contrasenna" type="text" class="form-control" placeholder="Repita contraseña...">
                                                                </div>

                                                                <hr>


                                                                <label>eMail</label>
                                                                <!-- Input eMail -->
                                                                <div class="form-group">
                                                                    <input id="input_email" type="text" class="form-control" placeholder="eMail...">
                                                                </div>

                                                                <label>Telefono</label>
                                                                <!-- Input telefono -->
                                                                <div class="form-group">
                                                                    <input id="input_telefono" onPaste="return false;" maxlength="9" type="text" class="form-control" placeholder="Telefono...">
                                                                </div>



                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-xs-6">                                                                                                                                        <!-- Input peso -->
                                                                        <label>Peso</label>
                                                                        <div class="form-group">
                                                                            <input id="input_peso" onPaste="return false;" type="text" class="form-control" placeholder="Peso...">
                                                                        </div>  
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <label>Altura</label>
                                                                        <!-- Input altura -->
                                                                        <div class="form-group">
                                                                            <input id="input_altura" onPaste="return false;" type="text" class="form-control" placeholder="Altura...">
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>


      
                                                                <button id="boton_guardar_cambios" class="btn btn-success">Guardar cambios</button>
                                                                
                                                            </div>




                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>











                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box box-info">
                                                <div class="box-header">
                                                    <i class="fa fa-pencil"></i>
                                                    <h3 class="box-title">Cambiar foto de perfil</h3>
                                                </div><!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="row">
                                                    
                                                        <div class="col-md-3 col-xs-12">
                                                            <button class="btn btn-success" id="boton_cambiar_imagen">Cambiar Imagen</button>
                                                        </div>

                                                        <div class="col-md-9 col-xs-12">
                                                            <form enctype="multipart/form-data" id="formuploadajax" method="post">
                                                                <input  type="file" class="form-control" id="archivo1" name="archivo1"/>
                                                                <input  type="hidden" name="id_usuario_oculto" value="<?php echo($id_usuario); ?>"/>                                                
                                                            </form>                                                            
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    











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


            $(function(){
                $("#boton_cambiar_imagen").on("click", function(e){
                    e.preventDefault();
                    var f = $(this);
                    var formData = new FormData(document.getElementById("formuploadajax"));
                    //formData.append("dato", "valor");
                    //formData.append(f.attr("name"), $(this)[0].files[0]);
                    $.ajax({
                        url: "recibeImagen.php",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                 processData: false
                    })
                        .done(function(res){
                            if(res == "1"){//Si todo ha ido bien



                                var parametros = ("id="+<?php echo($id_usuario); ?>);


                                $.ajax({
                                        url: "obtenerFoto.php",
                                        type: "GET",
                                        dataType: "html",
                                        data: parametros,
                                        success: respuestaAjaxObtenerFoto,
                                        error: errorAjaxObtenerFoto         
                                }); 

                                function respuestaAjaxObtenerFoto(respuesta){
                                    $('#imagen_usuario_1').attr("src","fotos_perfil/"+respuesta);
                                    $('#imagen_usuario_2').attr("src","fotos_perfil/"+respuesta);
                                }

                                function errorAjaxObtenerFoto(){
                                    alert("Error al obtenr la foto");
                                }

                                toastr.success('Imagen modificada correctamente!');                                
                            }else{
                                toastr.error('Imposible actualizar la imagen del pefil!');
                            }
                        });
                });
            });


    </script>





                                </div>
                    </div>







                </section><!-- /.content -->