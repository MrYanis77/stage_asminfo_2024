<main>
    <section>
        <form method="post" action="<?= base_url('oublie_mot_de_passe/email')?>">
            <div class="container_login">
                <h1>Identifiant oublié</h1>

                <hr>

                <label for="mail"><b>Adresse mail</b></label>
                <input class="form-control <?= ($validation->getError('mail'))? 'is-invalid' : ''?>" type="text" placeholder="Entrer votre adresse email" name="mail" id="mail" >
                <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && $validation->hasError('mail')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('mail') ?></div>
                <?php endif; ?>
                <hr>
                <button type="submit" name="submit" class="registerbtn">Envoie</button>
            </div>
        </form>
    </section>
</main>
