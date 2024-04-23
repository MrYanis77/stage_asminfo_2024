<?php

namespace App\Controllers;
use App\Models\SessionModel;
use App\Models\commande_model;

class Admin extends BaseController
{ 

    public function index()
    {   
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }
        return $this->admin();
    }

   
    
        public function admin()
        {
        
            $titre ="ACCUEIL ADMIN";

            echo view('Templates/header_admin', ['title' => $titre ]);
            echo view('Pages/Admin/page_admin');
            echo view('Templates/footer_emptyblack');
        }
    
        // Ajoutez d'autres méthodes du contrôleur ici...
    
    
    public function utilisateur()
    {
        SessionModel::startSession();
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }
        $titre ="GESTION DES UTILISATEURS";

        echo view('Templates/header_admin', ['title' => $titre ]);
        echo view('Pages/Admin/utilisateur_admin');
        echo view('Templates/footer_emptyblack');
    }

    public function parametre()
    {
        SessionModel::startSession();
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }
    
        // Validation des données
        
        $inputs = $this->validate([
            'username_n' => [
                'rules' => 'required|min_length[4]|max_length[12]|is_unique[admin.username_admin]',
                'errors' => [
                    'required' => 'Le nom d\'utilisateur est requis.',
                    'min_length' => 'Le champ nom d\'utilisateur doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.',
                    'is_unique' => 'Le nom d\'utilisateur est déjà pris.'
                ]
            ],
            'n_mdp' => [
                'rules' => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required' => 'Le mot de passe est requis.',
                    'min_length' => 'Le champ nouveau mot de passe doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.'
                ]
            ],
            'c_mdp' => [
                'rules' => 'required|matches[n_mdp]',
                'errors' => [
                    'required' => 'La comfirmation de mot de passe est requise.',
                    'matches' => 'Le champ Confirmation du mot de passe doit correspondre au nouveau mot de passe.'
                ]
            ]
        ]);
        
        if ((!$inputs)) {
            $titre ="PARAMETRE ADMIN";

            echo view('Templates/header_admin', ['title' => $titre ]);
            echo view('Pages/Admin/profil_admin', ['validation' => $this->validator]);
            echo view('Templates/footer_emptyblack');
            return; // Sortir de la méthode si la validation échoue
        }
        else{
            $id_admin = SessionModel::getSessionData('id_admin');
            $modelcommande = new Commande_model();
            $username = $this->request->getPost('username_n');
            //$nouveau_mdp = $this->request->getPost('n_mdp');
            $confirmation_mdp = $this->request->getPost('c_mdp');
            $modelcommande->update_username_admin($id_admin, $username);
            $modelcommande->update_mdp_admin($id_admin, $confirmation_mdp);
            return redirect()->to(base_url('Compte/Admin'));
        }
    }
    


    public function update_user_admin()
    {
        SessionModel::startSession();
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }

        // Tableau de validation des champs
        $inputs = $this->validate([
            'username_n' => [
                'rules' => 'required|min_length[4]|max_length[12]|is_unique[utilisateur.username]',
                'errors' => [
                    'required' => 'Le nom d\'utilisateur est requis.',
                    'is_unique' => 'Ce nom d\'utilisateur existe déjà.',
                    'min_length' => 'Le champ nom d\'utilisateur doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.'
                ]
            ],
            'mail' => [
                'rules' => 'required|valid_email|is_unique[utilisateur.email]',
                'errors' => [
                    'required' => 'L\'adresse e-mail est requise.',
                    'valid_email' => 'Le format de l\'adresse e-mail est incorrect.',
                    'is_unique' => 'L\'adresse mail existe déjà .'

                ]
            ],
            'n_mdp' => [
                'rules' => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required' => 'Le mot de passe est requis.',
                    'min_length' => 'Le champ nouveau mot de passe doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.'
                ]
            ],
            'c_mdp' => [
                'rules' => 'required|matches[n_mdp]',
                'errors' => [
                    'required' => 'La confirmation du mot de passe est requise.',
                    'matches' => 'Les mots de passe ne correspondent pas.'
                ]
            ]
        ]);

        if (!$inputs) {
            $id_utilisateur = $this->request->getPost('id_utilisateur');
            $commande_model = new commande_model();
            $profil = $commande_model->get_utilisateur($id_utilisateur);
    
            $titre ="MISE A JOUR UTILISATEUR";

            echo view('Templates/header_admin', ['title' => $titre ]);
            echo view('Pages/Admin/admin_affiche_user',['profil' =>$profil,'validation' => $this->validator]);
            echo view('Templates/footer_emptyblack');
            return;
        }

        else{
           
            $id_utilisateur = $this->request->getPost('id_utilisateur');
            $nouveau_username = $this->request->getPost('username_n');
            $nouveau_mail = $this->request->getPost('mail');
            $nouveau_mdp = $this->request->getPost('n_mdp');

            $commande_model = new commande_model();

            // Procéder à la modification
            $commande_model->update_username($id_utilisateur, $nouveau_username);
            $commande_model->update_mail($id_utilisateur, $nouveau_mail);
            $commande_model->update_mdp($id_utilisateur, $nouveau_mdp);
            // Rediriger vers la page de profil de l'utilisateur mis à jour
            return redirect()->to(base_url('Compte/Admin/utilisateur'));
        }
       
    }

        
    public function donnee()
    {
        SessionModel::startSession();
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }

        $titre ="UTILISATEUR";

        echo view('Templates/header_admin', ['title' => $titre ]);
        
        echo view('Templates/header_admin');
        echo view('Pages/Admin/donnee_utilisateur');   
        echo view('Templates/footer_emptyblack');
    }

    public function ajout_admin(){
        SessionModel::startSession();
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }
        
        $inputs = $this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[12]|is_unique[admin.username_admin]',
                'errors' => [
                    'required' => 'Le nom d\'utilisateur est requis.',
                    'min_length' => 'Le champ nom d\'utilisateur doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.',
                    'is_unique' => 'Le nom d\'utilisateur est déjà pris.'
                ]
            ],
            'mdp' => [
                'rules' => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required' => 'Le mot de passe est requis.',
                    'min_length' => 'Le champ nouveau mot de passe doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.'
                ]
            ],
            'c_mdp' => [
                'rules' => 'required|matches[mdp]',
                'errors' => [
                    'required' => 'La confirmation du mot de passe est requise.',
                    'matches' => 'Les mots de passe ne correspondent pas.'
                ]
            ]
        ]);

        if (!$inputs) {
        $titre ="CREATION COMPTE ADMIN";

        echo view('Templates/header_admin', ['title' => $titre ]);
        echo view('Pages/Admin/creation_admin', ['validation' => $this->validator]);   
        echo view('Templates/footer_emptyblack');
        }
        else{
             // Récupérer l'ID de l'utilisateur à partir du formulaire
             $username_admin = $this->request->getPost('username');
             //$mdp = $this->request->getPost('mdp');
             $confirmation_mdp = $this->request->getPost('c_mdp');
            commande_model::insert_admin($username_admin,$confirmation_mdp);
            return redirect()->to(base_url('Compte/Admin/'));
        }
    }
        
    

    public function tel_session()
{
    // Chemin du dossier à compresser
    $dirPath = WRITEPATH . 'session'; // Utilisation de la constante WRITEPATH de CodeIgniter pour obtenir le chemin du répertoire session

    // Nom du fichier texte à créer
    $textFileName = 'session_files.txt';

    // Récupération de la liste des fichiers dans le dossier
    $files = array_diff(scandir($dirPath), array('..', '.')); // Exclure les répertoires parent et actuel

    // Création du contenu du fichier texte
    $textContent = "Liste des fichiers dans le répertoire session :\n";
    foreach ($files as $file) {
        // Ignorer le fichier index.html
        if ($file === 'index.html') {
            continue;
        }

        // Ajouter le nom du fichier au contenu du texte
        $textContent .= "$file\n";
    }

    // Chemin complet du fichier texte
    $textFilePath = WRITEPATH . $textFileName;

    // Écrire le contenu dans le fichier texte
    if (file_put_contents($textFilePath, $textContent) !== false) {
        // Set headers pour le téléchargement
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($textFilePath) . '"');
        header('Content-Length: ' . filesize($textFilePath));

        // Envoyer le fichier pour le téléchargement
        readfile($textFilePath);
        exit;
    } else {
        // Gérer les erreurs
        return "Erreur lors de la création du fichier texte.";
    }
}



    public function tel_log()
{
    // Chemin du dossier à compresser
    $dirPath = WRITEPATH . 'logs'; // Utilisation de la constante WRITEPATH de CodeIgniter pour obtenir le chemin du répertoire session

    // Nom du fichier texte à créer
    $textFileName = 'logs_files.txt';

    // Récupération de la liste des fichiers dans le dossier
    $files = array_diff(scandir($dirPath), array('..', '.')); // Exclure les répertoires parent et actuel

    // Création du contenu du fichier texte
    $textContent = "Liste des fichiers dans le répertoire logs :\n";
    foreach ($files as $file) {
        // Ignorer le fichier index.html
        if ($file === 'index.html') {
            continue;
        }

        // Ajouter le nom du fichier au contenu du texte
        $textContent .= "$file\n";
    }

    // Chemin complet du fichier texte
    $textFilePath = WRITEPATH . $textFileName;

    // Écrire le contenu dans le fichier texte
    if (file_put_contents($textFilePath, $textContent) !== false) {
        // Set headers pour le téléchargement
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($textFilePath) . '"');
        header('Content-Length: ' . filesize($textFilePath));

        // Envoyer le fichier pour le téléchargement
        readfile($textFilePath);
        exit;
    } else {
        // Gérer les erreurs
        return "Erreur lors de la création du fichier texte.";
    }
}



    
    public function create_user(){
        $modelcommande = new commande_model();
        if($modelcommande->create_user()){
            session()->setFlashdata('success', 'Les mails ont bien été envoyer');
            return redirect()->to(base_url('Compte/Admin'));
        } else {
            session()->setFlashdata('error', 'L\'envoi à renconter un problème');
            return redirect()->to(base_url('Compte/Admin'));
        }
    }

    public function suppression_admin()
    {
        if ($this->request->getMethod() === 'post') {
                $id_admin = $this->request->getPost('id_admin');
                $count = commande_model::count_admin();
                if ($count > 1) {
                    commande_model::delete_admin($id_admin);
                    return redirect()->to(base_url('Accueil'));
                } else {
                    echo 'Requête impossible, vous devez posséder au minimum un administrateur.';
                }
            
        }
    }
   
    public function suppression()
    {
        $id_utilisateur = SessionModel::getSessionData('id_client');
        $commande_model = new commande_model(); // Utilisation de la première lettre en minuscule
        $commande_model->delete_user($id_utilisateur);
        return redirect()->to(base_url('/'));
    }

    



    public function deconnexion()
    {
        SessionModel::destructSession();
        return redirect()->to(base_url('Accueil'));
    }


    //tableau utilisateur

    public function suppression_user()
    {
        // Vérifier si le formulaire a été soumis
        if ($this->request->getMethod() === 'post') {
            // Récupérer le nom d'utilisateur depuis le formulaire
            $id_utilisateur = $this->request->getPost('id_utilisateur');

            // Supprimer l'utilisateur en utilisant le nom d'utilisateur
            if ($id_utilisateur) {
                $commande_model = new Commande_model();
                $commande_model->delete_user($id_utilisateur);
                // Rediriger vers la page d'accueil ou une autre page après la suppression
                return redirect()->to(base_url('Compte/Admin/utilisateur'));
            }
        }

        // Si le formulaire n'a pas été soumis ou s'il manque des données, rediriger vers la page d'accueil
        return redirect()->to(base_url('/'));
    

}

}