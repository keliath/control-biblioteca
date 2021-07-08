<?php

if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Categoria agregada!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'admin/categorias";
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
                    <h1>Opciones de Categorías</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Opciones de Categorías</li>
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
                    <i class="fas fa-bookmark text-primary"></i>
                    Categorías
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarCategoria">Agregar Nueva Categoría</button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- Default box -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-boxes text-info"></i>
                    Lista de Categorías
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaCategorias" width="100%">
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
VENTANA MODAL AGREGAR NUEVA Categoria
================================ -->

<!-- The Modal -->
<div class="modal" id="agregarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nueva Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="inputNombreCategoria" class="control-label">Categoría</label>
                        <input type="text" class="form-control" placeholder="Nombre de la Categoría" name="inputNombreCategoria" id="inputNombreCategoria" required>
                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $agregarAutor = new ControladorCategorias();
                $agregarAutor->ctrAgregarCategoria();

                ?>

            </form>

        </div>
    </div>
</div>




<!-- ==============================
VENTANA MODAL MODIFICAR Categoria
================================ -->

<!-- The Modal -->
<div class="modal" id="modificarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modificarCategoriaContent">

                    <!-- <div class="form-group">
                        <label for="inputNombreCategoria" class="control-label">Categoría</label>
                        <input type="text" class="form-control" placeholder="Nombre de la Categoría" name="inputNombreCategoria" id="inputNombreCategoria" required>
                    </div> -->

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $modificarCategoria = new ControladorCategorias();
                $modificarCategoria->ctrActualizarCategoria();

                ?>

            </form>

        </div>
    </div>
</div>