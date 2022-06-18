<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info animate__animated animate__fadeInUp">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                <div class="form-floating">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher un évènement" class="form-control">
                                    <label for="mot">Rechercher un évènement</label>
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
                                    <th scope="col">Désignation</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Heure</th>
                                    <th scope="col">Lieu</th>
                                    <th scope="col">Inscrits</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Prix place</th>
                                    <th scope="col">Places totales</th>
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
                                            <td><input type="text" name="designation" class="form-control" value="<?= ($lEvent != null ? $lEvent['designation'] : null); ?>"></td>
                                            <td><input type="date" name="dateevent" class="form-control" value="<?= ($lEvent != null ? $lEvent['dateevent'] : null); ?>"></td>
                                            <td><input type="time" name="heureevent" class="form-control" value="<?= ($lEvent != null ? $lEvent['heureevent'] : null); ?>"></td>
                                            <td><input type="text" name="lieuevent" class="form-control" value="<?= ($lEvent != null ? $lEvent['lieuevent'] : null); ?>"></td>
                                            <td><input type="number" name="inscrits" class="form-control" value="<?= ($lEvent != null ? $lEvent['inscrits'] : null); ?>"></td>
                                            <td><input type="text" name="description" class="form-control" value="<?= ($lEvent != null ? $lEvent['description'] : null); ?>"></td>
                                            <td><input type="text" name="prixplace" class="form-control" value="<?= ($lEvent != null ? $lEvent['prixplace'] : null); ?>"></td>
                                            <td><input type="number" name="placestotal" class="form-control" value="<?= ($lEvent != null ? $lEvent['placestotal'] : null); ?>"></td>
                                            <td>
                                                <?php if ($lEvent != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($lEvent != null ? 'name="Modifier"' : 'name="Ajouter"'); ?> class="btn <?= ($lEvent != null ? 'btn-primary' : 'btn-success w-100');  ?>"><?= ($lEvent != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesEvenements as $unEvenement) { ?>
                                <tr>
                                    <td><?= $unEvenement['idevent']; ?></td>
                                    <td><?= $unEvenement['designation']; ?></td>
                                    <td><?= $unEvenement['dateevent']; ?></td>
                                    <td><?= $unEvenement['heureevent']; ?></td>
                                    <td><?= $unEvenement['lieuevent']; ?></td>
                                    <td><?= $unEvenement['inscrits']; ?></td>
                                    <td><?= $unEvenement['description']; ?></td>
                                    <td><?= $unEvenement['prixplace']; ?> €</td>
                                    <td><?= $unEvenement['placestotal']; ?></td>
                                    <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <a href="index.php?page=1&action=edit&idevent=<?= $unEvenement['idevent']; ?>" class="btn btn-primary">Modifier</a>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="index.php?page=1&action=sup&idevent=<?= $unEvenement['idevent']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cet évènement ?'))" class="btn btn-danger">Supprimer</a>
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