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
                                <th scope="col">Produit</th>
								<th scope="col">Catégorie</th>
                                <th scope="col">Quantité disponible</th>
                            </tr>
                            </thead>
                            <tbody>
								<?php for($i = 0; $i < count($products_instock); $i++){ ?>
                                <tr>
                                    <td scope="row"><?php echo $products_instock[$i]->id ?></td>
                                    <td><?php echo $products_instock[$i]->product_name ?></td>
									<td><?php echo $products_instock[$i]->category_name ?></td>
									<td><?php echo $products_instock[$i]->quantity ?></td>
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

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
