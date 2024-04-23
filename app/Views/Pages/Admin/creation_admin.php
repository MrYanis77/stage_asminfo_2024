<!-- admin_affiche_user.php -->

<main>
    <section>
        <?php
        use App\Models\SessionModel;
        use App\Models\Commande_model; // Assurez-vous que le nom du modèle est correctement orthographié
        ?>

        <div class="profil">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3"></div>
                                    <div class="tab-pane active">
                                        <form method="post" action="<?= base_url('Compte/Admin/creation_admin')?>">
                                        <?= csrf_field() ?>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nom d'utilisateur</label>
                                                                <input class="form-control <?= ($validation->getError('username'))? 'is-invalid' : ''?>" type="text" name="username" placeholder="Entrer un nouveau nom d'utilisateur" id="username">
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('username')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('username') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Mot de passe</label>
                                                                <input class="form-control <?= ($validation->getError('mdp'))? 'is-invalid' : ''?>" name='mdp' type="password" placeholder="••••••" id="mdp">
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('mdp')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('mdp') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Confirmation du mot de passe</label>
                                                                <input class="form-control <?= ($validation->getError('c_mdp'))? 'is-invalid' : ''?>" name='c_mdp' type="password" placeholder="••••••" id="c_mdp">
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('c_mdp')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('c_mdp') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary"  name="submit" type="submit">Enregistrer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
