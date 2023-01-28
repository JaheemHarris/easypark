<main id="main" class="main">

	<div class="pagetitle">
		<h1>Se garer</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
				<li class="breadcrumb-item">Place</li>
				<li class="breadcrumb-item active">Se garer</li>
			</ol>
		</nav>
	</div>
	<!-- End Page Title -->

	<section class="section">
		<div class="row justify-content-center">
			<div class="col-lg-10">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Ajouter une voiture - place de parking n° <?php echo $numero ?></h5>
						<?php if (isset($_GET['error'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:red;font-size:1.5em">Echec de l'ajout <?php if($_GET['error']=='-2') echo "Pas assez d'argent!" ?></p>
						<?php } ?>
						<?php if (isset($_GET['infr'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:red;font-size:1.5em">Voiture déja en infraction.</p>
						<?php } ?>
						<?php if (isset($_GET['success'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:green;font-size:1.5em">Enregistrement avec succès</p>
						<?php } ?>

						<!-- Horizontal Form -->
						<div class="row justify-content-center">
						<form class="col-md-8 col-sm-12" method="POST" action="<?php echo base_url('user/place/addPark') ?>">
							<input type="text" name="place" value="<?php echo $place ?>" hidden>
							<input type="text" name="park" value="<?php echo $numero ?>" hidden>
							<div class="row mb-3">
								<label for="numero" class="col-sm-4 col-form-label">Numéro d'immatriculation</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="numero" name="numero">
								</div>
							</div>
							<div class="row mb-3">
								<label for="tarif" class="col-sm-4 col-form-label">Tarif</label>
								<div class="col-sm-8">
									<select class="form-select" name="tarif" >
										<?php if($tarifs!=null){ ?>
											<?php forEach($tarifs as $tarif) { ?>
												<option value="<?php echo $tarif['id'] ?>"><?php echo $tarif['delai'].' - '.$tarif['prix'].' Ar' ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<label for="heure_arrivee" class="col-sm-4 col-form-label">Heure d'arrivée</label>
								<div class="col-sm-8">
									<input type="datetime-local" class="form-control" id="heure_arrivee" name="heure_arrivee" step="1" value="<?php echo date('Y-m-d\TH:i:s',strtotime($heure)) ?>">
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Valider</button>
								<button type="reset" class="btn btn-secondary">Annuler</button>
							</div>
						</form><!-- End Horizontal Form -->
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

</main>
<!-- End #main -->
