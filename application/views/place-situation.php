<main id="main" class="main">

    <div class="pagetitle">
        <h1>Situation - Parking</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item">Place</li>
                <li class="breadcrumb-item active">Situation</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Situation dans le parking</h5>

						<h5 class="card-title">Heure de référence: <?php echo $heure ?></h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
							
                            <thead>
                            <tr>
                                <th scope="col">Numéro de voiture</th>
                                <th scope="col">Heure debut</th>
								<th scope="col">Durée </th>
								<th scope="col">Heure Fin</th>
								<th scope="col">Heure Départ</th>
								<th scope="col">Montant parking</th>
								<th scope="col">Montant amende</th>
                            </tr>
                            </thead>
							<?php if($situations!=null){ ?>
                            <tbody>
								<?php for($i = 0; $i < count($situations); $i++){ ?>
                                <tr>
                                    <td scope="row"><a href="<?php echo base_url('admin/place/to_pdf/').$situations[$i]['id_park'] ?>"><?php echo $situations[$i]['numero_voiture'] ?></a></td>
                                    <td><?php echo $situations[$i]['heure_arrivee'] ?></td>
									<td><?php echo $situations[$i]['delai'] ?></td>
									<td><?php echo $situations[$i]['heure_prevue'] ?></td>
									<td><?php echo $situations[$i]['heure_depart'] ?></td>
									<td><?php echo $situations[$i]['montant'] ?> Ariary</td>
									<td><?php echo $situations[$i]['montant_amende'] ?> Ariary</td>
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
