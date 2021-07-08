<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
        <img src="vistas/img/plantilla/icono.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Biblioteca Alls</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <?php

                $rutaFoto = "vistas/img/usuarios/default/default.png";

                if ($usuario["usu_foto"] != NULL) {
                    $rutaFoto = $usuario["usu_foto"];
                }

                ?>

                <img src="<?php echo $rutaFoto; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="perfil" class="d-block"><?php echo $usuario["usu_nombre"] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="inicio" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="perfil" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Mi Perfil</p>
                    </a>
                </li>

                <?php if ($usuario["usu_perfil"] == "admin") : ?>

                    <li class="nav-item">
                        <a href="usuarios" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>

                <?php endif ?>

                <li class="nav-item">
                    <a href="<?php echo $ruta ?>biblioteca" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>ir a biblioteca</p>
                    </a>
                </li>


                <?php if ($usuario["usu_perfil"] == "admin") : ?>

                    <li class="nav-item has-treeview">
                        <a href="optio-bibliografica" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Optio Bibliográfica
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="libros" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Libros</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="autores" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Autores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="editoriales" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Editoriales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="categorias" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categorias</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="perchas-hileras" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perchas/Hileras</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="optio-bibliografica" class="nav-link">
                            <i class="nav-icon fas fa-columns"></i>
                            <p>
                                Procesos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="solicitudes" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Solicitudes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="prestamos" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Prestamos pendientes</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="reporte-general" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Reportes</p>
                        </a>
                    </li>

                <?php else : ?>

                    <li class="nav-item">
                        <a href="mi-reporte" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Mi Historial</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="soporte" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Soporte</p>
                        </a>
                    </li>

                <?php endif ?>





                <li class="nav-item">
                    <a href="salir" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar Sesión</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>