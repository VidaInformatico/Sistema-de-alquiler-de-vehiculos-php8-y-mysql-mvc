<?php include "Views/Templates/header1.php"; ?>

<?php include "Views/Templates/portada.php"; ?>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<?php foreach ($data['vehiculos'] as $car) { ?>
				<div class="col-md-4">
					<div class="car-wrap rounded ftco-animate">
						<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo base_url . 'Assets/img/vehiculos/' . $car['foto']; ?>);">
						</div>
						<div class="text">
							<h2 class="mb-0"><a href="#"><?php echo $car['tipo']; ?></a></h2>
							<div class="d-flex mb-3">
								<span class="cat"><?php echo $car['marca']; ?></span>
								<p class="price ml-auto">$<?php echo $car['precio_dia']; ?> <span>/dia</span></p>
							</div>
							<p class="d-flex mb-0 d-block"><a href="<?php echo base_url . 'reservas?car=' . $car['id']; ?>" class="btn btn-primary py-2 mr-1">Reservar ahora</a> 
							<a href="<?php echo base_url . 'cars/single/' . $car['id']; ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<!-- <div class="row mt-5">
			<div class="col text-center">
				<div class="block-27">
					<ul>
						<li><a href="#">&lt;</a></li>
						<li class="active"><span>1</span></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&gt;</a></li>
					</ul>
				</div>
			</div>
		</div> -->
	</div>
</section>

<?php include "Views/Templates/footer1.php"; ?>

</body>

</html>