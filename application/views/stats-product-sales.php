<main id="main" class="main">

    <div class="pagetitle">
        <h1>Top 5 Produits</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Statistiques</li>
                <li class="breadcrumb-item active">Top 5 Produits</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top 5 des produits vendus</h5>
                        <p th:if="${errorMessage}" class="error" th:utext="${errorMessage}" style="color:red;font-size:2em"></p>

						<div class="row justify-content-center">
							<div class="col-8">
								<canvas id="chart-product-sales"></canvas>
							</div>
						</div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<!-- End #main -->
