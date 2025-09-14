<div class="ladoUsuarios">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-lg-4 formulario">

                <figure class="p-2 p-sm-5 p-lg-4 p-xl-5 text-center">

                    <a href="<?php echo $ruta; ?>inicio"><img src="vistas/img/logo-positivo.png" class="img-fluid"></a>

                    <form class="mt-5" action="" method="post">

                        <div class="d-flex justify-content-between">

                            <h4>Ingreso al sistema</h4>

                            

                        </div>

                        <p class="text-center py-3">Accede a tu cuenta para gestionar préstamos, reservar libros y explorar nuestro catálogo completo de literatura.</p>

                        <input type="email" class="form-control my-3 py-3" placeholder="Correo Electrónico" name="ingresoEmail" required>

                        <input type="password" class="form-control my-3 py-3" placeholder="Contraseña" name="ingresoPassword" required>

                        <?php

                        $ingreso = new ControladorUsuarios();
                        $ingreso->crtIngresoUsuario();

                        ?>

                        <input type="submit" class="form-control my-3 py-3 btn btn-info" value="Ingresar">

                        <p class="text-center py-3">¿Aún no tienes una cuenta? | <a href="<?php echo $ruta; ?>registro">Regístrate</a></p>

                        <hr>

                        <p class="text-center py-3"><a href="#RecuperarPassword" data-toggle="modal" data-target="#recuperarPassword">¿Olvidó su contraseña?</a></p>


                    </form>

                </figure>

            </div>

            <div class="col-12 col-lg-8 fotoIngreso text-center">

                <a href="<?php echo $ruta; ?>inicio"><button class="d-none d-lg-block text-center btn btn-default btn-lg my-3 text-white btnRegresar">Regresar</button></a>

                <a href="<?php echo $ruta; ?>inicio"><button class="d-block d-lg-none text-center btn btn-default btn-lg btn-block my-3 text-white btnRegresarMovil">Regresar</button></a>

                <ul class="p-0 m-0 py-4 d-flex justify-content-center redesSociales">

                    <li>
                        <a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white mx-4"></i></a>
                    </li>

                    <li>
                        <a href="#" target="_blank"><i class="fab fa-instagram lead text-white mx-4"></i></a>
                    </li>


                    <li>
                        <a href="#" target="_blank"><i class="fab fa-youtube lead text-white mx-4"></i></a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>


<!-- ==============================
VENTANA MODAL RECUPERAR PASSWORD
================================ -->

<!-- The Modal -->
<div class="modal" id="recuperarPassword">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Recuperar Contraseña</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form action="" method="post">

                    <p class="text-muted">Escriba su correo electrónico con el que estas registrado y allí le enviaremos una nueva contraseña</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-envelope"></i>
                            </span>
                        </div>

                        <input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>
                    </div>

                    <input type="submit" class="btn btn-dark btn-block" value="Enviar">



                    <div class="modal-footer ">

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>

                </form>

                <?php

                $recuperarPassword = new ControladorUsuarios();
                $recuperarPassword->ctrRecuperarPassword();

                ?>

            </div>


        </div>
    </div>
</div>