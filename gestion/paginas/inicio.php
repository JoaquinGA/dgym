<?php

    require_once('../Bd.php');

    session_start();



    //Obtener los datos del usuario
    $datos_usuario = Bd::obtenerUsuario($_SESSION['id_usuario'])->fetch();



?>    


                <script type="text/javascript">





                function pintarSugerencias(){
                    $.ajax({
                            url: "muestraSugerencias.php",
                            type: "GET",
                            dataType: "json",
                            success: respuestaAjaxObtenerSugerencias,
                            error: errorAjaxObtenerSugerencias         
                    });        



                    function respuestaAjaxObtenerSugerencias(array){

                        if(!array.length){
$('#contenedor_muestra_sugerencias').append("<div class='callout callout-info'><h4>Actualmente no hay registrada ninguna sugerencia.</h4></div>");                            
                        }else{
                            for (var i in array){
                                $('#contenedor_muestra_sugerencias').append("<div class='callout callout-info'><h4>"+array[i].nombre_usuario+"-"+array[i].asunto+"</h4><p>"+array[i].mensaje+"</p><button class='btn btn-danger btn-xs' onclick='eliminaSugerencia("+array[i].id_sugerencia+")'>Eliminar</button></div>");
                            }
                        }


                    }    

                    function errorAjaxObtenerSugerencias(){
                        alert("Error en la peticaaaaion ajax.");
                        for(var i in error){
                            console.log(error[i]);
                        }                    
                    }                     
                }


                function eliminaSugerencia(id_sugerencia){

                    var parametros = "id_sugerencia="+id_sugerencia;

                    $.ajax({
                            url: "eliminaSugerencia.php",
                            type: "GET",
                            data: parametros,
                            success: respuestaAjaxBorrarSugerencia,
                            error: errorAjaxBorrarSugerencia        
                    });   

                    function respuestaAjaxBorrarSugerencia(){                        
                        $('#contenedor_muestra_sugerencias').html("");
                        pintarSugerencias();
                        toastr.success('Sugerencia eliminada correctamente.');
                    } 

                    function errorAjaxBorrarSugerencia(){
                        alert("Error en la peticaaaaion ajax.");
                        for(var i in error){
                            console.log(error[i]);
                        }                    
                    }                     


                }


                $(document).ready(pintarSugerencias);

     




                </script>





                <section class="content-header">
                    <h1>
                        Inicio
                        <small>Comenzemos</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">



<!--==============================================================================================-->
<!--=============================== PERFIL USUARIO (2) ===========================================-->
<!--==============================================================================================-->

                <?php if($_SESSION['permiso'] == 2){?>

                <!-- LINEA -->
                <div class="row">


                    <!-- COLUMNA DATOS PERSONALES -->
                    <div class="col-md-6 col-xs-12">
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title"><?php echo($_SESSION['usuario']); ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                            <img src="fotos_perfil/<?php echo($datos_usuario['foto']); ?>" class="img-circle center-block" alt="User Image" />
                                            <button id="boton_editar_perfil2" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i></button><br>
                                            <script type="text/javascript">$("#boton_editar_perfil2").click(function(){$('#contenedor').load('paginas/editar_perfil.php');});</script>
                                            <hr>
                                            <dl class="dl-horizontal" style="margin-left:30%;">
                                                <dt>Nombre de usuario</dt>
                                                <dd><?php echo($datos_usuario['nombre']); ?></dd>
                                                <dt>Contraseña</dt>
                                                <dd><?php echo($datos_usuario['contrasenna']); ?></dd>
                                                <dt>Fecha de alta</dt>
                                                <dd><?php echo($datos_usuario['fecha_alta']); ?></dd>
                                                <dt>Fecha de nacimiento</dt>
                                                <dd><?php echo($datos_usuario['nacimiento']); ?></dd>
                                                <dt>Telefono</dt>
                                                <dd><?php echo($datos_usuario['telefono']); ?></dd>
                                                <dt>eMail</dt>
                                                <dd><?php echo($datos_usuario['email']); ?></dd>
                                            </dl>

                                </div>
                                </div>
                    <!-- FIN COLUMNA DATOS PERSONALES -->                                
                    </div>
                        




                    <!-- COLUMNA CAJAS INFORMATIVAS -->
                    <div class="col-md-6 col-xs-12">


                        <!-- CAJA INFORMATIVA PESO -->
                        <div class="col-lg-6 col-xs-12">
                            <div class="small-box bg-yellow">
                                <div class="inner" style="color:white">
                                    <h3>
                                        <?php echo($datos_usuario['peso']); ?>Kg
                                    </h3>
                                    <p>
                                        Peso actual
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <div id="mas_info_peso" class="small-box-footer mano">
                                    Modificar <i class="fa fa-arrow-circle-right"></i>
                                </div>

                                <script type="text/javascript">
                                    $('#mas_info_peso').click(function(){
                                            $('#contenedor').load('paginas/editar_perfil.php'); 
                                                                               
                                    });
                                </script>

                            </div>
                        </div>




                        <!-- CAJA INFORMATIVA ALTURA -->
                        <div class="col-lg-6 col-xs-12">
                            <div class="small-box bg-maroon">
                                <div class="inner" style="color:white">
                                    <h3>
                                        <?php echo($datos_usuario['altura']); ?>m
                                    </h3>
                                    <p>
                                        Altura Actual
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <div id="mas_info_altura" class="small-box-footer mano">
                                    Modificar <i class="fa fa-arrow-circle-right"></i>
                                </div>

                                <script type="text/javascript">
                                    $('#mas_info_altura').click(function(){
                                            $('#contenedor').load('paginas/editar_perfil.php'); 
                                                                               
                                    });
                                </script>


                            </div>
                        </div>

                        <!-- CAJA INFORMATIVA ENTRENAMIENTO -->
                        <div class="col-lg-6 col-xs-12">
                            <div class="small-box bg-teal">
                                <div class="inner" style="color:white">
                                    <h3>
                                         <?php echo(Bd::obtenerNombreEntrenamiento($datos_usuario['entrenamiento'])); ?>
                                    </h3>
                                    <p>
                                        Entrenamiento actual
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-pricetag-outline"></i>
                                </div>
                                <div id="mas_info_entrenamiento" class="small-box-footer mano">
                                    Mas información <i class="fa fa-arrow-circle-right"></i>
                                </div>

                                <script type="text/javascript">
                                    $('#mas_info_entrenamiento').click(function(){
                                            $('#contenedor').load('paginas/entrenamiento_ejercicios.php'); 
                                                                               
                                    });
                                </script>


                            </div>
                        </div>

                        <!-- CAJA INFORMATIVA DIETA -->
                        <div class="col-lg-6 col-xs-12">
                            <div class="small-box bg-green">
                                <div class="inner" style="color:white">
                                    <h3>
                                         <?php echo(Bd::obtenerNombreDieta($datos_usuario['dieta'])); ?>
                                    </h3>
                                    <p>
                                        Dieta Actual
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-cart-outline"></i>
                                </div>
                                <div id="mas_info_dieta" class="small-box-footer mano">
                                    Mas información <i class="fa fa-arrow-circle-right"></i>
                                </div>

                                <script type="text/javascript">
                                    $('#mas_info_dieta').click(function(){
                                            $('#contenedor').load('paginas/entrenamiento_dietas.php'); 
                                                                               
                                    });
                                </script>


                            </div>



                        </div>














                    <!-- FIN COLUMNA CAJAS INFORMATIVAS -->
                     </div>




                <!-- FIN LINEA -->
                </div>






<!--==============================================================================================-->
<!--=============================== PERFIL ADMINISTRADOR/ENTRENADOR (0/1) ==========================-->
<!--==============================================================================================-->
                <?php }else{ ?>


                <!-- FILA MENSAJES INFORMATIVOS -->
                <div class="row">
                    <!-- CAJA ADMINISTRADORES -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner" style="color:white">
                                <h3>
                                    <?php echo(Bd::cuentaUsuariosPermiso(0)) ?>
                                </h3>
                                <p>
                                    Administradores
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-key"></i>
                            </div>
                            <div class="small-box-footer mas_info_usuarios mano">
                                Mas información <i class="fa fa-arrow-circle-right"></i>
                            </div>




                        </div>
                    </div>
                    <!-- CAJA USUARIOS REGISTRADOS -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner" style="color:white">
                                <h3>
                                    <?php echo(Bd::cuentaUsuariosPermiso(1)) ?>
                                </h3>
                                <p>
                                    Entrenadores
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <div class="small-box-footer mas_info_usuarios mano">
                                Mas información <i class="fa fa-arrow-circle-right"></i>
                            </div>



                        </div>
                    </div>
                    <!-- CAJA USUARIOS REGISTRADOS -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner" style="color:white">
                                <h3>
                                    <?php echo(Bd::cuentaUsuariosPermiso(2)) ?>
                                </h3>
                                <p>
                                    Usuarios registrados
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-stalker"></i>
                            </div>
                            <div class="small-box-footer mas_info_usuarios mano">
                                Mas información <i class="fa fa-arrow-circle-right"></i>
                            </div>




                        </div>
                    </div>
                    <!-- CAJA USUARIOS REGISTRADOS -->
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner" style="color:white">
                                <h3>
                                    <?php echo(Bd::obtenerPrecioCuota()); ?> €
                                </h3>
                                <p>
                                    Precio cuota actual
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios7-pricetag-outline"></i>
                            </div>
                            
                                <?php 
                                if($_SESSION['permiso'] == 0){
                                    echo("<div id='boton_cambiar_cuota' class='small-box-footer mano'>");
                                    echo("Modificar <i class='fa fa-arrow-circle-right'></i>");
                                    echo("</div>");
                                }else{
                                    echo("<div class='small-box-footer mano'>");
                                    echo("<br>");
                                    echo("</div>");
                                }
                                
                                ?>
                           




                        </div>
                    </div>                                                            
                </div>


                            <script type="text/javascript">
                                $('.mas_info_usuarios').click(function(){
                                        $('#contenedor').load('paginas/usuarios_gestion.php'); 
                                                                           
                                });
                            </script>


                <div class="row">
                    <div class="col-lg-3 col-xs-12">

                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-users"></i>
                                    <h3 class="box-title">Gráfica de privilegios</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                


                                <img src="http://chart.apis.google.com/chart?cht=bvg&chs=400x350&chd=t:<?php echo(Bd::cuentaUsuariosPermiso(0)) ?>,<?php echo(Bd::cuentaUsuariosPermiso(1)) ?>,<?php echo(Bd::cuentaUsuariosPermiso(2)) ?>&chxr=1,0,30&chds=0,20&chco=00C0EF|5CB85C|ff9900&chbh=65,0,35&chxt=x,y,x&chl=Administradores|Entrenadores|Usuarios&chts=000000,20,20&chg=0,25,5,5">



                                </div>
                            </div>


                    </div>



                    <div class="col-lg-9 col-xs-12">

                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-comment"></i>
                                    <h3 class="box-title">Sugerencias de clientes</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body" id="contenedor_muestra_sugerencias">

                                


                                



                                </div>
                            </div>


                    </div>



                </div>


                <script type="text/javascript">

                    //Botón modificar precio
                    $('#boton_cambiar_cuota').click(function(){
                        
                        $('#contenedor').load('paginas/cambiar_cuota.php');
                    });

                </script>


                <?php } ?>

                </section><!-- /.content -->

