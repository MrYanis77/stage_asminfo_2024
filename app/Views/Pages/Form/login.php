<main>
    <section>
        
        <?php if (session()->getFlashdata('success')):?>
            <div class="alert alert-success" role="alert">
                <?=(session()->getFlashdata('success'));?>
            </div> 
        <?php endif;?>

        <form method="post" action="<?= base_url('Authentification')?>">
        <?php $validation = \Config\Services::validation();?>
            <div class="container_login">
                <h1>Connexion</h1>

                <hr>

                <label for="username"><b>Nom d'utilisateur</b></label>
                <input class="form-control <?= ($validation->getError('username'))? 'is-invalid' : ''?>" type="text" placeholder="Entrer votre nom d'utilisateur" name="username" id="username" >
                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('username')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')):?>
                    
                        <?=(session()->getFlashdata('error'));?>
                    
                <?php endif;?>
                </br>
                <label for="mdp"><b>Mot de passe</b></label>
                <input class="form-control <?= ($validation->getError('mdp'))? 'is-invalid' : ''?>" type="password" placeholder="Entrer votre mot de passe" name="mdp" id="psw" >
                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('mdp')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('mdp') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')):?>
                    
                        <?=(session()->getFlashdata('error'));?>
                    
                <?php endif;?>

                <hr>

                <a class="oublie_mdp" href="<?= base_url('oublie_mot_de_passe')?>">Mot de passe oublié ?</a>
                <button type="submit" name="submit" class="registerbtn">Connexion</button>
            </div>
        </form>
    </section>
</main>
