<?php

$categorias = ControladorCategorias::ctrMostrarCategoria(null, null);

?>


<!-- Sidebar Holder -->
<nav id="sidebar">
    <!-- <div class="sidebar-header">
    </div> -->

    <ul class="list-unstyled CTAs">

    </ul>

    <ul class="list-unstyled components">

        <form class="d-block d-lg-none text-center mt-2" action="biblioteca" method="post">
            <div class="input-group  mb-3 px-2">
                <input class="form-control  " type="text" placeholder="Buscar" name="inputBuscar">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </div>

        </form>

        <li class="text-center pt-1">
            <h4>Categorias</h4>
        </li>
        <hr class="text-white">

        <li class="activeSidebar clck">
            <a href="<?php echo $ruta . 'biblioteca' ?>" class="nav-link text-white">Todas</a>
        </li>

        <?php
        foreach ($categorias as $key => $value) {
        ?>

            <li class="clck">
                <a href="<?php echo $ruta . 'biblioteca?cat=' . $value['id_categoria'] ?>" class="nav-link text-white"><?php echo $value['cat_categoria'] ?></a>
            </li>

        <?php
        }
        ?>

    </ul>


</nav>