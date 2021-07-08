<!--=====================================
MENÚ MÓVIL
======================================-->

<div class="menuMovil">

	<ul class="p-0 m-0 py-4 d-flex justify-content-center">

		<li>
			<i class="fas fa-times lead text-white mr-5"></i>
		</li>

		<li>
			<a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white ml-5 mx-2"></i></a>
		</li>

		<li>
			<a href="#" target="_blank"><i class="fab fa-instagram lead text-white mx-2"></i></a>
		</li>

		<li>
			<a href="#" target="_blank"><i class="fab fa-linkedin lead text-white mx-2"></i></a>
		</li>

		<li>
			<a href="#" target="_blank"><i class="fab fa-twitter lead text-white mx-2"></i></a>
		</li>

		<li>
			<a href="#" target="_blank"><i class="fab fa-youtube lead text-white mx-2"></i></a>
		</li>

	</ul>

	<ul class="nav flex-column text-center  mt-3">


		<li class="nav-item py-3">
			<form class="text-center" action="biblioteca" method="post">
				<div class="input-group  mb-3 px-2">
					<input class="form-control  " type="text" placeholder="Buscar" name="inputBuscar">
					<div class="input-group-append">
						<button class="btn btn-success btn-lg" type="submit"><i class="fas fa-search"></i> Buscar</button>
					</div>
				</div>

			</form>
		</li>

		<li class="nav-item py-3">
			<a class="nav-link text-white" href="<?php echo $ruta ?>biblioteca">Biblioteca</a>
		</li>

		<li class="nav-item py-3">
			<a class="nav-link text-white click" href="#categorias">Categorías</a>
		</li>

		<li class="nav-item py-3">
			<a class="nav-link text-white click" href="#destacados">Destacados</a>
		</li>

		<li class="nav-item py-3">
			<a class="nav-link text-white click" href="#contactenos">Contáctenos</a>
		</li>

	</ul>

</div>