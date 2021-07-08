<div class="col-12 col-md-4">
    <div class="card card-info card-outline">
        <div class="card-body box-profile">
            <div class="text-center">

                <?php

                $rutaFoto = "vistas/img/usuarios/default/default.png";

                if ($usuario["usu_foto"] != NULL) {
                    $rutaFoto = $usuario["usu_foto"];
                }

                ?>
                <img class="profile-user-img img-fluid img-circle" src="<?php echo $rutaFoto ?>" alt="">
            </div>


            <h3 class="profile-username text-center">
                <?php echo $usuario["usu_nombre"]; ?>
            </h3>

            <p class="text-muted text-center">
                <?php echo $usuario["usu_email"]; ?>
            </p>

            <div class="text-center">

                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cambiarFoto">Cambiar Foto</button>
                <button class="btn btn-purple btn-sm" data-toggle="modal" data-target="#cambiarPassword">Cambiar contraseña</button>

            </div>
        </div>
        <div class="card-footer">

            <button class="btn btn-default float-right">Eliminar Cuenta</button>

        </div>
    </div>
</div>

<!-- ==============================
VENTANA MODAL CAMBIO DE FOTO
================================ -->

<!-- The Modal -->
<div class="modal" id="cambiarFoto">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cambiar imagen</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idUsuarioFoto" value="<?php echo $usuario['id_usuario'] ?>">

                    <div class="form-group">
                        <input type="file" class="form-control-file border" name="cambiarImagen" required>

                        <input type="hidden" name="fotoActual" value="<?php echo $usuario["usu_foto"] ?>">
                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $cambiarImagen = new ControladorUsuarios();
                $cambiarImagen->ctrCambiarFotoPerfil();

                ?>

            </form>

        </div>
    </div>
</div>


<!-- ==============================
VENTANA MODAL CAMBIO DE CONTRASEÑA
================================ -->

<!-- The Modal -->
<div class="modal" id="cambiarPassword">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cambiar Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario['id_usuario'] ?>">

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Nueva Contraseña" name="cambiarPassword" required>

                    </div>

                </div>

                <!-- Modal footer ----------- d-flex justify-content-between estas dos clases son para separar a extremos los contenidos -->
                <div class="modal-footer ">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>

                <?php

                $cambiarPassword = new ControladorUsuarios();
                $cambiarPassword->ctrCambiarPassword();

                ?>

            </form>

        </div>
    </div>
</div>