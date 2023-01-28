<main id="main" class="main">

    <div class="pagetitle">
        <h1>Recharge - Portefeuille</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Portefeuille</li>
                <li class="breadcrumb-item active">Recharge</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recharger la portefeuille</h5>
						<?php if(isset($_GET['error'])) { ?>
                        	<p th:if="${errorMessage}" class="error" style="color:red;font-size:1.5em">Echec de l'ajout</p>
						<?php } ?>
						<?php if(isset($_GET['success'])) { ?>
                        	<p th:if="${errorMessage}" class="error" style="color:green;font-size:1.5em">Enregistrement avec succès</p>
						<?php } ?>

                        <!-- Multi Columns Form -->
						<form class="row g-3" method="POST" action="<?php echo base_url('user/wallet/add') ?>">
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Montant">
                            </div>
                            <div class="text-center col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-primary form-control">Recharger</button>
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
