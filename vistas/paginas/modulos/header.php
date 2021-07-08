<!--=====================================
HEADER
======================================-->
<?php

$paginaInicio = false;

if (!isset($_GET['pagina']) || $_GET["pagina"] == 'inicio') {
	$paginaInicio = true;
}
?>

<header class="<?php if ($paginaInicio) {
					echo 'encabezado';
				} else {
					echo 'encabezado-alt';
				} ?>">

	<div class="container-fluid">

		<div class="container p-0">

			<div class="row">

				<!-- LOGO -->

				<div class="col-7 col-sm-5 col-md-4 col-lg-2 col-xl-3 my-3 d-flex mt-lg-3 logotipo">

					<i class="fas fa-bars d-block  <?php if (!$paginaInicio) {
														echo 'd-lg-block';
													} else {
														echo 'd-lg-none pt-3';
													} ?> text-white pt-2 pr-2" id="<?php if (!$paginaInicio) {
																						echo 'sidebarCollapse';
																					} ?>"></i>



					<a href="<?php echo $ruta; ?>inicio">
						<img data-nite-src="vistas/img/logo.png" class="img-fluid pt-1">
					</a>

				</div>

				<!-- BOTONERA -->

				<div class="d-none d-lg-block col-lg-8 col-xl-7 p-0 pt-lg-2 mt-lg-1 pt-xl-4 botonera">

					<ul class="nav justify-content-lg-left <?php if ($paginaInicio) {
																echo 'justify-content-xl-end';
															} ?> ">


						<li class="nav-item">
							<a class="nav-link text-white" href="<?php echo $ruta; ?>biblioteca">Biblioteca</a>
						</li>

						<?php if ($paginaInicio) : ?>

							<li class="nav-item">
								<a class="nav-link text-white desplazar" href="#categorias">Categorías</a>
							</li>

							<li class="nav-item">
								<a class="nav-link text-white desplazar" href="#destacados">Destacados</a>
							</li>


							</li>

							<li class="nav-item">
								<a class="nav-link text-white desplazar" href="#contactenos">Contáctenos</a>
							</li>

						<?php endif ?>

						<?php if (!$paginaInicio) : ?>

							<form class="form-inline" action="biblioteca" method="post">
								<input class="form-control mr-sm-2 input-group-sm" type="text" placeholder="Buscar" name="inputBuscar">
								<button class="btn btn-success" type="submit"><i class="fas fa-search"></i> Buscar</button>
							</form>

						<?php endif ?>

					</ul>

				</div>

				<!-- IDIOMA E INGRESO -->

				<div class="col-5 col-sm-7 col-md-8 col-lg-2 col-xl-2 p-0 pt-4 pt-lg-2 mt-lg-1 pt-xl-4">



					<!-- INGRESO -->

					<div class="mr-2 mr-lg-0 float-right pt-1 ingresos">

						<button class="btn btn-info btn-sm d-flex">

							<?php if (isset($_SESSION["validarSesion"]) && $_SESSION["validarSesion"] == "ok") : ?>

								<a href="<?php echo $ruta; ?>admin" class="text-white px-3">Ir a Mi Perfil</a>

							<?php else : ?>

								<a href="<?php echo $ruta; ?>ingreso" class="text-white">Ingresar</a>

								<span class="text-white mx-2">|</span>

								<a href="<?php echo $ruta; ?>registro" class="text-white">Crear Cuenta</a>

							<?php endif ?>

						</button>

					</div>

				</div>

			</div>

		</div>

	</div>

</header>