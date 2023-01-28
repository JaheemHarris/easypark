<main id="main" class="main">

    <div class="pagetitle">
        <h1>Liste des recettes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item">Recette</li>
                <li class="breadcrumb-item active">Liste</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des recettes</h5>

						<?php if($receipts!=null){ ?>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Recette</th>
								<th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
								<?php for($i = 0; $i < count($receipts); $i++){ ?>
                                <tr>
                                    <td scope="row"><?php echo $receipts[$i]['id'] ?></td>
                                    <td><?php echo $receipts[$i]['receipt_name'] ?></td>
									<td><a class="btn btn-primary" href="#">Details</a></td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
						<div class="row justify-content-center">
							<div col-md-8>
									<?php echo $links ?>
							</div>
						</div>
						<?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
