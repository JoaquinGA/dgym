<?php

    require_once('../Bd.php');


    session_start();    

    $permiso = $_SESSION['permiso'];


?>



    <script type="text/javascript" src="js/utilidades.js"></script>


    <script type="text/javascript">

    var auxModificar;


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



permiteSoloNumerosConGuiones

        $('#input_nombre').keypress(entradaLetras);


        $('#input_peso').keypress(permiteSoloNumerosDecimalesComa);
        $('#input_altura').keypress(permiteSoloNumerosDecimalesComa);

        $('#input_fecha_nacimiento').keypress(permiteSoloNumerosConGuiones);


        $('#input_telefono').keypress(entradaNumeros);        



        $('#input_buscar').attr("placeholder","Buscar por nombre...");


        //Peticion ajax para pintar la tabla de usuarios
        peticionAjaxUsuarios();


        $('#boton_annadir').click(peticionAjaxAnnadir);

        $('#boton_cancelar').click(salirModificacion);

            $('#boton_modificar').click(function(){
                realizarModificacion(auxModificar);
            });

        //BUSCAR FILAS POR NOMBRE
        $('#input_buscar').keyup(function(){
            peticionAjaxBuscar($('#input_buscar').val());
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
  
        var permiso_usuario_actual = "<?php echo($permiso); ?>";

    

        for (var i in array){



            if(permiso_usuario_actual == "0"){

            switch (array[i].permiso) {
                case '0':
                    aux_permiso = "<small class='label label-danger'>Administrador</small>";
                    break;
                
                case '1':
                    aux_permiso = "<small class='label label-success'>Entrenador</small>";
                    break;

                case '2':
                    aux_permiso = "<small class='label label-info'>Usuario</small>";
                    break;                    

                default:
                    aux_permiso = "X";
                    break;
            }   
            
            cadena += ("<tr><td>"+array[i].id_usuario+"</td><td>"+aux_permiso+"</td><td>"+array[i].nombre+"</td><td>"+array[i].dni+"</td><td>"+array[i].telefono+"</td><td>"+array[i].email+"</td><td>"+array[i].nacimiento+"</td><td style='width:60px'><span class='label label-warning mano' onclick='modificaUsuario("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> <span class='label label-danger mano' onclick='eliminaUsuario("+array[i].id_usuario+")' title='Eliminar'><span class='fa fa-times'></span></span></td></tr>");

            }else{
                if(array[i].permiso == "2"){
cadena += ("<tr><td>"+array[i].id_usuario+"</td><td style='text-align=center'><small class='label label-info'>Usuario</small></td><td>"+array[i].nombre+"</td><td>"+array[i].dni+"</td><td>"+array[i].telefono+"</td><td>"+array[i].email+"</td><td>"+array[i].nacimiento+"</td><td style='width:60px'><span class='label label-warning mano' onclick='modificaUsuario("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> <span class='label label-danger mano' onclick='eliminaUsuario("+array[i].id_usuario+")' title='Eliminar'><span class='fa fa-times'></span></span></td></tr>");    
                }
            }
            
        }

        $('#tabla_usuarios').html("");

        //Añade cabecera
        $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th style='width: 40px'>Permiso</th><th>Nombre</th><th>Dni</th><th>Teléfono</th><th>eMail</th><th>Nacimiento</th><th style='width: 62px'>Editar</th></tr>");
        //Añade lineas de usuario
        $('#tabla_usuarios').append(cadena);

    }

    function errorAjaxUsuarios(error){
        alert("Error en la peticaaaaion ajax.");
        for(var i in error){
            console.log(error[i]);
        }
    }




//====================================================================================
//===================== PETICION AJAX BUSCAR USUARIOS ================================
//====================================================================================


    function peticionAjaxBuscar(nombre){

            var parametros = ("nombre="+nombre);


            $.ajax({
                    url: "buscaUsuarios.php",
                    type: "GET",
                    dataType: "json",
                    data: parametros,
                    success: respuestaAjaxBuscaUsuarios,
                    error: errorAjaxBuscaUsuarios         
            }); 
    }

    function respuestaAjaxBuscaUsuarios(array){

        var cadena = "";
        var aux_permiso = "";     
  
        var permiso_usuario_actual = "<?php echo($permiso); ?>";

    

        for (var i in array){



            if(permiso_usuario_actual == "0"){

            switch (array[i].permiso) {
                case '0':
                    aux_permiso = "<small class='label label-danger'>Administrador</small>";
                    break;
                
                case '1':
                    aux_permiso = "<small class='label label-success'>Entrenador</small>";
                    break;

                case '2':
                    aux_permiso = "<small class='label label-info'>Usuario</small>";
                    break;                    

                default:
                    aux_permiso = "X";
                    break;
            }   
            
            cadena += ("<tr><td>"+array[i].id_usuario+"</td><td>"+aux_permiso+"</td><td>"+array[i].nombre+"</td><td>"+array[i].dni+"</td><td>"+array[i].telefono+"</td><td>"+array[i].email+"</td><td>"+array[i].nacimiento+"</td><td style='width:60px'><span class='label label-warning' onclick='modificaUsuario("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> <span class='label label-danger mano' onclick='eliminaUsuario("+array[i].id_usuario+")' title='Eliminar'><span class='fa fa-times'></span></span></td></tr>");

            }else{
                if(array[i].permiso == "2"){
cadena += ("<tr><td>"+array[i].id_usuario+"</td><td style='text-align=center'><small class='label label-info'>Usuario</small></td><td>"+array[i].nombre+"</td><td>"+array[i].dni+"</td><td>"+array[i].telefono+"</td><td>"+array[i].email+"</td><td>"+array[i].nacimiento+"</td><td style='width:60px'><span class='label label-warning mano' onclick='modificaUsuario("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> <span class='label label-danger mano' onclick='eliminaUsuario("+array[i].id_usuario+")' title='Eliminar'><span class='fa fa-times'></span></span></td></tr>");    
                }
            }
            
        }

        $('#tabla_usuarios').html("");

        //Añade cabecera
        $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th style='width: 40px'>Permiso</th><th>Nombre</th><th>Dni</th><th>Teléfono</th><th>eMail</th><th>Nacimiento</th><th style='width: 62px'>Editar</th></tr>");
        //Añade lineas de usuario
        $('#tabla_usuarios').append(cadena);

    }

    function errorAjaxBuscaUsuarios(error){
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

        var dni = $('#input_dni').val();
        var email = $('#input_email').val();
        var nacimiento = $('#input_fecha_nacimiento').val();
        var telefono = $('#input_telefono').val();
        var peso = $('#input_peso').val();
        var altura = $('#input_altura').val();

        if(email==""){email="-"};
        if(nacimiento==""){nacimiento="-"};
        if(telefono==""){telefono="-"};
        if(peso==""){peso="-"};
        if(altura==""){altura="-"};





        //Si no se obtiene el codigo del permiso (en caso de no ser creado por un administrador) el permiso sera 2 y se creara un usuario
        if(permisos == undefined){permisos = "2"}

        

        //Si se han rellenado los cuatro compos
        if(nombre != "" && contrasenna1 != "" && contrasenna2 != ""&& dni != ""){




            //Si las contraseñas coinciden
            if(contrasenna1 == contrasenna2){


                if(compruebaDni(dni)){

                    var parametros = ("nombre="+nombre+"&contrasenna="+contrasenna1+"&permiso="+permisos+"&dni="+dni+"&email="+email+"&nacimiento="+nacimiento+"&telefono="+telefono+"&peso="+peso+"&altura="+altura);

                    console.log(parametros);

                    $.ajax({
                        url: "insertaUsuarios.php",
                        type: "POST",
                        data: parametros,
                        success: respuestaAjaxAnnadir,
                        error: errorAjaxAnnadir
                    });


                }else{
                    toastr.error('Dni no valido!','Error al crear usuario');
                }





            }else{
                //Mostrar mensaje de contraseñas no coinciden
                 toastr.error('Las contraseñas no coinciden!','Error al crear usuario');
            }


        }else{
            //Mostrar mensaje de rellenar todos los campos
             toastr.error('Debe rellenar al menos nombre, contraseña y dni!','Error al crear usuario');
        }





    }


    function respuestaAjaxAnnadir(respuesta){



        if(respuesta == "0"){//Usuario ya existe

            //Mostrar mensaje de usuario ya existente
            toastr.error('El nombre de usuario ya existe en la base de datos!','Error al crear usuario');

            console.log("El nombre de usuario ya existe en la base de datos.");

        }else{
            if(respuesta == "1"){//Usuario añadido correctamente

                //Limpiar datos de los inputs
                $('#input_nombre').val("");
                $('#input_contrasenna').val("");
                $('#input_repetir_contrasenna').val("");
                $('#input_dni').val("");
                $('#input_fecha_nacimiento').val("");
                $('#input_email').val("");
                $('#input_telefono').val("");
                $('#input_altura').val("");
                $('#input_peso').val("");                

                //Refrescar tabla usuarios
                peticionAjaxUsuarios();

                //Mostrar mensaje de usuario añadido correctamente
                toastr.success('Usuario añadido correctamente!');

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
            $('#input_dni').val(obj.dni);
            $('#input_fecha_nacimiento').val(obj.nacimiento);
            $('#input_email').val(obj.email);
            $('#input_telefono').val(obj.telefono);

            $('#input_peso').val(obj.peso);
            $('#input_altura').val(obj.altura);


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

            var dni = $('#input_dni').val();
            var email = $('#input_email').val();
            var nacimiento = $('#input_fecha_nacimiento').val();
            var telefono = $('#input_telefono').val();
            var peso = $('#input_peso').val();
            var altura = $('#input_altura').val();            

        //Si se han rellenado los tres compos
        if(nombre != "" && contrasenna1 != "" && contrasenna2 != ""){


            //Si las contraseñas coinciden
            if(contrasenna1 == contrasenna2){

                    var parametros = ("id="+id+"&nombre="+nombre+"&contrasenna="+contrasenna1+"&permiso="+permisos+"&dni="+dni+"&email="+email+"&nacimiento="+nacimiento+"&telefono="+telefono+"&peso="+peso+"&altura="+altura);

                    $.ajax({
                            url: "modificaUsuario.php",
                            type: "GET",
                            data: parametros,
                            success: respuestaAjaxModificarUsuario,
                            error: errorAjaxModificarRellenarUsuario        
                    });


            }else{
                    //Mostrar mensaje de contraseñas no coinciden
                    toastr.error('Las contraseñas no coinciden!','Error al modificar usuario');
            }

        }else{
                //Mostrar mensaje de rellenar todos los campos
                toastr.error('Debe rellenar todos los campos!','Error al modificar usuario');
        }


        }


        function respuestaAjaxModificarUsuario(respuesta){


            if(respuesta == "0"){
                toastr.error('El nombre de usuario ya existe en la base de datos!','Error al modificar usuario');
                console.log("El nombre de usuario ya existe en la base de datos.");
            }else{
                if(respuesta = "1"){
                    toastr.success('Usuario modificado correctamente!');
                    console.log("El usuario ha sido modificado correctamente.");
                    salirModificacion();
                    peticionAjaxUsuarios();                    
                }
            }



        }



        function salirModificacion(){
                      

            //Cambiar color del div de la caja
            $('#div_color_nuevo_usuario').attr('class','box box-success');
            //Cambiar titulo de la caja
            $('#h3_nuevo_usuario').html("Nuevo Usuario");


            //Ocultar botones modificar y cancelar y mostrar el de añadir
            $('#boton_annadir').css("display","inline");                        
            $('#boton_modificar').css("display","none");                        
            $('#boton_cancelar').css("display","none"); 

            //Poner inputs en blanco
            $('#input_nombre').val("");
            $('#input_contrasenna').val("");
            $('#input_repetir_contrasenna').val("");     
            $('#select_permisos').val("1");
            $('#input_dni').val("");
            $('#input_fecha_nacimiento').val("");
            $('#input_email').val("");
            $('#input_telefono').val("");
            $('#input_altura').val("");
            $('#input_peso').val("");


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
        toastr.error('Usuario eliminado correctamente');
        console.log(respuesta);
    }

    function errorAjaxEliminar(){
        alert("Error en la peticion AJAX al eliminar el usuario.");
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
                        <small>Datos personales</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                        <li>Usuarios</li>
                        <li class="active">Gestion</li>
                    </ol>
                </section>














<!-- ===================================== CUERPO ==================================================-->
                <section class="content">















                    <!-- ================  TABLA USUARIOS REGISTRADOS =========================-->

                    <div class="col-md-9 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title">Usuarios Registrados</h3>
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








                    <!-- =========== FORMUALRIO NUEVO USUARIO =============-->




                    <div class="col-md-3 col-xs-12">
                        <div id="div_color_nuevo_usuario" class="box box-success">

                            <div class="box-header">
                                <h3 id="h3_nuevo_usuario" class="box-title">Nuevo Usuario</h3>
                            </div>



                            <div class="box-body">



                                    <?php if($permiso == 0){ ?>
                                       <!-- Select permisos -->
                                    <div class="form-group">
                                            <label>Permisos</label>
                                            <select class="form-control" id="select_permisos">
                                                <option value="2">Usuario</option>
                                                <option value="1">Entrenador</option>
                                                <option value="0">Administrador</option>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <hr>

                                       <!-- Input nombre -->
                                    <div class="form-group">
                                        <input id="input_nombre" onPaste="return false;" type="text" class="form-control" placeholder="Nombre...">
                                    </div>

                                       <!-- Input contraseña -->
                                    <div class="form-group">
                                        <input id="input_contrasenna" onPaste="return false;" type="text" class="form-control" placeholder="Contraseña...">
                                    </div>

                                       <!-- Input Repetir contraseña -->
                                    <div class="form-group">
                                        <input id="input_repetir_contrasenna" onPaste="return false;" type="text" class="form-control" placeholder="Repita contraseña...">
                                    </div>

                                    <hr>


                                    <!-- Input DNI -->
                                    <div class="form-group">
                                        <input id="input_dni" onPaste="return false;" type="text" class="form-control" placeholder="dni...">
                                    </div>                                    

                                    <!-- Input fecha -->
                                    <div class="form-group">
                                        <input id="input_fecha_nacimiento" onPaste="return false;" type="text" class="form-control" placeholder="Nacimiento (aaaa-mm-dd)...">
                                    </div>



                                    <!-- Input eMail -->
                                    <div class="form-group">
                                        <input id="input_email" onPaste="return false;" type="text" class="form-control" placeholder="eMail...">
                                    </div>

                                    <!-- Input telefono -->
                                    <div class="form-group">
                                        <input id="input_telefono" onPaste="return false;" maxlength="9" type="text" class="form-control" placeholder="Telefono...">
                                    </div>



                                    <hr>

                                    <!-- Input peso -->
                                    <div class="form-group">
                                        <input id="input_peso" onPaste="return false;" type="text" class="form-control" placeholder="Peso...">
                                    </div>        

                                    <!-- Input altura -->
                                    <div class="form-group">
                                        <input id="input_altura" onPaste="return false;" type="text" class="form-control" placeholder="Altura...">
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




