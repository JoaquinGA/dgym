<?php

    require_once('Bd.php');

    session_start();

    if(!isset($_SESSION['usuario']) || $_SESSION['bloqueado']){
        header("Location: index.html");
    }

    $_SESSION['id_usuario'] = Bd::obtenerIdUsuario($_SESSION['usuario']);


    $id_usuario = $_SESSION['id_usuario'];
    $usuario = $_SESSION['usuario'];



    $permiso = Bd::obtenerPermisos($usuario);
    $_SESSION['permiso'] = $permiso;



    if($permiso == "0" || $permiso == "1"){

        Bd::actualizarCuentas();

    }



?>

<!--===========================================================================================-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DGYM | <?php echo($usuario); ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />


        <link href="css/estilos.css" rel="stylesheet" type="text/css" />



        <!-- Toastr -->
        <link rel="stylesheet" href="recursos/toastr/toastr.min.css">
        <script type="text/javascript" src="recursos/toastr/toastr.min.js"></script>





<!--=======================================================================================================-->








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



        $('#input_buscar').focus(function(){
            if ($('#input_buscar').val() = "Buscar...") {
                toastr.success('Debe elejir una seccion antes de buscar.');
            };
        });



        var ultimo_click = parseInt(Math.round((new Date()).getTime() / 1000),10);




        $(document).ready(function(){



        $('#input_buscar').focus(function(){
            if ($('#input_buscar').attr("placeholder") == "Buscar...") {
                toastr.error('Debe elejir una seccion antes de buscar.');
            };
        });

        /*
        ============== EJEMPLO TOASTR =====================


        $(document).click(function(){

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
            toastr.success('Nuevo mensaje!','Mensaje');
        });
        */





            //Cargar página de inicio al entrar
            $('#contenedor').load('paginas/inicio.php');



        // ===================== GESTION BOTONES DE MENUS ============================



            //Botón menu inicio
            $('#menu_inicio').click(function(){
                $('#contenedor').load('paginas/inicio.php');
                $('#input_buscar').attr("placeholder","Buscar...");
            });


            //Botónes menu usuarios
            $('#menu_usuarios_gestion').click(function(){
                $('#contenedor').load('paginas/usuarios_gestion.php');

            });
            $('#menu_usuarios_historial').click(function(){
                $('#contenedor').load('paginas/usuarios_historial.php');
            });

            //Botónes menu entrenamiento
            $('#menu_entrenamiento_ejercicios').click(function(){
                $('#contenedor').load('paginas/entrenamiento_ejercicios.php');

            });
            $('#menu_entrenamiento_dietas').click(function(){
                $('#contenedor').load('paginas/entrenamiento_dietas.php');
            });  


            //Botónes menu planes
            $('#menu_planes_entrenamientos').click(function(){
                $('#contenedor').load('paginas/planes_entrenamientos.php');

            });
            $('#menu_planes_dietas').click(function(){
                $('#contenedor').load('paginas/planes_dietas.php');
            });  

            //Botón menu facturas
            $('#menu_pagos').click(function(){
                $('#contenedor').load('paginas/pagos.php');
            });


            //Botón menu sugerencias
            $('#menu_sugerencias').click(function(){
                $('#contenedor').load('paginas/sugerencias.php');
            });


            //Botón menu facturas
            $('#menu_facturas').click(function(){
                $('#contenedor').load('paginas/facturas.php');
            });

            


            //Botón menu asignaciones
            $('#menu_asignaciones').click(function(){
                $('#contenedor').load('paginas/asignaciones.php');
            });


            //Botón editar perfil 
            $('#boton_editar_perfil').click(function(){
                $('#contenedor').load('paginas/editar_perfil.php');
            });

            //Botón cerrar sesión
            $('#boton_cerrar_sesion').click(function(){
                window.location="salir.php";
            });





        //======================= BLOQUEO DE PANTALLA =================================

            //Guardar hora el último click para el bloqueo de pantalla
            $('body').click(function(){
                ultimo_click = Math.round((new Date()).getTime() / 1000);
            });



            //Comprobar la diferencia entre la hora actual y la del ultimo click.
            //La pantalla se bloquea si han pasado 20s
            setInterval(function(){
                if((ultimo_click) < ((Math.round((new Date()).getTime() / 1000))-parseInt(/*SEGUNDOS PARA BLOQUEAR --> */300))){
                    window.location="paginas/bloqueo.php";
                }
            },10000);




        });




    </script>





<!--=======================================================================================================-->



<link href='http://fonts.googleapis.com/css?family=Roboto:400,500italic,500,700,700italic,900,900italic,100italic,100,300italic,300,400italic' rel='stylesheet' type='text/css'>

    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="gestion.php" class="logo" style="font-family: 'Roboto', sans-serif;">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                
                DawGym
               
                
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo($usuario); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img id="imagen_usuario_2" src="fotos_perfil/<?php echo(Bd::obtenerUsuario($id_usuario)->fetch()['foto']); ?>" class="img-circle" alt="User Image" />
                                    <p>

<!--=========================================================================================================-->


                                        <?php echo($usuario ." - ");
                                        switch ($permiso) {
                                            case '0':
                                                echo("Administrador");
                                                break;
                                            
                                            case '1':
                                                echo("Entrenador");
                                                break;

                                            case '2':
                                                echo("Usuario");
                                                break;                                                

                                            default:
                                                echo("X");
                                                break;
                                        }
                                        ?> 


<!--=========================================================================================================-->

                                        <small>Mienbro desde <?php echo(Bd::obtenerFechaDeAlta($id_usuario)); ?> </small>

                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <div id="boton_editar_perfil" class="btn btn-default btn-flat">Modificar</div>
                                    </div>
                                    <div class="pull-right">
                                        <a id="boton_cerrar_sesion" class="btn btn-default btn-flat">Cerrar sesión</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img id="imagen_usuario_1" src="fotos_perfil/<?php echo(Bd::obtenerUsuario($id_usuario)->fetch()['foto']); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p> <?php echo($usuario); ?> </p>

                            <a><i class="fa fa-circle text-success"></i> 


                                <?php

                                switch ($permiso) {
                                    case '0':
                                        echo("(Administrador)");
                                        break;
                                    
                                    case '1':
                                        echo("(Entrenador)");
                                        break;

                                    case '2':
                                        echo("(Usuario)");
                                        break;

                                    default:
                                        echo("(X)");
                                        break;
                                }

                                ?>

                            </a>
                        </div>
                    </div>
                    <!-- search form -->

                    <?php if($permiso == 0 || $permiso == 1){ ?>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" id="input_buscar" name="q" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                    <?php } ?>


                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">



<!--================================== MENU LETERAL =======================================================-->


                        <!-- ============== INICIO =================== -->


                        <li class="mano">
                            <a id="menu_inicio">
                                <i class="fa fa-laptop"></i> <span>Inicio</span>
                            </a>
                        </li>


                        <!-- ============== ENTRENAMIENTO =================== -->

                        <?php

                            if($permiso == "2"){
                                echo("

                                    <li class='treeview mano'>
                                        <a id='menu_usuarios'>
                                            <i class='fa fa-shield'></i> <span>Entrenamiento</span>
                                            <i class='fa fa-angle-left pull-right'></i>
                                        </a>
                                    <ul class='treeview-menu'>
                                        <li class='mano'><a id='menu_entrenamiento_ejercicios'><i class='fa fa-bars'></i> Ejercicios </a></li>
                                        <li class='mano'><a id='menu_entrenamiento_dietas'><i class='fa fa-cutlery'></i> Dietas </a></li>
                                    </ul>
                                    </li>
                                    ");
                            }


                        ?>



                    



                        <!-- ============== USUARIOS =================== -->


                        <?php

                            if($permiso == "0" || $permiso == "1"){
                                echo("

                                    <li class='treeview mano'>
                                        <a id='menu_usuarios'>
                                            <i class='fa fa-users'></i> <span>Usuarios</span>
                                            <i class='fa fa-angle-left pull-right'></i>
                                        </a>
                                    <ul class='treeview-menu'>
                                        <li class='mano'><a id='menu_usuarios_gestion'><i class='fa fa-angle-double-right'></i> Gestión</a></li>
                                        <li class='mano'><a id='menu_usuarios_historial'><i class='fa fa-angle-double-right'></i> Historial</a></li>
                                    </ul>
                                    </li>
                                    ");
                            }


                        ?>




                        <!-- ============== PAGOS =================== -->
                        <?php

                            if($permiso == "0" || $permiso == "1"){
                                echo("

                        <li class='mano'>
                            <a id='menu_pagos'>
                                <i class='fa fa-credit-card'></i> <span>Pagos</span>
                            </a>
                        </li>");
                            }


                        ?>




                        <!-- ============== PLANES =================== -->


                        <?php

                            if($permiso == "0" || $permiso == "1"){
                                echo("

                                    <li class='treeview mano'>
                                        <a id='menu_planes'>
                                            <i class='fa fa-line-chart'></i> <span>Planes</span>
                                            <i class='fa fa-angle-left pull-right'></i>
                                        </a>
                                    <ul class='treeview-menu'>
                                        <li class='mano'><a id='menu_planes_entrenamientos'><i class='fa fa-angle-double-right'></i> Entrenamientos</a></li>
                                        <li class='mano'><a id='menu_planes_dietas'><i class='fa fa-angle-double-right'></i> Dietas</a></li>
                                    </ul>
                                    </li>
                                    ");
                            }


                        ?>



                        <!-- ============== ASIGNACIONES =================== -->


                        <?php

                            if($permiso == "0" || $permiso == "1"){
                                echo("

                                    <li class='mano'>
                                        <a id='menu_asignaciones'>
                                            <i class='fa fa-tags'></i> <span>Asignaciones</span>
                                        </a>
                                    </li>

                                    ");
                            }


                        ?>


                        <!-- ============== SUGERENCIAS =================== -->


                        <?php

                            if($permiso == "2"){
                                echo("

                                    <li class='mano'>
                                        <a id='menu_sugerencias'>
                                            <i class='fa fa-comment'></i> <span>Sugerencias</span>
                                        </a>
                                    </li>

                                    ");
                            }


                        ?>                        








                        <!-- ============== FACTURAS =================== -->


                        <li class='mano'>
                            <a id="menu_facturas">
                                <i class="fa fa-file-text-o"></i> <span>Facturas</span>
                            </a>
                        </li>







<!--=====================================================================================================-->


                      
                    </ul>
                </section>
                <!-- /.sidebar -->
                
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside id="contenedor" class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Página principal
                        <small>it all starts here</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->






        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    

    </body>
</html>
