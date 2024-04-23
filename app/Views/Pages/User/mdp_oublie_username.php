<main>
    <section>
        <form method="post" action="<?= base_url('oublie_mot_de_passe')?>">
            <div class="container_login">
                <h1>Mot de passe oublié</h1>

                <hr>

                <label for="username"><b>Nom d'utilisateur</b></label>
                <input class="form-control <?= ($validation->getError('username'))? 'is-invalid' : ''?>" type="text" placeholder="Entrer votre nom d'utilisateur" name="username" id="username" >
                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('username')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                <?php endif; ?>
                <hr>

                <a class="oublie_mdp" href="<?= base_url('oublie_mot_de_passe/email')?>">Vous avez oublié votre nom d'utilisateur ?</a>
                <button type="submit" name="submit" class="registerbtn">Envoie</button>
            </div>
        </form>
    </section>
</main>
