<?php include "Views/Templates/header1.php"; ?>

<?php include "Views/Templates/portada.php"; ?>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="car-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th class="bg-primary heading">Tarifa por hora</th>
								<th class="bg-dark heading">Tarifa por día</th>
								<th class="bg-black heading">Arrendamiento</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data['vehiculos'] as $car) { ?>
							<tr class="">
								<td class="car-image">
									<div class="img" style="background-image:url(<?php echo base_url . 'Assets/img/vehiculos/' . $car['foto']; ?>);"></div>
								</td>
								<td class="product-name">
									<h3><?php echo $car['tipo']; ?></h3>
									<p class="mb-0 rated">
										<span><?php echo $car['marca']; ?></span>
									</p>
								</td>

								<td class="price">
									<p class="btn-custom"><a href="<?php echo base_url . 'reservas?car=' . $car['id']; ?>">Reservar</a></p>
									<div class="price-rate">
										<h3>
											<span class="num"><small class="currency">$</small> <?php echo $car['precio_hora']; ?></span>
											<span class="per">/por hora</span>
										</h3>
										<!-- <span class="subheading">Recargos por combustible de $3/hora</span> -->
									</div>
								</td>

								<td class="price">
									<p class="btn-custom"><a href="<?php echo base_url . 'reservas?car=' . $car['id']; ?>">Reservar</a></p>
									<div class="price-rate">
										<h3>
											<span class="num"><small class="currency">$</small> <?php echo $car['precio_dia']; ?></span>
											<span class="per">/por dia</span>
										</h3>
										<!-- <span class="subheading">Recargos por combustible de $3/hora</span> -->
									</div>
								</td>

								<td class="price">
									<p class="btn-custom"><a href="<?php echo base_url . 'reservas?car=' . $car['id']; ?>">Reservar</a></p>
									<div class="price-rate">
										<h3>
											<span class="num"><small class="currency">$</small> <?php echo $car['precio_mes']; ?></span>
											<span class="per">/por mes</span>
										</h3>
										<!-- <span class="subheading">Recargos por combustible de $3/hora</span> -->
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<?php include "Views/Templates/footer1.php"; ?>

</body>

</html>