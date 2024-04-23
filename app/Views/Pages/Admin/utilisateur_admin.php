<main>
    <section>
        <?php
            use App\Models\commande_model; 
            $utilisateurs = commande_model::getAllutilisateur(); // Utiliser $utilisateurs plutôt que $user
        ?>
        <div class="container_gestion_user">
            <div class="titre_gestion">
                <h2>Gestion des utilisateurs </h2> <!-- Afficher le nom de la société -->
            </div>
            <div class="filtre_gestion">
                <form action="" method="get">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="texte" name="username" id="username" autocomplete="off">
                            
                    <label for="societe">Société:</label>
                    <input type="texte" name="societe" id="societe" autocomplete="off">
                            
                    <label for="email">Email:</label>
                    <input type="texte" name="email" id="email" autocomplete="off">
                            
                    <label for="date_creation">Date de création:</label>
                    <input type="date" class="datepicker btn-block" name="date_creation" id="date_creation" placeholder="Sélectionnez une date">
                        
                    <label for="date_modification">Date de modification:</label>
                    <input type="date" class="datepicker btn-block" name="date_modification" id="date_modification" placeholder="Sélectionnez une date">
                        
                    <label for="date_suppression">Date de suppression:</label>
                    <input type="date" class="datepicker btn-block" name="date_suppression" id="date_suppression" placeholder="Sélectionnez une date">
                            
                    <input type="submit" value="Soumettre">
                </form>
            </div>
            <div class="tableau">
                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Société</th>
                            <th>Email</th>
                            <th>Mot de passe</th>
                            <th>Date de création</th>
                            <th>Date de modification</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $username_filtre = $_GET['username'] ?? '';
                        $societe_filtre = $_GET['societe'] ?? '';
                        $email_filtre = $_GET['email'] ?? '';
                        $date_creation_filtre = $_GET['date_creation'] ?? '';
                        $date_modification_filtre = $_GET['date_modification'] ?? '';
                    
                        // Appliquer le filtre
                        if (!empty($utilisateurs)) {
                            foreach ($utilisateurs as $utilisateur) {
                                if (($username_filtre == '' || $utilisateur->username == $username_filtre) &&
                                    ($societe_filtre == '' || $utilisateur->societe == $societe_filtre) &&
                                    ($email_filtre == '' || $utilisateur->email == $email_filtre) &&
                                    ($date_creation_filtre == '' || $utilisateur->date_creation == $date_creation_filtre) &&
                                    ($date_modification_filtre == '' || $utilisateur->date_modification == $date_modification_filtre)) {
                        ?>
                            <tr>
                                <td><?= $utilisateur->id_utilisateur?></td>
                                <td><?= $utilisateur->username ?></td>
                                <td><?= $utilisateur->societe ?></td>
                                <td><?= $utilisateur->email ?></td>
                                <td><?= $utilisateur->mdp ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($utilisateur->date_création)) ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($utilisateur->date_modification)) ?></td>
        
                                <td>
                                    <form action="<?= base_url('Compte/Admin/mise_a_jour_profil') ?>" method="post">
                                        <input type="hidden" name="id_utilisateur" value="<?= $utilisateur->id_utilisateur ?>">
                                        <button type="submit">Modifier</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('Compte/Admin/suppression_utilisateur') ?>" method="post">
                                        <input type="hidden" name="id_utilisateur" value="<?= $utilisateur->id_utilisateur ?>">
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                    </form>
                                
                                </td>
                            </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
