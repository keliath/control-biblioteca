<!--=====================================
DISEÑO HERO - CINEMAGRAPH
======================================-->

<div class="container-fluid vistaVideo p-0">

	<video class="d-none d-lg-block" id="videoPresentacion" muted="muted" autoplay loop preload="auto" width="100%">

		<source data-nite-src="vistas/videos/fondo-libreria.mp4" type="video/mp4">

	</video>

	<div class="filtroVideo"></div>

	<div class="container">



		<div class="row">

			<div class="col-12 col-lg-12 p-3 p-sm-4 ">

				<div class="bg-white-transparency text-center pt-3 pb-5 px-4 rounded shadow-lg">
					<h1 class="text-center pb-1 pb-lg-4">Buscar Libros</h1>

					<form action="biblioteca" method="post">

						<div class="input-group input-group-lg">

							<input type="text" name="inputBuscar" class="form-control" placeholder="Buscar por Libro, Autor, Editorial, ISBN">

							<div class="input-group-append">

								<button type="submit" class="btn btn-info pl-5 a">
									Buscar
								</button>

							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

		<div class="mx-auto text-center py-3 py-lg-5">


		</div>

	</div>

</div>