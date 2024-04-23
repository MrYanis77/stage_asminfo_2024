<main>
    <section>
        <?php
        use App\Models\SessionModel;
        $validation = Config\Services::validation();
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
                                        <form method="post" action="<?= base_url('Compte/Admin/paramètre')?>">
                                            <?= csrf_field() ?>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nouveau nom d'utilisateur</label>
                                                                <input class="form-control <?= ($validation->getError('username_n'))? 'is-invalid' : ''?>" type="text" name="username_n" placeholder="Entrer un nouveau nom d'utilisateur" id="username_n">
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('username_n')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('username_n') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 mb-3">
                                                    <div class="mb-2"><b>Changer de mot de passe</b></div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nouveau mot de passe</label>
                                                                <input class="form-control <?= ($validation->getError('n_mdp'))? 'is-invalid' : ''?>" name='n_mdp' type="password" placeholder="••••••" id="n_mdp">
                                                                <!-- Affichage du message d'erreur pour le champ nouveau mot de passe -->
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('n_mdp')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('n_mdp') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Confirmation du mot de passe</label>
                                                                <input class="form-control <?= ($validation->getError('c_mdp'))? 'is-invalid' : ''?>" name='c_mdp' type="password" placeholder="••••••" id="c_mdp" >
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('c_mdp')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('c_mdp') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary" name="submit" type="submit">Sauvegarder</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <form action="<?= base_url('Compte/Admin/suppression_admin') ?>" method="post">
                                                <input type="hidden" name="id_admin" value="<?= SessionModel::getSessionData('id_admin');?>">
                                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte admin ?')">Supprimer</button>
                                            </form>
                                        </div>
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
