<div class="content-wrapper" style="min-height: 1592.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Prestamos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Prestamos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt text-info"></i>
                    Mis Prestamos
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
            <input type="text" id="idUsuario" value="<?php echo $usuario["id_usuario"] ?>" hidden>
                <table class="table table-striped table-bordered dt-responsive tablaMiReporte" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Portada Libro</th>
                            <th>Título</th>
                            <th>Edición</th>
                            <th>ISBN</th>
                            <th>Fecha Límite</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!--  tabla creada con ajax -->

                    </tbody>
                </table>

                <?php
                
                $procesoSolicitud = new ControladorPrestamos;
                $procesoSolicitud->ctrActualizarPrestamo();

                ?>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->
</div>