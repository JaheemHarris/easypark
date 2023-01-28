<main id="main" class="main">

    <div class="pagetitle">
        <h1>Liste des tarifs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item">Tarif</li>
                <li class="breadcrumb-item active">Liste</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des tarifs</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Délai</th>
								<th scope="col">Prix</th>
								<th scope="col">Action</th>
                            </tr>
                            </thead>
							<?php if($tarifs!=null){ ?>
                            <tbody>
								<?php for($i = 0; $i < count($tarifs); $i++){ ?>
                                <tr>
                                    <td scope="row"><?php echo $i+1 ?></td>
                                    <td><?php echo $tarifs[$i]['delai'] ?></td>
									<td><?php echo $tarifs[$i]['prix'] ?> Ariary</td>
									<td><a class="btn btn-primary" href="#">Modifier</a></td>
                                </tr>
								<?php } ?>
                            </tbody>
							<?php } ?>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
