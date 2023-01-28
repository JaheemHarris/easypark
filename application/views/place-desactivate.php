<main id="main" class="main">

	<div class="pagetitle">
		<h1>Désactivation-Place</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
				<li class="breadcrumb-item">Place</li>
				<li class="breadcrumb-item active">Désactivation</li>
			</ol>
		</nav>
	</div>
	<!-- End Page Title -->

	<section class="section">
		<div class="row justify-content-center">
			<div class="col-lg-10">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Désactiver une place de parking</h5>
						<?php if (isset($_GET['error'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:red;font-size:1.5em">Cette place est encore occupée </p>
						<?php } ?>
						<?php if (isset($_GET['success'])) { ?>
							<p th:if="${errorMessage}" class="error" style="color:green;font-size:1.5em">Place désactivée</p>
						<?php } ?>

						<!-- Horizontal Form -->
						<div class="row justify-content-center">
						<form class="col-md-8 col-sm-12" method="POST" action="<?php echo base_url('admin/place/desactivate') ?>">
							<div class="row mb-3">
								<label for="place" class="col-sm-4 col-form-label">Place</label>
								<div class="col-sm-8">
									<select class="form-select" name="place" id="place" >
										<?php if($places!=null){ ?>
											<?php forEach($places as $place) { ?>
												<option value="<?php echo $place['id'] ?>"> Parking n° <?php echo $place['numero'] ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Désactiver</button>
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
