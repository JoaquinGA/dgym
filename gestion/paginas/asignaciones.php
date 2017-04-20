<?php
    require_once('../Bd.php');
    session_start();    
    $permiso = $_SESSION['permiso'];
?>             

    <style type="text/css">

        #fila_nueva_asignacion{
            display: none;
        }




    </style>

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
            peticionAjaxUsuarios();


            //BUSCAR FILAS POR NOMBRE
            $('#input_buscar').keyup(function(){
                peticionAjaxBuscar($('#input_buscar').val());
            }); 

        });


//===================== PETICION AJAX RECIBE USUARIOS ================================


    function peticionAjaxUsuarios(){
            //Peticion ajax
            $.ajax({
                    url: "muestraClientes.php",
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
                cadena += ("<tr><td>"+array[i].id_usuario+"</td><td><small class='label label-info'>Usuario</small></td><td>"+array[i].nombre+"</td><td>"+array[i].peso+"</td><td>"+array[i].altura+"</td><td>"+array[i].nombre_entrenamiento+"</td><td>"+array[i].nombre_dieta+"</td><td style='width:60px;text-align:center'><span class='label label-success' onclick='asignarDietaEntrenamiento("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> </td></tr>");
            }
                
            

            $('#tabla_usuarios').html("");

            //Añade cabecera
            $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th style='width: 40px'>Permiso</th><th>Nombre</th><th>Peso</th><th>Altura</th><th>Entrenamiento</th><th>Dieta</th><th style='width: 62px'>Asignar</th></tr>");
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
                    url: "buscaUsuarios.php",
                    type: "GET",
                    dataType: "json",
                    data: parametros,
                    success: respuestaAjaxBuscaUsuarios,
                    error: errorAjaxBuscaUsuarios         
            }); 


    function respuestaAjaxBuscaUsuarios(array){

            var cadena = "";
            var aux_permiso = "";     
      
            var permiso_usuario_actual = "<?php echo($permiso); ?>";

            for (var i in array){  
                cadena += ("<tr><td>"+array[i].id_usuario+"</td><td><small class='label label-info'>Usuario</small></td><td>"+array[i].nombre+"</td><td>"+array[i].peso+"</td><td>"+array[i].altura+"</td><td>"+array[i].nombre_entrenamiento+"</td><td>"+array[i].nombre_dieta+"</td><td style='width:60px;text-align:center'><span class='label label-success' onclick='asignarDietaEntrenamiento("+array[i].id_usuario+")' title='Modificar'><span class='fa fa-pencil'></span></span> </td></tr>");
            }
                
            

            $('#tabla_usuarios').html("");

            //Añade cabecera
            $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th style='width: 40px'>Permiso</th><th>Nombre</th><th>Peso</th><th>Altura</th><th>Entrenamiento</th><th>Dieta</th><th style='width: 62px'>Asignar</th></tr>");
            //Añade lineas de usuario
            $('#tabla_usuarios').append(cadena);

        }

        function errorAjaxBuscaUsuarios(error){
            alert("Error en la peticaaaaion ajax.");
            for(var i in error){
                console.log(error[i]);
            }
        }

    }


    function modificarDietaEntrenamiento(id){


            var dieta = $('#select_dietas').val();
            var entrenamiento = $('#select_entrenamientos').val();

            var parametros = ("id="+id+"&dieta="+dieta+"&entrenamiento="+entrenamiento);


            $.ajax({
                    url: "modificarDietaEntrenamiento.php",
                    type: "GET",
                    
                    data: parametros,
                    success: respuestaAjaxModificarDietaEntrenamiento,
                    error: errorAjaxModificarDietaEntrenamiento        
            });



            function respuestaAjaxModificarDietaEntrenamiento(respuesta){
                console.log(respuesta);
                peticionAjaxUsuarios();
                ocultaAsignarDietaENtrnamiento();
                toastr.success('Dieta y entrenamiento modificados corectamente!');
            }

            function errorAjaxModificarDietaEntrenamiento(){
                alert("Error en la peticion ajax para actualizar la dieta y el entrenamiento");
            }





    }


    function ocultaAsignarDietaENtrnamiento(){
        $('#fila_nueva_asignacion').css("display","none");
    }


    function asignarDietaEntrenamiento(id){
        
        $('#fila_nueva_asignacion').css("display","inherit");


            var parametros = ("id="+id);

            $.ajax({
                    url: "muestraUsuario.php",
                    type: "GET",
                    dataType: "json",
                    data: parametros,
                    success: respuestaAjaxCargarUsuario,
                    error: errorAjaxCargarUsuario        
            });


            function respuestaAjaxCargarUsuario(obj){

                $('#etiqueta_nombre_cliente').html(obj.nombre);
                $('#etiqueta_imagen_usuario').attr("src","fotos_perfil/"+obj.foto);
                $('#select_dietas').val(obj.dieta);
                $('#select_entrenamientos').val(obj.entrenamiento);
                $('#div_boton_modificar').html("<button id='boton_modificar' onclick='modificarDietaEntrenamiento("+id+")' class='btn btn-success'>Modificar</button>")
                $('#h3_mostrar_altura').html(obj.altura);
                $('#h3_mostrar_peso').html(obj.peso);
                
   
            }

            function errorAjaxCargarUsuario(){
                alert("Error en la petición ajax al cargar el usuario");
            }


    }






    </script>




    <section class="content-header">
        <h1>
            Asignaciones
            <small>Escoja un usuario</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Home</li>
            <li class="active">Asignaciones</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">




        <div class="row">



                    <!-- ================  TABLA USUARIOS REGISTRADOS =========================-->

                    <div class="col-md-9 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title">Usuarios</h3>
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



                    <!-- ================  TABLA ASIGNAR =========================-->
        <!-- FILA -->
        <div id="fila_nueva_asignacion" class="row">

                    <div class="col-md-9 col-xs-12">
                        <div class="box box-success">

                            <div class="box-header">
                                <h3 id="etiqueta_nombre_cliente" class="box-title">Asignar entrenamiento o dieta</h3>
                            </div>

                            <div class="box-body">
                                <div id="div_nueva_asignacion">
                                    <div class="row">


                                        <div class="col-xs-12 col-md-6">
                                           <div class="row">
                                                <div>
                                                    <img class="img-circle center-block" id="etiqueta_imagen_usuario"/>
                                                    <br><br>
                                                </div>
                                           </div>
                                            

                                            <div class="row">




                                                            <!-- CAJA INFORMATIVA PESO -->
                                                            <div class="col-xs-6">
                                                                <div class="small-box bg-yellow">
                                                                    <div class="inner" style="color:white">
                                                                        <h3 id="h3_mostrar_peso">
                                                                            
                                                                        </h3>
                                                                        <p>
                                                                            Peso actual
                                                                        </p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="ion ion-stats-bars"></i>
                                                                    </div>
                                                                    <div id="mas_info_usuarios" class="small-box-footer">
                                                                        Modificar <i class="fa fa-arrow-circle-right"></i>
                                                                    </div>


                                                                </div>
                                                            </div>




                                                            <!-- CAJA INFORMATIVA ALTURA -->
                                                            <div class="col-xs-6">
                                                                <div class="small-box bg-maroon">
                                                                    <div class="inner" style="color:white">
                                                                        <h3 id="h3_mostrar_altura">
                                                                            
                                                                        </h3>
                                                                        <p>
                                                                            Altura Actual
                                                                        </p>
                                                                    </div>
                                                                    <div class="icon">
                                                                        <i class="ion ion-person-add"></i>
                                                                    </div>
                                                                    <div id="mas_info_usuarios" class="small-box-footer">
                                                                        Modificar <i class="fa fa-arrow-circle-right"></i>
                                                                    </div>



                                                                </div>
                                                            </div>

                                            </div>




   





                                        </div>
                                        <div class="col-xs-12 col-md-6">

                                            <div class="box box-info">

                                                <div class="box-header">
                                                    <h3 class="box-title">Asigne una dieta y entrenamiento</h3>
                                                </div>

                                                <div class="box-body center-block">



                                                    <div class="form-group center-block">
                                                        <label>Dieta</label>
                                                        <select class="form-control" id="select_dietas">

                                                        <?php 
                                                            $resultado = Bd::obtenerDietas();
                                                            $linea = $resultado->fetch();
                                                                                                                    

                                                                while($linea != null){
                                                                    print("<option value='".$linea['id_dieta']."'>'".$linea['nombre']."'</option>");
                                                                    $linea = $resultado->fetch();
                                                                }  
                                                        ?>



                                                        </select>
                                                    </div>



                                                    <div class="form-group">
                                                        <label>Entrenamiento</label>
                                                        <select class="form-control" id="select_entrenamientos">

                                                        <?php 
                                                            $resultado = Bd::obtenerEntrenamientos();
                                                            $linea = $resultado->fetch();
                                                                                                                    

                                                                while($linea != null){
                                                                    print("<option value='".$linea['id_entrenamiento']."'>'".$linea['nombre']."'</option>");
                                                                    $linea = $resultado->fetch();
                                                                }  
                                                        ?>



                                                        </select>
                                                    </div>                                                    

                                                

                                                </div>
                                                <div class="box-footer" id="div_boton_modificar">
                                                                                                        
                                                </div>
                                            </div>






                                        </div>



                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>  


        </div><!-- FIN FILA -->




    </section><!-- /.content -->


