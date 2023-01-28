<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div id="topdf">
		<h2><?php echo $place->numero_voiture ?></h2>
		<h2>Heure début: <?php echo $place->heure_arrivee ?></h2>
		<h2>Delai: <?php echo $place->delai ?></h2>
		<h2>Heure prévue: <?php echo $place->heure_prevue ?></h2>
		<h2>Heure fin: <?php echo $place->heure_depart ?></h2>
		<h2>Remise: <?php echo $place->remise ?></h2>
		<h2>Montant parking: <?php echo $place->montant ?> Ariary</h2>
		<h2>Montant amende: <?php echo $place->montant_amende ?> Ariary</h2>
	</div>

	<button onclick="exportPdf()">Pdf</button>

	<script src="<?php echo base_url('assets/jquery.min.js')?>"></script>
	<script src="<?php echo base_url('assets/jspdf.min.js')?>"></script>

	<script>
            function exportPdf(){
                var doc = new jsPDF();
                var elementHTML = $('#topdf').html();
                var specialElementHandlers = {
                    '#test': function (element, renderer) {
                        return true;
                    }
                };
                doc.fromHTML(elementHTML, 10, 10, {
                    'width': 100,
                    'elementHandlers': specialElementHandlers
                });

                // Save the PDF
                doc.save('ticket.pdf');
            }
        </script>
</body>
</html>
