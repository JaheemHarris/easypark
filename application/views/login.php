<div class="main">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Accueil</a></li>
			<li><a href="#">Compte</a></li>
			<li class="active">Connexion</li>
		</ul>
		<!-- BEGIN SIDEBAR & CONTENT -->
		<div class="row margin-bottom-40">
			<!-- BEGIN SIDEBAR -->

			<!-- END SIDEBAR -->

			<!-- BEGIN CONTENT -->
			<div class="col-md-12 col-sm-7">
				<h1>Connectez-vous</h1>
				<div class="content-form-page">
					<form role="form" class="form-horizontal form-without-legend" action="<?php echo base_url('user/account/auth') ?>" method="POST" >
						<div class="form-group">
							<label class="col-lg-2 control-label" for="email">E-Mail <span class="require">*</span></label>
							<div class="col-lg-6">
								<input type="text" id="email" name="email" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label" for="password">Mot de passe <span class="require">*</span></label>
							<div class="col-lg-6">
								<input type="password" id="password" name="password" class="form-control">
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6 col-md-offset-2 padding-left-0 padding-top-20">
								<button class="btn btn-primary" type="submit">Se connecter</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END CONTENT -->
		</div>
		<!-- END SIDEBAR & CONTENT -->
	</div>
</div>
