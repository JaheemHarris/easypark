<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ajout - Recette</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Gestion recette</li>
                <li class="breadcrumb-item active">Ajout</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter une nouvelle recette</h5>
                        <p th:if="${errorMessage}" class="error" th:utext="${errorMessage}" style="color:red;font-size:2em"></p>

                        <!-- Multi Columns Form -->
                        <form class="row g-3" th:method="POST" th:action="@{/vehicule/trajet/add}" >
							<div class="col-md-6 col-sm-12">
                                <label for="receipt" class="form-label">Nom de la recette</label>
                                <input type="text" class="form-control" id="receipt" onchange="setReceiptHidden();"  name="receipt">
                            </div>
						</form>
						<form class="row g-3">
							<h5 class="card-title">Ajouter la formule</h5>
                            <div class="col-md-6 col-sm-12">
                                <label for="product" class="form-label">Produit</label>
                                <select id="product" name="product" class="form-select js-example-basic-single">
									<?php forEach($products as $product){ ?>
										<option value="<?php echo $product->id ?>"><?php echo $product->product_name ?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="percentage" class="form-label">Pourcentage</label>
                                <input type="number" class="form-control" min="1" id="percentage" name="percentage">
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="addDetail()">Ajouter</button>
                            </div>
                        </form>

						<h5 class="card-title">Details  de la recette</h5>
						<div class="row g-3 justify-content-center">
							<div class="col-md-6 table-responsive">
								<table class="table">
									<thead class="thead-dark">
										<tr>
											<td scope="col">Produit</td>
											<td scope="col">Pourcentage</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody id="receipt-details"></tbody>
								</table>
							</div>
						</div>
                        <!-- End Multi Columns Form -->
						
						<div class="row g-3 justify-content-center">
							<form class="col-md-3" method="POST" action="<?php echo base_url('admin/receipt/add') ?>">
								<input type="text" name="receipt-name" id="receipt-name" hidden>
								<input type="text" name="details-receipt" id="details-receipt" hidden>
								<button class="btn btn-primary">Valider</button>
							</form>
						</div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
<!-- End #main -->
