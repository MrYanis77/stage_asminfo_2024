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
                                        <form method="post" action="<?= base_url('Compte/Admin/mise_a_jour_profil');?>">
                                        <?= csrf_field() ?>
                                            <input type="hidden" name="id_utilisateur" value="<?= $profil->id_utilisateur ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nom d'utilisateur actuel</label>
                                                                <input class="form-control" type="text" disabled="disabled" placeholder="<?= $profil->username ?>" id="username_a">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nouveau nom d'utilisateur</label>
                                                                <input class="form-control <?= ($validation->getError('username_n'))?  'is-invalid' : '' ?>" type="text" name="username_n" placeholder="Entrer un nouveau nom d'utilisateur" id="username_n">
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('username_n')): ?>                                                                   
                                                                    <p class="invalid-feedback"><?= $validation->getError('username_n') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Société</label>
                                                                <input class="form-control" type="text" disabled="disabled" placeholder="<?= $profil->societe ?>" id="societe">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Email actuel</label>
                                                                <input class="form-control" type="text" disabled="disabled" placeholder="<?= $profil->email ?>" id="mail_a">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nouvel email</label>
                                                                <input class="form-control <?= ($validation->getError('mail'))? 'is-invalid' : ''?>" type="text" name="mail" placeholder="Entrer un nouveau mail" id="mail">
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('mail')): ?>                                                                    
                                                                    <p class="invalid-feedback"><?= $validation->getError('mail') ?></p>
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
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('n_mdp')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('n_mdp') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Confirmation du mot de passe</span></label>
                                                                <input class="form-control <?= ($validation->getError('c_mdp'))? 'is-invalid' : ''?>" name='c_mdp' type="password" placeholder="••••••" id="c_mdp" >
                                                                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('c_mdp')): ?>
                                                                    <p class="invalid-feedback"><?= $validation->getError('c_mdp') ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary"  name="submit" type="submit">Sauvegarder</button>
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
