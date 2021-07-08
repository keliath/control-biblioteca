<?php

if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Se ha agregado la Editorial!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'admin/editoriales";
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
                    <h1>Opciones de Editoriales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Opciones de Editoriales</li>
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
                    <i class="fas fa-portrait text-primary"></i>
                    Editoriales
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarEditorial">Agregar Nueva Editorial</button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- Default box -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list-alt text-info"></i>
                    Lista de Editoriales
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaEditoriales" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>País</th>
                            <th>Ciudad</th>
                            <th>Detalle</th>
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
VENTANA MODAL AGREGAR NUEVA EDITORIAL
================================ -->

<!-- The Modal -->
<div class="modal" id="agregarEditorial">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nueva Editorial</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="inputNombreEditorial" class="control-label">Editorial</label>
                        <input type="text" class="form-control" placeholder="Nombre de la editorial" name="inputNombreEditorial" id="inputNombreEditorial" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPais" class="control-label">País</label>
                        <div>
                            <select class="form-control select2" name="inputPais" id="inputPais" require>
                                <option value="">Seleccione un País</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputCiudadEditorial" class="control-label">Editorial</label>
                        <input type="text" class="form-control" placeholder="Ciudad de la editorial" name="inputCiudadEditorial" id="inputCiudadEditorial" required>
                    </div>

                    <div class="form-group">
                        <label for="inputDetalleEditorial" class="control-label">Editorial</label>
                        <textarea class="form-control" name="inputDetalleEditorial" id="" cols="10" rows="3" maxlength="250" placeholder="detalle de la editorial"></textarea>
                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $agregarAutor = new ControladorEditoriales();
                $agregarAutor->ctrAgregarEditorial();

                ?>

            </form>

        </div>
    </div>
</div>



<!-- ==============================
VENTANA MODAL MODIFICAR EDITORIAL
================================ -->

<!-- The Modal -->
<div class="modal" id="modificarEditorial">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar Editorial</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modificarEditorialContent">

                    <!-- <div class="form-group">
                        <label for="inputNombreEditorial" class="control-label">Editorial</label>
                        <input type="text" class="form-control" placeholder="Nombre de la editorial" name="inputNombreEditorial" id="inputNombreEditorial" required>
                    </div>

                    <div class="form-group">
                        <label for="inputPais" class="control-label">País</label>
                        <div>
                            <select class="form-control select2" name="inputPais" id="inputPais" require>
                                <option value="">Seleccione un País</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputCiudadEditorial" class="control-label">Editorial</label>
                        <input type="text" class="form-control" placeholder="Ciudad de la editorial" name="inputCiudadEditorial" id="inputCiudadEditorial" required>
                    </div>

                    <div class="form-group">
                        <label for="inputDetalleEditorial" class="control-label">Editorial</label>
                        <textarea class="form-control" name="inputDetalleEditorial" id="" cols="10" rows="3" maxlength="250" placeholder="detalle de la editorial"></textarea>
                    </div> -->

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $agregarAutor = new ControladorEditoriales();
                $agregarAutor->ctrActualizarEditorial();

                ?>

            </form>

        </div>
    </div>
</div>