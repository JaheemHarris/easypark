<main id="main" class="main">

    <div class="pagetitle">
        <h1>Stock - Produits</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item">Stock</li>
                <li class="breadcrumb-item active">Produits</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quantité en stock des produits</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Utilisateur</th>
								<th scope="col">Email</th>
								<th scope="col">Montant à recharger</th>
                                <th scope="col">Date</th>
								<th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
								<?php for($i = 0; $i < count($wallet); $i++){ ?>
                                <tr>
                                    <td scope="row"><?php echo $i+1 ?></td>
                                    <td><?php echo $wallet[$i]->firstname." ".$wallet[$i]->lastname ?></td>
									<td><?php echo $wallet[$i]->email ?></td>
									<td>Ar <?php echo $wallet[$i]->entry ?></td>
									<td><?php echo $wallet[$i]->transaction_date ?></td>
									<td><a class="btn btn-primary" href="<?php echo base_url('admin/wallet/validate/').$wallet[$i]->id ?>">Valider</a></td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
						<div class="row justify-content-center">
							<div col-md-8>
									
							</div>
						</div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
