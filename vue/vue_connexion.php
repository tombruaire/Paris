<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<h1 class="text-center text-light">Bonjour, veuillez-vous identifier.</h1>
		</div>
	</div>
</div>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="card bg-primary animate__animated animate__fadeInDown" style="max-width: 35rem;">
			<form method="post" action="" class="mt-3">
				<div class="card-body rounded">
					<div class="form-floating mb-3 text-dark">
						<input type="email" name="email" id="email" placeholder="Adresse email" class="form-control">
						<label for="email">Adresse email</label>
					</div>
					<div class="form-floating text-dark">
						<input type="password" name="mdp" id="mdp" placeholder="Mot de passe" class="form-control">
						<label for="mdp">Mot de passe</label>
					</div>
				</div>
				<div class="card-footer">
					<div class="row d-flex justify-content-center mt-3">
						<div class="col-6">
							<button type="reset" class="btn btn-danger w-100 me-2">Annuler</button>
						</div>
						<div class="col-6">
							<button type="submit" name="Connexion" class="btn btn-dark w-100">Connexion</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php if (isset($erreur)) { ?>
<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<div class="alert alert-warning alert-dismissible fade show animate__animated animate__heartBeat" role="alert">
				<strong><?= $erreur; ?></strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
