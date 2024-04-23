<?php

namespace App\Controllers;

use App\Models\Commande_model;

class Envoie_Email extends BaseController
{
    public function index()
    {
        $modelMail = new Commande_model();
        $comptes = $modelMail->get_user_profil_mail();
        
        $email = \Config\Services::email();
        
        $email->setfrom($email->fromEmail, $email->fromName);
        $email->setSubject("Suivi de commande ASMINFO");
       
       
        $message = "
            Madame, Monsieur <br><br>
            Voici vos identifiants pour suivre votre réparation : <br><br>
            Identifiant: ".$comptes->username." <br>
            Mot de passe: ".$comptes->mdp." <br><br>
            Lien de connexion : https://www.asminfo.fr/
        ";
        
        $email->clear();
        $email->setTo($comptes->email);
        $email->setMessage($message);
        
        if ($email->send()) {
            echo "Mail envoyé";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail: " . $email->printDebugger();
        }
        
    }

}
