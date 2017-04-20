<?php

    require_once('Bd.php');


?>
    <script type="text/javascript">

    var auxModificar;

    $(document).ready(function(){





        peticionAjaxUsuarios();


        $('#boton_annadir').click(peticionAjaxAnnadir);

        $('#boton_cancelar').click(salirModificacion);

            $('#boton_modificar').click(function(){
                realizarModificacion(auxModificar);
            });        



    });




//===================== PETICION AJAX RECIBE USUARIOS ================================


    function peticionAjaxUsuarios(){
            //Peticion ajax
            $.ajax({
                    url: "muestraUsuarios.php",
                    type: "GET",
                    dataType: "json",
                    success: respuestaAjaxUsuarios,
                    error: errorAjaxUsuarios         
            }); 
    }

    function respuestaAjaxUsuarios(array){

        var cadena = "";
        var aux_permiso = "";     
  


        for (var i in array){

            switch (array[i].permiso) {
                case '0':
                    aux_permiso = "<small class='badge pull-right bg-green'>Administrador</small>";
                    break;
                
                case '1':
                    aux_permiso = "<small class='badge pull-right bg-blue'>Usuario</small>";
                    break;

                default:
                    aux_permiso = "X";
                    break;
            }   


            cadena += ("<tr><td>"+array[i].id_usuario+"</td><td>"+array[i].nombre+"</td><td>"+array[i].contrasenna+"</td><td>"+aux_permiso+"</td><td style='width:60px'><span class='label label-warning' onclick='modificaUsuario("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> <span class='label label-danger' onclick='eliminaUsuario("+array[i].id_usuario+")' title='Eliminar'><span class='fa fa-times'></span></span></td></tr>");
        }

        $('#tabla_usuarios').html("");

        //Añade cabecera
        $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th>Nombre</th><th>Contraseña</th><th style='width: 40px'>Permiso</th><th style='width: 50px'>Editar</th></tr>");
        //Añade lineas de usuario
        $('#tabla_usuarios').append(cadena);

    }

    function errorAjaxUsuarios(error){
        alert("Error en la peticaaaaion ajax.");
        for(var i in error){
            console.log(error[i]);
        }
    }




//================================================================================
//===================== PETICION AJAX AÑADE USUARIO ==============================
//================================================================================

    function peticionAjaxAnnadir(){

        var nombre = $('#input_nombre').val();
        var contrasenna1 = $('#input_contrasenna').val();
        var contrasenna2 = $('#input_repetir_contrasenna').val();
        var permisos = $('#select_permisos').val();
        

        //Si se han rellenado los tres compos
        if(nombre != "" && contrasenna1 != "" && contrasenna2 != ""){


            //Si las contraseñas coinciden
            if(contrasenna1 == contrasenna2){

                var parametros = ("nombre="+nombre+"&contrasenna="+contrasenna1+"&permiso="+permisos);

                $.ajax({
                    url: "insertaUsuarios.php",
                    type: "POST",
                    data: parametros,
                    success: respuestaAjaxAnnadir,
                    error: errorAjaxAnnadir
                });



            }else{
                //Mostrar mensaje de contraseñas no coinciden
                muestraMensajeContrasennas();
            }


        }else{
            //Mostrar mensaje de rellenar todos los campos
            muestraMensajeTodosLosCampos();
        }





    }


    function respuestaAjaxAnnadir(respuesta){

        console.log(respuesta);


        if(respuesta == "0"){//Usuario ya existe

            //Mostrar mensaje de usuario ya existente
            muestraMensajeUsuarioYaExiste();

            console.log("El nombre de usuario ya existe en la base de datos.");

        }else{
            if(respuesta == "1"){//Usuario añadido correctamente

                //Limpiar datos de los inputs
                $('#input_nombre').val("");
                $('#input_contrasenna').val("");
                $('#input_repetir_contrasenna').val("");

                //Refrescar tabla usuarios
                peticionAjaxUsuarios();

                //Mostrar mensaje de usuario añadido correctamente
                muestraMensajeAnnadidoCorrectamente();

                //Mensaje por consola
                console.log("Usuario añadido correctamente.");                         

            }
        }

    }


    function errorAjaxAnnadir(){
        alert("Error en la peticion ajax al añadir el nuevo usuario.")
    }                                




//============================================================================================================
//================================= PETICION AJAX MODIFICA USUSARIO ==========================================
//============================================================================================================


    
    function modificaUsuario(id){


            var parametros = ("id="+id);

            $.ajax({
                    url: "muestraUsuario.php",
                    type: "GET",
                    dataType: "json",
                    data: parametros,
                    success: respuestaAjaxModificarRellenarUsuario,
                    error: errorAjaxModificarRellenarUsuario        
            }); 




        }

        function respuestaAjaxModificarRellenarUsuario(obj){

            //Guardamos el id del usuario a modificar en la variable global auxModificar
            auxModificar = obj.id_usuario;

            //Ocultar todos los mensajes
            ocultarMensajes();                       

            //Cambiar color del div de la caja
            $('#div_color_nuevo_usuario').attr('class','box box-warning');
            //Cambiar titulo de la caja
            $('#h3_nuevo_usuario').html("Modificar Usuario "+obj.id_usuario);



            //Mostrar los botones modificar y cancelar
            $('#boton_annadir').css("display","none");                         
            $('#boton_modificar').css("display","inline");                        
            $('#boton_cancelar').css("display","inline"); 

            //Igualar los inputs a los valores recibidos
            $('#input_nombre').val(obj.nombre);
            $('#input_contrasenna').val(obj.contrasenna);
            $('#input_repetir_contrasenna').val("");     
            $('#select_permisos').val(obj.permiso);


        }

        function errorAjaxModificarRellenarUsuario(error){
            alert("Error en la peticion AJAX al modificar el usuario (Consultar consola).");
            console.log("Informe de error:");
            for(i in error){
                console.log(error[i]);
            }
        }



        function realizarModificacion(id){


            var nombre = $('#input_nombre').val();
            var contrasenna1 = $('#input_contrasenna').val();
            var contrasenna2 = $('#input_repetir_contrasenna').val();
            var permisos = $('#select_permisos').val();

        //Si se han rellenado los tres compos
        if(nombre != "" && contrasenna1 != "" && contrasenna2 != ""){


            //Si las contraseñas coinciden
            if(contrasenna1 == contrasenna2){

                    var parametros = ("id="+id+"&nombre="+nombre+"&contrasenna="+contrasenna1+"&permiso="+permisos);

                    $.ajax({
                            url: "modificaUsuario.php",
                            type: "GET",
                            data: parametros,
                            success: respuestaAjaxModificarUsuario,
                            error: errorAjaxModificarRellenarUsuario        
                    });


            }else{
                    //Mostrar mensaje de contraseñas no coinciden
                    muestraMensajeContrasennas();
            }

        }else{
                //Mostrar mensaje de rellenar todos los campos
                muestraMensajeTodosLosCampos();
        }


        }


        function respuestaAjaxModificarUsuario(respuesta){


            if(respuesta == "0"){
                muestraMensajeUsuarioYaExiste();
                console.log("El nombre de usuario ya existe en la base de datos.");
            }else{
                if(respuesta = "1"){
                    muestraMensajeModificadoCorrectamente();
                    console.log("El usuario ha sido modificado correctamente.");
                    salirModificacion();
                    peticionAjaxUsuarios();                    
                }
            }



        }



        function salirModificacion(){
            //Ocultar todos los mensajes
            //ocultarMensajes();                        

            //Cambiar color del div de la caja
            $('#div_color_nuevo_usuario').attr('class','box box-success');
            //Cambiar titulo de la caja
            $('#h3_nuevo_usuario').html("Nuevo Usuario");


            //Ocultar botones modificar y cancelar y mostrar el de añadir
            $('#boton_annadir').css("display","inline");                        
            $('#boton_modificar').css("display","none");                        
            $('#boton_cancelar').css("display","none"); 

            //Igualar los inputs a los valores recibidos
            $('#input_nombre').val("");
            $('#input_contrasenna').val("");
            $('#input_repetir_contrasenna').val("");     
            $('#select_permisos').val("1");

            //ocultarMensajes();
        }          


    


//======================== PETICION AJAX ELIMINA USUARIO ==========================


    function eliminaUsuario(id){

        var parametros = ("id="+id);

        $.ajax({
            url: "eliminaUsuarios.php",
            type: "POST",
            data: parametros,
            success: respuestaAjaxEliminar,
            error: errorAjaxEliminar
        });
    }

    function respuestaAjaxEliminar(respuesta){
        peticionAjaxUsuarios();                      
        console.log(respuesta);
    }

    function errorAjaxEliminar(){
        alert("Error en la peticion AJAX al eliminar el usuario.");
    }








//======================== MENSAJES INFORMATIVOS ==========================


    
    function muestraMensajeAnnadidoCorrectamente(){
        $('#mensaje_contrasennas').css("display","none");
        $('#mensaje_todos_los_campos').css("display","none");
        $('#mensaje_añadido_correctamente').css("display","block");
        $('#mensaje_usuario_ya_existe').css("display","none");
        $('#mensaje_modificado_correctamente').css("display","none"); 

    }

    function muestraMensajeModificadoCorrectamente(){
        $('#mensaje_modificado_correctamente').css("display","block");        
        $('#mensaje_contrasennas').css("display","none");
        $('#mensaje_todos_los_campos').css("display","none");
        $('#mensaje_añadido_correctamente').css("display","none");
        $('#mensaje_usuario_ya_existe').css("display","none");
    }

    function muestraMensajeContrasennas(){
        $('#mensaje_contrasennas').css("display","block");
        $('#mensaje_todos_los_campos').css("display","none");
        $('#mensaje_añadido_correctamente').css("display","none");
        $('#mensaje_usuario_ya_existe').css("display","none");
        $('#mensaje_modificado_correctamente').css("display","none"); 
    }

    function muestraMensajeTodosLosCampos(){
        $('#mensaje_contrasennas').css("display","none");
        $('#mensaje_todos_los_campos').css("display","block");
        $('#mensaje_añadido_correctamente').css("display","none");
        $('#mensaje_usuario_ya_existe').css("display","none");
        $('#mensaje_modificado_correctamente').css("display","none"); 
    }

    function muestraMensajeUsuarioYaExiste(){
        $('#mensaje_contrasennas').css("display","none");
        $('#mensaje_todos_los_campos').css("display","none");
        $('#mensaje_añadido_correctamente').css("display","none");
        $('#mensaje_usuario_ya_existe').css("display","block");
        $('#mensaje_modificado_correctamente').css("display","none"); 
    }      


    function ocultarMensajes(){
        $('#mensaje_contrasennas').css("display","none");
        $('#mensaje_todos_los_campos').css("display","none");
        $('#mensaje_añadido_correctamente').css("display","none");
        $('#mensaje_usuario_ya_existe').css("display","none");
        $('#mensaje_modificado_correctamente').css("display","none"); 
    }                









//*********************************************************************************
//*********************************************************************************
//*********************************************************************************
//*********************************************************************************
//*********************************************************************************
//*********************************************************************************
//*********************************************************************************
                </script>














<!-- ==================================== CABECERA ====================================================-->

                <section class="content-header">
                    <h1>
                        Gestión de usuarios
                        <small>it all starts here</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>














<!-- ===================================== CUERPO ==================================================-->
                <section class="content">















                    <!-- ================  TABLA USUARIOS REGISTRADOS =========================-->

                    <div class="col-md-9">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title">Usuarios Registrados</h3>
                            </div>

                            <div class="box-body no-padding">
                                <table class="table table-condensed">
                                    <tbody id="tabla_usuarios">


                                        <!--  Filas de usuario-->

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>                   








                    <!-- =========== FORMUALRIO NUEVO USUARIO =============-->




                    <div class="col-md-3">
                        <div id="div_color_nuevo_usuario" class="box box-success">

                            <div class="box-header">
                                <h3 id="h3_nuevo_usuario" class="box-title">Nuevo Usuario</h3>
                            </div>



                            <div class="box-body">


                                    <!-- Mensaje de usuario añadido correctamente -->
                                    <div id="mensaje_añadido_correctamente" class="alert alert-success alert-dismissable" style="display:none">
                                        <i class="fa fa-check"></i>
                                        Usuario añadido <b>correctamente!</b>
                                    </div>

                                    <!-- Mensaje de usuario modificado correctamente -->
                                    <div id="mensaje_modificado_correctamente" class="alert alert-success alert-dismissable" style="display:none">
                                        <i class="fa fa-check"></i>
                                        Usuario modificado <b>correctamente!</b>
                                    </div>

                                    <!-- Mensaje de contraseñas no coinciden -->
                                    <div id="mensaje_contrasennas" class="alert alert-danger alert-dismissable" style="display:none">
                                        <i class="fa fa-ban"></i>
                                        Las <b>contraseñas no</b> coinciden.
                                    </div>

                                    <!-- Mensaje de todos los campos -->
                                    <div id="mensaje_todos_los_campos" class="alert alert-danger alert-dismissable" style="display:none">
                                        <i class="fa fa-ban"></i>
                                        Debe rellenar <b>todos</b> los campos.
                                    </div>


                                    <!-- Mensaje de usuario ya existe -->
                                    <div id="mensaje_usuario_ya_existe" class="alert alert-danger alert-dismissable" style="display:none">
                                        <i class="fa fa-ban"></i>
                                        El nombre de usuario <b>ya existe</b> en la base de datos.
                                    </div>




                                       <!-- Input nombre -->
                                    <div class="form-group">
                                        <input id="input_nombre" type="text" class="form-control" placeholder="Nombre...">
                                    </div>

                                       <!-- Input contraseña -->
                                    <div class="form-group">
                                        <input id="input_contrasenna" type="text" class="form-control" placeholder="Contraseña...">
                                    </div>

                                       <!-- Input Repetir contraseña -->
                                    <div class="form-group">
                                        <input id="input_repetir_contrasenna" type="text" class="form-control" placeholder="Repita contraseña...">
                                    </div>    

                                       <!-- Select permisos -->
                                    <div class="form-group">
                                            <label>Permisos</label>
                                            <select class="form-control" id="select_permisos">
                                                <option value="1">Usuario</option>
                                                <option value="0">Administrador</option>
                                            </select>
                                        </div>


                                        <!-- Div botones -->
                                    <div class="box-footer">
                                        <button id="boton_annadir" class="btn btn-success">Añadir</button>
                                        <button id="boton_modificar" style="display:none" class="btn btn-warning">Modificar</button>
                                        <button id="boton_cancelar" style="display:none" class="btn btn-danger">Cancelar</button>
                                    </div>





                            </div><!-- /.box-body -->
                        </div>
                    </div>       


































                </section><!-- /.content -->




