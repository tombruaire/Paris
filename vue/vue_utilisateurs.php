<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info animate__animated animate__fadeInUp">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                <div class="form-floating">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher un utilisateur" class="form-control">
                                    <label for="mot">Rechercher un utilisateur</label>
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
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Adresse email</th>
                                    <th scope="col">Droits</th>
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
                                            <td><input type="text" name="nom" class="form-control" value="<?= ($leUser != null ? $leUser['nom'] : null); ?>"></td>
                                            <td><input type="text" name="prenom" class="form-control" value="<?= ($leUser != null ? $leUser['prenom'] : null); ?>"></td>
                                            <td><input type="tel" name="tel" maxlength="10" class="form-control" value="<?= ($leUser != null ? $leUser['tel'] : null); ?>"></td>
                                            <td><input type="email" name="email" class="form-control" value="<?= ($leUser != null ? $leUser['email'] : null); ?>"></td>
                                            <td>
                                                <select name="droits" class="form-select">
                                                    <option value="user" <?php if ($leUser != null && $leUser['droits'] == "user") {echo "selected";} ?>>Utilisateur</option>
                                                    <option value="admin" <?php if ($leUser != null && $leUser['droits'] == "admin") {echo "selected";} ?>>Administrateur</option>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if ($leUser != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($leUser != null ? 'name="Modifier"' : 'name="Ajouter"'); ?> class="btn <?= ($leUser != null ? 'btn-primary' : 'btn-success w-100');  ?>"><?= ($leUser != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesUsers as $unUser) { ?>
                                <tr>
                                    <td><?= $unUser['iduser']; ?></td>
                                    <td><?= $unUser['nom']; ?></td>
                                    <td><?= $unUser['prenom']; ?></td>
                                    <td><?= $unUser['tel']; ?></td>
                                    <td><?= $unUser['email']; ?></td>
                                    <td><?= $unUser['droits']; ?></td>
                                    <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <a href="index.php?page=4&action=edit&iduser=<?= $unUser['iduser']; ?>" class="btn btn-primary">Modifier</a>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="index.php?page=4&action=sup&iduser=<?= $unUser['iduser']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cet utilisateur ?'))" class="btn btn-danger">Supprimer</a>
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