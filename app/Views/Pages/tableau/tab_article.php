<main>
    <section>
        <?php
        use App\Models\SessionModel;
        use App\Models\commande_model;

        // Récupération de l'ID utilisateur à partir de la session
        $id_utilisateur = SessionModel::getSessionData('id_client');
        
        // Instanciation du modèle de commande
        $commandeModel = new commande_model();
        
        // Récupération de toutes les commandes de l'utilisateur
        $commandes = $commandeModel->get_Allcommande($id_utilisateur);
        ?>
        <div class="container-article">
            <div class="titre-article">
                <h2>Bienvenue, <?= SessionModel::getSessionData('username');?></h2></br>
                <h2>Vos article </h2> <!-- Afficher le nom de la société -->
            </div>
            <div class="filtre">
                <form action="" method="get">
                <label for="date">Date:</label>
                <input type="date" class="datepicker btn-block" name="date" id="date" placeholder="Select From Date" value="<?php echo date('Y-m-d'); ?>" >
                                
                    <label for="ref">Référence: </label>
                    <input type="texte" name="nom" id ="nom" autocomplete="off">
                                
                    <label for="code">Code: </label>
                    <input type="texte" name="code" id ="code" autocomplete="off">

                    <label for="motclé">mot clé: </label>
                    <input type="texte" name="motclé" id ="motclé" autocomplete="off">
                                
                    <label for="sn">S/N: </label>
                    <input type="texte" name="sn" id ="sn" autocomplete="off">
                            
                    <input type="submit" value="Soumettre">
                </form>
            </div>
            <div class="btn-filtre">
                <form action="<?= base_url("Compte/Article/téléchargement");?>" method="post">
                    <input type="submit" name="export_excel" class="btn btn-success" value="Télécharger le tableau">
                </form>
            </div>
            <div class="tableau">
                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>Type de pièce</th>
                            <th>N° pièce</th>
                            <th>Ref. cde</th>
                            <th>Réception</th>
                            <th>Indice</th>
                            <th>Soldée</th>
                            <th>Article</th>
                            <th>Désignation courte</th>
                            <th>Description</th>
                            <th>Px Uni. HT rem.</th>
                            <th>Qté</th>
                            <th>Mt Tot HT</th>
                            <th>Observations</th>
                            <th>Famille</th>
                            <th>Qté par colis</th>
                            <th>Référence fournisseur</th>
                            <th>Remarque</th>
                            <th>Réf</th>
                            <th>Représentant</th>
                            <th>Expédition</th>
                            <th>Type de pièce 2</th> 
                            <th>N° pièce2</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        // Vérifier si des commandes ont été récupérées
                        if (!empty($commandes)) {
                            foreach ($commandes as $commande) { 
                                // Vérifier si les critères de filtrage sont remplis
                                $date_filtre = $_GET['date'] ?? '';
                                $ref_filtre = $_GET['nom'] ?? '';
                                $code_filtre = $_GET['code'] ?? '';
                                $motcle_filtre = $_GET['motclé'] ?? '';
                                $sn_filtre = $_GET['sn'] ?? '';

                                // Appliquer le filtre
                                if (($date_filtre == '' || similar_text($commande->Date_piece, $date_filtre)) &&
                                    ($ref_filtre == '' || similar_text($commande->Ref, $ref_filtre)) &&
                                    ($code_filtre == '' || similar_text($commande->Refcde, $code_filtre)) &&
                                    ($motcle_filtre == '' || similar_text($commande->Description, $motcle_filtre) > 0) &&
                                    ($sn_filtre == '' || similar_text($commande->Remarque, $sn_filtre) > 0)) {
                                    // Votre logique ici
    }
                                    ?>
                                    <!-- Affichage des données de la commande -->
                                    <tr>
                                        <td><?= $commande->Typedepiece ?></td>
                                        <td><?= $commande->Numpiece ?></td>
                                        <td><?= $commande->Refcde ?></td>
                                        <td><?= date('d/m/Y', strtotime($commande->Date_piece)) ?></td>
                                        <td><?= $commande->Indice ?></td>
                                        <td><?= $commande->Soldee ?></td>
                                        <td><?= $commande->Article ?></td>
                                        <td><?= $commande->Designationcourte ?></td>
                                        <td><?= $commande->Description ?></td>
                                        <td><?= $commande->PrixUniHTrem ?></td>
                                        <td><?= $commande->Qte ?></td>
                                        <td><?= $commande->MtTotH ?></td>
                                        <td><?= $commande->Observations ?></td>
                                        <td><?= $commande->Famille ?></td>
                                        <td><?= $commande->Qteparcolis ?></td>
                                        <td><?= $commande->Referencefournisseur ?></td>
                                        <td><?= $commande->Remarque ?></td>
                                        <td><?= $commande->Ref ?></td>
                                        <td><?= $commande->Representant?></td>
                                        <td><?= date('d/m/Y', strtotime($commande->Datepiece2)) ?></td>
                                        <td><?= $commande->Typedepiece2?></td>
                                        <td><?= $commande->Numpiece2 ?></td>
                                    </tr>
                                <?php 
                                }
                            } 
                        else {
                            // Afficher un message si aucune commande n'est en cours
                            echo  "<tr><td colspan='9'>Vous n'avez pas de commande en cours.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
