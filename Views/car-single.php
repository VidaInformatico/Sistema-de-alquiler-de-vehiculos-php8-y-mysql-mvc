<?php include "Views/Templates/header1.php"; ?>

<?php include "Views/Templates/portada.php"; ?>

<section class="ftco-section ftco-car-details">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="car-details">
                    <div class="img rounded" style="background-image: url(<?php echo base_url . 'Assets/img/vehiculos/' . $data['vehiculo']['foto']; ?>);"></div>
                    <div class="text text-center">
                        <span class="subheading"><?php echo $data['vehiculo']['marca']; ?></span>
                        <h2><?php echo $data['vehiculo']['tipo']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Kilometraje
                                    <span><?php echo $data['vehiculo']['kilometraje']; ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Transmision
                                    <span><?php echo $data['vehiculo']['transmision']; ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Asientos
                                    <span><?php echo $data['vehiculo']['asientos']; ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-backpack"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Equipaje
                                    <span><?php echo $data['vehiculo']['equipaje']; ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services">
                    <div class="media-body py-md-4">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
                            <div class="text">
                                <h3 class="heading mb-0 pl-3">
                                    Combustible
                                    <span><?php echo $data['vehiculo']['combustible']; ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "Views/Templates/footer1.php"; ?>

</body>

</html>