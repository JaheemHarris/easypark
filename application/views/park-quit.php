<main id="main" class="main">

	<div class="pagetitle">
		<h1>Se Retirer</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
				<li class="breadcrumb-item">Place</li>
				<li class="breadcrumb-item active">Quitter</li>
			</ol>
		</nav>
	</div>
	<!-- End Page Title -->

	<section class="section">
		<div class="row justify-content-center">
			<div class="col-lg-10">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Quitter - place de parking n° <?php echo $numero ?></h5>
						<?php if (isset($_GET['error'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:red;font-size:1.5em">Echec  <?php if($_GET['error']=='-2') echo "Pas assez d'argent!" ?></p>
						<?php } ?>
						<?php if (isset($_GET['success'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:green;font-size:1.5em">Succès</p>
						<?php } ?>

						<!-- Horizontal Form -->
						<div class="row justify-content-center">
						<form class="col-md-8 col-sm-12" method="POST" action="<?php echo base_url('user/place/leave') ?>">
							<input type="text" name="place" value="<?php echo $place ?>" hidden>
							<input type="text" name="park" value="<?php echo $numero ?>" hidden>
							<input type="text" name="id" value="<?php echo $placement->id ?>" hidden>
							<div class="row mb-3">
								<label for="numero" class="col-sm-4 col-form-label">Numéro d'immatriculation</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="numero" name="numero" value="<?php echo $placement->numero_voiture ?>">
								</div>
							</div>
							<div class="row mb-3">
								<label for="heure_arrivee" class="col-sm-4 col-form-label">Heure de sortie</label>
								<div class="col-sm-8">
									<input type="datetime-local" class="form-control" id="heure_depart" name="heure_depart" step="1" value="<?php echo date('Y-m-d\TH:i:s',strtotime($heure)) ?>">
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Retirer</button>
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
