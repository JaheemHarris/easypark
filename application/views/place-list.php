<main id="main" class="main">

    <div class="pagetitle">
        <h1>Liste des places de parking</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item">Place</li>
                <li class="breadcrumb-item active">Parking</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des places de parking</h5>

						<div class="row justify-content-center">
							<?php $libre=0; $infraction=0; $occupee = 0; $indisponible = 0; ?>
							<?php forEach($places as $place) { ?>
								<div class="col-md-3 col-sm-4 justify-content-center">
									<?php if($place['est_occupe'] == 0 && $place['est_desactive'] == 1) { $indisponible++; ?>
										<div class="card col-md-8 col-sm-12" role="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $place['id_place'] ?>" style="height: 200px; background-color:dimgray;">
											<div class="card-body">
												<h5 class="card-title">Parking n° <?php echo $place['numero'] ?></h5>
											</div>
										</div>
									<?php } ?>
									<?php if($place['est_occupe'] == 0 && $place['est_desactive'] == 0) { $libre++; ?>
										<div class="card col-md-8 col-sm-12" role="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $place['id_place'] ?>" style="height: 200px; background-color:lightgreen;">
											<div class="card-body">
												<h5 class="card-title">Parking n° <?php echo $place['numero'] ?></h5>
											</div>
										</div>
									<?php } ?>
									<?php if($place['est_occupe'] == 1 && $place['infraction']==0) { $occupee++; ?>
										<div class="card col-md-8 col-sm-12" role="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $place['id_place'] ?>" style="height: 200px; background-color: orangered;">
											<div class="card-body">
												<h5 class="card-title">Parking n° <?php echo $place['numero'] ?></h5>
												<h5 class="card-title">Numero immatriculation <?php echo $place['numero_voiture'] ?></h5>
											</div>
										</div>
									<?php } ?>
									<?php if($place['est_occupe'] == 1 && $place['infraction']==1) { $infraction++; ?>
										<div class="card col-md-8 col-sm-12" role="button" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $place['id_place'] ?>" style="height: 200px; background-color: gold;">
											<div class="card-body">
												<h5 class="card-title">Parking n° <?php echo $place['numero'] ?></h5>
												<h5 class="card-title">Numero immatriculation <?php echo $place['numero_voiture'] ?></h5>
											</div>
										</div>
									<?php } ?>
									<div class="modal fade" id="modal-<?php echo $place['id_place'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Parking n° <?php echo $place['numero'] ?></h5>
												<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<?php if($place['est_occupe'] == 0 && $place['est_desactive'] == 0) { ?>
												<div class="modal-body">
													<h5 class="card-title">Etat: Libre</h5>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
													<a type="button" class="btn btn-primary" href="<?php echo base_url('user/place/park/').$place['id_place'].'/'.$place['numero'] ?>">Placer une voiture</a>
												</div>
											<?php } ?>
											<?php if($place['est_occupe'] == 0 && $place['est_desactive'] == 1) { ?>
												<div class="modal-body">
													<h5 class="card-title">Etat: Indisponible</h5>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
												</div>
											<?php } ?>
											<?php if($place['est_occupe'] == 1 && $place['infraction']==0) { ?>
												<div class="modal-body">
													<h5 class="card-title">Etat: Occupée</h5>
													<h5 class="card-title">Numero voiture:  <?php echo $place['numero_voiture'] ?></h5>
													<h5 class="card-title">Heure d'arrivée: <?php echo $place['heure_arrivee'] ?></h5>
													<h5 class="card-title">Durée prévue: <?php echo $place['delai'] ?></h5>
													<h5 class="card-title">Délai de départ: Dans <?php echo $place['heure_reste'] ?></h5>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
													<a type="button" class="btn btn-primary" href="<?php echo base_url('user/place/quit/').$place['id_place'].'/'.$place['numero'] ?>">Se retirer</a>
												</div>
											<?php } ?>
											<?php if($place['est_occupe'] == 1 && $place['infraction']==1) { ?>
												<div class="modal-body">
													<h5 class="card-title">Etat: Infraction</h5>
													<h5 class="card-title">Amende forfaitaire: <?php echo $place['montant_amende'] ?> Ar</h5>
													<h5 class="card-title">Numero voiture:  <?php echo $place['numero_voiture'] ?></h5>
													<h5 class="card-title">Heure d'arrivée: <?php echo $place['heure_arrivee'] ?></h5>
													<h5 class="card-title">Durée prévue: <?php echo $place['delai'] ?></h5>
													<h5 class="card-title">Dépassé de: <?php echo $place['heure_reste'] ?></h5>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
													<a type="button" class="btn btn-primary" href="<?php echo base_url('user/place/quit/').$place['id_place'].'/'.$place['numero'] ?>">Se retirer</a>
												</div>
											<?php } ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="row">
							<div class="col-md-5 col-sm-12">
								<h5 class="card-title">Libre : <?php echo $libre ?></h5>
								<h5 class="card-title">Occupée : <?php echo $occupee ?></h5>
								<h5 class="card-title">Infraction : <?php echo $infraction ?></h5>
								<h5 class="card-title">Indisponible : <?php echo $indisponible ?></h5>
							</div>
						</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
