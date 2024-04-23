
<main>
    <section>
    <?php
        use App\Models\SessionModel;
       

        $societe_list = SessionModel::getAllsociete();
        ?>
        <form method="post" action="<?= base_url('Inscription/enregistrement')?>">
            <div class="container">
                <h1>Inscription</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <label for="username"><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer un nom d'utilisateur" name="username" id="username">


                <label for="société"><b>Société</b></label>

                <select name="societe">
                    <option selected="selected">Sélectionner une société</option>
                    <?php foreach ($societe_list as $s): ?>
                        <option value="<?php echo $s->societe; ?>"><?php echo $s->societe; ?></option>
                    <?php endforeach; ?>
                </select><br><br>


                <label for="mail"><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="mail" id="mail">

                <label for="mdp"><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer votre mot de passe" name="mdp" id="mdp">

                <label for="mdp-rep"><b>Répéter votre mot de passe</b></label>
                <input type="password" placeholder="Répéter le mot de passe" name="mdp-rep" id="mdp-rep">

                <hr>

                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit" name="register" class="registerbtn">Enregistrer</button>
            </div>

            <div class="container signin">
                <p>Vous avez déjà un compte? <a href="<?= base_url('Authentification');?>">Connexion</a>.</p>
            </div>
        </form>
    </section>
</main>
