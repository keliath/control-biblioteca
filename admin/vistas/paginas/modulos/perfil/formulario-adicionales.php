<?php

if (isset($_GET['ex'])) {
    echo '<script>
    swal({
        type:"success",
        title:"Exito",
        text: "Perfil Actualizado",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"

    }).then(function(result){
        if(result.value){
            window.location = "' . $ruta . 'admin/perfil";
        }
    });
</script>';
}

?>

<div class="col-12 col-md-8">
    <div class="card car-primary card-outline">

        <div class="card-header">

            <h5 class="m-0 text-uppercase text-secondary">
                <strong>Completar Campos del perfil</strong>
            </h5>

        </div>

        <div class="card-body">

            <h6 class="card-title">Campos adicionales del perfil</h6>

            <br>

            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id error molestias adipisci facilis neque ab vitae facere, ratione maxime fugit optio, magni mollitia corporis rerum expedita sunt explicabo sint quis?</a></p>

            <div class="form-group">

                <label for="inputName" class="control-label">Nombre Completo</label>
                <div>
                    <input type="text" class="form-control" id="inputName" value="<?php echo $usuario['usu_nombre']; ?>" readonly>
                </div>

            </div>

            <div class="form-group">

                <label for="inputEmail" class="control-label">Correo Electrónico</label>
                <div>
                    <input type="text" class="form-control" id="inputEmail" value="<?php echo $usuario['usu_email']; ?>" readonly>
                </div>

            </div>

            <div class="form-group">

                <label for="inputCedula" class="control-label">Cédula</label>
                <div>
                    <input type="text" class="form-control" id="inputCedula" value="<?php echo $usuario['usu_cedula']; ?>" readonly>
                </div>

            </div>

            <form action="" method="post">
                <div class="form-group">

                    <input type="text" name="idUsuario" value="<?php echo $usuario['id_usuario'] ?>" hidden>

                    <label for="inputPais" class="control-label">País</label>
                    <div>
                        <select class="form-control select2" name="" id="inputPais" required>

                            <?php if ($usuario['usu_pais'] != '') : ?>

                                <option value="<?php echo $usuario['usu_cedula']; ?>"><?php echo $usuario['usu_cedula']; ?></option>

                            <?php else : ?>

                                <option value="">Seleccione un País</option>

                            <?php endif ?>

                        </select>
                    </div>

                </div>

                <div class="form-group">

                    <label for="inputMovil" class="control-label">Teléfono Movíl</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="p-2 bg-info rounded-left dialCode"></span>
                        </div>
                        <input type="text" class="form-control" name="inputMovil" id="inputMovil" data-inputmask="'mask':'(999) 999-9999'" value="<?php if ($usuario['usu_celular'] != '') {
                                                                                                                                                        echo $usuario['usu_celular'];
                                                                                                                                                    } ?>" data-mask required>
                    </div>
                </div>

                <div class="form-group">

                    <label for="inputTelefono" class="control-label">Teléfono</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="p-2 bg-info rounded-left dialCode"></span>
                        </div>
                        <input type="text" class="form-control" name="inputTelefono" id="inputTelefono" data-inputmask="'mask':'(99) 999-9999'" value="<?php if ($usuario['usu_telefono'] != '') {
                                                                                                                                                            echo $usuario['usu_telefono'];
                                                                                                                                                        } ?>" data-mask required>
                    </div>
                </div>

                <div class="form-group">

                    <label for="inputDireccion" class="control-label">Dirección:</label>

                    <textarea name="inputDireccion" class="form-control" id="" cols="30" rows="5" required><?php if ($usuario['usu_direccion'] != '') {
                                                                                                                echo $usuario['usu_direccion'];
                                                                                                            } ?></textarea>

                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-dark suscribirse">Guardar</button>
                    </div>
                </div>


                <?php

                $actualizarPerfil = new ControladorUsuarios;
                $actualizarPerfil->ctrActualizarPerfilUsuario();

                ?>


            </form>

        </div>

    </div>
</div>