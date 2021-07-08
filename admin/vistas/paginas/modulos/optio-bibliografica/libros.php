<?php

if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Se ha agregado el libro",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'admin/libros";
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
                    <h1>Opciones de Líbros</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Opciones de Líbros</li>
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
                    <i class="fas fa-book text-primary"></i>
                    Líbros
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarLibro">Agregar Nuevo Líbro</button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!-- Default box -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book-open text-info"></i>
                    Lista de Líbros
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive tablaLibros" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Autor</th>
                            <th>Año</th>
                            <th>Edición</th>
                            <th>Editorial</th>
                            <th>Ubicación</th>
                            <th>ISBN</th>
                            <th>Estado</th>
                            <th>Descripción</th>
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
VENTANA MODAL AGREGAR NUEVO LIBRO
================================ -->

<!-- The Modal -->
<div class="modal" id="agregarLibro">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Nuevo Libro</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col border-right">

                            <div class="form-group">
                                <label for="inputTitulo" class="control-label">Líbro</label>
                                <input type="text" class="form-control" placeholder="Título del Líbro" name="inputTitulo" id="inputTitulo" required>
                            </div>

                            <div class="form-group">
                                <label for="inputPortada" class="control-label">Portada</label>
                                <input type="file" class="form-control-file border" name="inputPortada" required>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="inputYear" class="control-label">Año</label>
                                        <input type="text" class="form-control" name="inputYear" id="inputYear" placeholder="ej: 2017" data-inputmask="'mask':'9999'" data-mask required>
                                    </div>

                                    <div class="col">
                                        <label for="inputEdicion" class="control-label">Edición</label>
                                        <input type="text" class="form-control" placeholder="Año de edición" name="inputEdicion" id="inputEdicion" required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputIsbn" class="control-label">ISBN</label>
                                <input type="text" class="form-control" placeholder="ISBN del Líbro" name="inputIsbn" id="inputIsbn" required>
                            </div>

                            <div class="form-group">
                                <label for="inputDescripcion" class="control-label">Descripición</label>
                                <textarea class="form-control" name="inputDescripcion" id="" cols="10" rows="3" maxlength="250" placeholder="descripcion del libro"></textarea>
                            </div>

                        </div>

                        <div class="col border-left">
                            <!-- select de autores -->
                            <div class="form-group">
                                <label for="inputAutor" class="control-label">Autor</label>
                                <div>
                                    <select class="form-control select2" name="inputAutor" id="inputAutor" required>
                                        <option value="">Nombre del Autor</option>

                                        <?php

                                        $autores = ControladorAutores::ctrMostrarAutores(null, null);

                                        foreach ($autores as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id_autor'] ?>"><?php echo $value['aut_autor'] ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>

                            <!-- select de categorias-ubicacion -->
                            <div class="form-group">

                                <!-- select de categorias -->
                                <label for="inputCategoria" class="control-label">Categorías</label>
                                <div>
                                    <select class="form-control select2" name="inputCategoria" id="inputCategoria" required>
                                        <option value="">Categorías del Libro</option>

                                        <?php

                                        $autores = ControladorCategorias::ctrMostrarCategoria(null, null);

                                        foreach ($autores as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id_categoria'] ?>"><?php echo $value['cat_categoria'] ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>

                                <!-- select de ubicaciones -->
                                <div class="form-group">
                                    <label for="inputUbicacion" class="control-label">Ubicación</label>
                                    <div>
                                        <select class="form-control select2" name="inputUbicacion" id="inputUbicacion" required>
                                            <option value="">Percha / hilera</option>

                                            <?php

                                            $autores = ControladorPerchasHileras::ctrMostrarPerchaHilera(null, null);

                                            foreach ($autores as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['id_ubicacion'] ?>"><?php echo $value['ubi_percha'] . '--' . $value['ubi_hilera'] ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>

                            <!-- select de editorial  -->
                            <div class="form-group">
                                <label for="inputEditorial" class="control-label">Editorial</label>
                                <div>
                                    <select class="form-control select2" name="inputEditorial" id="inputEditorial" required>
                                        <option value="">Editorial del Libro</option>

                                        <?php

                                        $autores = ControladorEditoriales::ctrMostrarEditorial(null, null);

                                        foreach ($autores as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id_editorial'] ?>"><?php echo $value['edi_editorial'] ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $agregarLibro = new ControladorLibros();
                $agregarLibro->ctrAgregarLibro();

                ?>

            </form>

        </div>
    </div>
</div>





<!-- ==============================
VENTANA MODAL MODIFICAR LIBRO
================================ -->

<!-- The Modal -->
<div class="modal" id="modificarLibro">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modificar Libro</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modificarLibroContent">

                    
                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </div>

                <?php

                $agregarLibro = new ControladorLibros();
                $agregarLibro->ctrActualizarLibro();

                ?>

            </form>

        </div>
    </div>
</div>