<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info animate__animated animate__fadeInUp">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                <div class="form-floating">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher une personne" class="form-control">
                                    <label for="mot">Rechercher une personne</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" name="Rechercher" class="btn btn-dark w-100 h-100">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Adresse email</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Adresse</th>
                                    <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <th scope="col">Opérations</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <form method="post" action="">
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="nom" class="form-control" value="<?= ($laPersonne != null ? $laPersonne['nom'] : null); ?>"></td>
                                            <td><input type="text" name="prenom" class="form-control" value="<?= ($laPersonne != null ? $laPersonne['prenom'] : null); ?>"></td>
                                            <td><input type="email" name="email" class="form-control" value="<?= ($laPersonne != null ? $laPersonne['email'] : null); ?>"></td>
                                            <td><input type="tel" name="tel" maxlength="10" class="form-control" value="<?= ($laPersonne != null ? $laPersonne['tel'] : null); ?>"></td>
                                            <td><input type="text" name="adresse" class="form-control" value="<?= ($laPersonne != null ? $laPersonne['adresse'] : null); ?>"></td>
                                            <td>
                                                <?php if ($laPersonne != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($laPersonne != null ? 'name="Modifier"' : 'name="Ajouter"'); ?> class="btn <?= ($laPersonne != null ? 'btn-primary' : 'btn-success w-100');  ?>"><?= ($laPersonne != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesPersonnes as $unePersonne) { ?>
                                <tr>
                                    <td><?= $unePersonne['idpers']; ?></td>
                                    <td><?= $unePersonne['nom']; ?></td>
                                    <td><?= $unePersonne['prenom']; ?></td>
                                    <td><?= $unePersonne['email']; ?></td>
                                    <td><?= $unePersonne['tel']; ?></td>
                                    <td><?= $unePersonne['adresse']; ?></td>
                                    <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <a href="index.php?page=2&action=edit&idpers=<?= $unePersonne['idpers']; ?>" class="btn btn-primary">Modifier</a>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="index.php?page=2&action=sup&idpers=<?= $unePersonne['idpers']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette personne ?'))" class="btn btn-danger">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>