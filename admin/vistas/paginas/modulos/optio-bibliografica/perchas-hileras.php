<?php

if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Ubicacion agregada!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'admin/perchas-hileras";
        }
    });
</script>';
}

?>





<div class="content-wrapper" style="min-height: 1592.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Opciones de Perchas-Hileras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Opciones de Perchas-Hileras</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-th-large text-primary"></i>
                    Perchas-Hileras
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarPerchaHilera">Agregar Nueva Percha-Hilera</button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- Default box -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-th text-info"></i>
                    Lista de Perchas-Hileras
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaPerchasHileras" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Percha</th>
                            <th>Hilera</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!--  tabla creada con ajax -->

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->
</div>



<!-- ==============================
VENTANA MODAL AGREGAR NUEVA PerchaHilera
================================ -->

<!-- The Modal -->
<div class="modal" id="agregarPerchaHilera">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nueva Percha-Hilera</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="inputNombrePercha" class="control-label">Percha</label>
                        <input type="text" class="form-control" placeholder="Nombre de la Percha" name="inputNombrePercha" id="inputNombrePercha" required>
                    </div>

                    <div class="form-group">
                        <label for="inputNombreHilera" class="control-label">Hilera</label>
                        <input type="text" class="form-control" placeholder="Nombre de la Hilera" name="inputNombreHilera" id="inputNombreHilera" required>
                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $agregarUbicacion = new ControladorPerchasHileras();
                $agregarUbicacion->ctrAgregarPerchaHilera();

                ?>

            </form>

        </div>
    </div>
</div>


<!-- ==============================
VENTANA MODAL MODIFICAR PerchaHilera
================================ -->

<!-- The Modal -->
<div class="modal" id="ModificarPerchaHilera">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nueva Percha-Hilera</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modificarUbicacionContent">

                    <!-- <div class="form-group">
                        <label for="inputNombrePercha" class="control-label">Percha</label>
                        <input type="text" class="form-control" placeholder="Nombre de la Percha" name="inputNombrePercha" id="inputNombrePercha" required>
                    </div>

                    <div class="form-group">
                        <label for="inputNombreHilera" class="control-label">Hilera</label>
                        <input type="text" class="form-control" placeholder="Nombre de la Hilera" name="inputNombreHilera" id="inputNombreHilera" required>
                    </div> -->

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $modificarUbicacion = new ControladorPerchasHileras();
                $modificarUbicacion->ctrActualizarPerchaHilera();

                ?>

            </form>

        </div>
    </div>
</div>