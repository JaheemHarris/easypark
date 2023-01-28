<main id="main" class="main">

    <div class="pagetitle">
        <h1>Heure - Modifier</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Heure</li>
                <li class="breadcrumb-item active">Modifier</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Changer l'heure actuelle</h5>
						<?php if(isset($_GET['error'])) { ?>
                        	<p class="error" style="color:red;font-size:1.5em">Echec de la modification</p>
						<?php } ?>
						<?php if(isset($_GET['success'])) { ?>
                        	<p class="error" style="color:green;font-size:1.5em">Modification réussie</p>
						<?php } ?>

                        <!-- Multi Columns Form -->
						<form class="row g-3" method="POST" action="<?php echo base_url('admin/heure/modifier') ?>">
							<h5>Heure actuelle: <?php echo $heure ?></h5>
                            <div class="col-md-6 col-sm-12">
                                <input type="datetime-local" class="form-control" id="heure" step="1" name="heure" value="<?php echo date('Y-m-d\TH:i:s',strtotime($heure)) ?>">
                            </div>
                            <div class="text-center col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-primary form-control">Modifier</button>
                            </div>
                        </form>
                        <!-- End Multi Columns Form -->
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<!-- End #main -->
