<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info animate__animated animate__fadeInUp">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                <div class="form-floating">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher une participation" class="form-control">
                                    <label for="mot">Rechercher une participation</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" name="Rechercher" class="btn btn-dark w-100 h-100">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <tbody>
                                <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <form method="post" action="">
                                        <tr>
                                            <td>
                                                <select name="idpers" class="form-select">
                                                    <?php
                                                    $unControleur->setTable("personne");
                                                    $lesPersonnes = $unControleur->selectAll("*", "idpers");
                                                    foreach ($lesPersonnes as $unePersonne) { ?>
                                                        <option value="<?= $unePersonne['idpers']; ?>" <?php if ($laParticipation != null && $laParticipation['idpers'] == $unePersonne['idpers']) {echo "selected";} ?>><?= $unePersonne['nom']; ?> <?= $unePersonne['prenom']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="idevent" class="form-select">
                                                    <?php
                                                    $unControleur->setTable("evenement");
                                                    $lesEvenements = $unControleur->selectAll("*", "idevent");
                                                    foreach ($lesEvenements as $unEvenement) { ?>
                                                        <option value="<?= $unEvenement['idevent']; ?>" <?php if ($laParticipation != null && $laParticipation['idevent'] == $unEvenement['idevent']) {echo "selected";} ?>><?= $unEvenement['designation']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" name="prixtotal" placeholder="Prix total" class="form-control" value="<?= ($laParticipation != null ? $laParticipation['prixtotal'] : null); ?>"></td>
                                            <td><input type="datetime-local" name="dateheureachat" class="form-control" value="<?= ($laParticipation != null ? $laParticipation['dateheureachat'] : null); ?>"></td>
                                            <td><input type="text" name="commentaire" placeholder="Commentaire" class="form-control" value="<?= ($laParticipation != null ? $laParticipation['commentaire'] : null); ?>"></td>
                                            <td>
                                                <?php if ($laParticipation != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($laParticipation != null ? 'name="Modifier"' : 'name="Ajouter"'); ?> class="btn <?= ($laParticipation != null ? 'btn-primary' : 'btn-success w-100');  ?>"><?= ($laParticipation != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Évènement</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Heure</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Achat</th>
                                    <th scope="col">Commentaire</th>
                                    <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <th scope="col">Opérations</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lesParticipations as $uneParticipation) { ?>
                                <tr>
                                    <td><?= $uneParticipation['nom']; ?></td>
                                    <td><?= $uneParticipation['prenom']; ?></td>
                                    <td><?= $uneParticipation['designation']; ?></td>
                                    <td><?= $uneParticipation['dateevent']; ?></td>
                                    <td><?= $uneParticipation['heureevent']; ?></td>
                                    <td><?= number_format($uneParticipation['prixtotal'], 2, ',', ' '); ?> €</td>
                                    <td><?= $uneParticipation['dateheureachat']; ?></td>
                                    <td><?= $uneParticipation['commentaire']; ?></td>
                                    <?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <a href="index.php?page=3&action=edit&idpers=<?= $uneParticipation['idpers']; ?>&idevent=<?= $uneParticipation['idevent']; ?>" class="btn btn-primary">Modifier</a>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="index.php?page=3&action=sup&idpers=<?= $uneParticipation['idpers']; ?>&idevent=<?= $uneParticipation['idevent']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette participation ?'))" class="btn btn-danger">Supprimer</a>
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