<?php

    require_once('Bd.php');

    session_start();

?>    

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

                <?php echo($_SESSION["usuario"]."(".$_SESSION["id_usuario"].")"); ?>


                </section><!-- /.content -->