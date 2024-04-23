<?php

use App\Models\SessionModel;
?>
<main>
    <section>
        <div class="container_admin">
            <div class="title-container">
                <h1>Bienvenue, <?= SessionModel::getSessionData('username');?></h1>
            </div>
            <div class="btn-container">
                <div class="btn-createuser">
                    <button onclick="window.location.href='<?= base_url('Compte/Admin/create_user'); ?>'">Création des utilisateurs/Envoie</button>
                </div>
                <div class="btn-addadmin">
                    <button onclick="window.location.href='<?= base_url('Compte/Admin/creation_admin'); ?>'">+ Ajouter un admin</button>
                </div>
                <div class="btn-telsession">
                    <button onclick="window.location.href='<?= base_url('Compte/Admin/fichier_session'); ?>'">Téléchargement des données Sessions</button>
                <div>
                <div class="btn-telsession">
                <button onclick="window.location.href='<?= base_url('Compte/Admin/fichier_log'); ?>'">Téléchargement des données Logs</button>
                <div>
        
            </div>
        </div>
    </section>
</main>