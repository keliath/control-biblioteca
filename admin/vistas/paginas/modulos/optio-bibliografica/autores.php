<?php

if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Se ha agregado al Autor!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'admin/autores";
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
                    <h1>Opciones de Autores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Opciones de Autores</li>
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
                    <i class="fas fa-book-reader text-primary"></i>
                    Autores
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarAutor">Agregar Nuevo Autor</button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- Default box -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-id-card text-info"></i>
                    Lista de Autores
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaAutores" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
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
VENTANA MODAL AGREGAR NUEVO AUTOR
================================ -->

<!-- The Modal -->
<div class="modal" id="agregarAutor">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nuevo Autor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="inputNombreAutor" class="control-label">Autor</label>
                        <input type="text" class="form-control" placeholder="Nombre del Autor" name="inputNombreAutor" id="inputNombreAutor" required>
                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $agregarAutor = new ControladorAutores();
                $agregarAutor->ctrAgregarAutor();

                ?>

            </form>

        </div>
    </div>
</div>


<!-- ==============================
VENTANA MODAL MODIFICAR AUTOR
================================ -->

<!-- The Modal -->
<div class="modal" id="modificarAutor">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar Autor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modificarAutorContent">

                    <!-- <input type="text" name="idModificarAutor" id="idModificarAutor" hidden>

                    <div class="form-group">
                        <label for="inputNombreAutor" class="control-label">Autor</label>
                        <input type="text" class="form-control" placeholder="Nombre del Autor" name="inputNombreAutor" id="inputNombreAutor" required>
                    </div> -->

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $modificarAutor = new ControladorAutores();
                $modificarAutor->ctrActualizarAutor();

                ?>

            </form>

        </div>
    </div>
</div>