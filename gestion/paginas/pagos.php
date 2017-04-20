<?php
    require_once('../Bd.php');
    session_start();    
    $permiso = $_SESSION['permiso'];
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





        $(document).ready(function(){

            $('#input_buscar').attr("placeholder","Buscar por nombre...");

            //Peticion ajax para pintar la tabla de usuarios
            peticionAjaxUsuarios();


            //BUSCAR FILAS POR NOMBRE
            $('#input_buscar').keyup(function(){
                peticionAjaxBuscar($('#input_buscar').val());
            }); 

        });



        function realizarPago(id){

            var parametros = ("id="+id);

            $.ajax({
                url: "pagar.php",
                type: "POST",
                data: parametros,
                success: respuestaAjaxPagar,
                error: errorAjaxPagar
            });

            function respuestaAjaxPagar(respuesta){
                toastr.success('Cuota abonada correctamente');
                peticionAjaxUsuarios();              
            }

            function errorAjaxPagar(){
                alert("Error en la peticion AJAX al realizar el pago.");
            }
                    
        }

//===================== PETICION AJAX RECIBE USUARIOS ================================


    function peticionAjaxUsuarios(){
            //Peticion ajax
            $.ajax({
                    url: "muestraPagos.php",
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

                var activo = "";
                var cadena_pagar;
                if(array[i].activo == "1"){
                    activo = "<small class='label label-success'>PAGADO</small>";
                    cadena_pagar = "";
                }else{
                    activo = "<small class='label label-danger'>PENDIENTE</small>";
                    cadena_pagar = "<button class='btn btn-xs btn-danger' onclick='realizarPago("+array[i].id_usuario+")'>PAGAR</button>";
                }


                cadena += ("<tr><td>"+array[i].id_usuario+"</td><td>"+array[i].dni+"</td><td>"+array[i].nombre+"</td><td>"+array[i].fecha_pago+"</td><td>"+array[i].fecha_vencimiento+"</td><td style='text-align=center'>"+activo+"</td><td>"+cadena_pagar+"</td></tr>");
            }
                
            

            $('#tabla_usuarios').html("");

            //Añade cabecera
            $('#tabla_usuarios').append("<tr><th style='width: 10px'>#</th><th style='width: 40px'>Dni</th><th>Nombre</th><th>Ultimo pago</th><th>Fecha vencimiento</th><th>Estado</th><th>Realizar pago</th></tr>");
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
                    url: "buscaUsuariosPagos.php",
                    type: "GET",
                    dataType: "json",
                    data: parametros,
                    success: respuestaAjaxUsuarios,
                    error: errorAjaxBuscaUsuarios         
            }); 

/*
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
*/



        function errorAjaxBuscaUsuarios(error){
            alert("Error en la peticaaaaion ajax.");
            for(var i in error){
                console.log(error[i]);
            }
        }

        




    }






    </script>


                <section class="content-header">
                    <h1>
                        Pagos
                        <small>Registrar pago de cuota</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"> Home</i></li>
                        
                        <li class="active">Pagos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

        <div class="row">



                    <!-- ================  TABLA USUARIOS REGISTRADOS =========================-->

                    <div class="col-md-9 col-xs-12">
                        <div class="box box-info">

                            <div class="box-header">
                                <h3 class="box-title">Tabla de pagos</h3>
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

                    <div class="col-lg-3 col-xs-12">

                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-users"></i>
                                    <h3 class="box-title">Gráfica de pagos</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                


                                <img src="http://chart.apis.google.com/chart?cht=bvg&chs=300x350&chd=t:<?php echo(Bd::cuentaUsuariosPago(1)); ?>,<?php echo(Bd::cuentaUsuariosPago(0)); ?>&chxr=1,0,30&chds=0,20&chco=00C0EF|5CB85C&chbh=65,0,35&chxt=x,y,x&chl=Pagado|Pendiente&chts=000000,20,20&chg=0,25,5,5">



                                </div>
                            </div>


                    </div>                    


        </div>


                </section><!-- /.content -->