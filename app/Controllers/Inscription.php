<?php

namespace App\Controllers;

use App\Models\SessionModel;
use App\Models\SocieteModel;
use App\Models\UserModel;

class Inscription extends BaseController
{
    public function index()
    {
        return $this->inscription();
    }

    public function inscription($page = 'register')
    {
        if (!is_file(APPPATH . 'Views/Pages/Form/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page);
        echo view('Templates/header', $data);
        echo view('Pages/Form/' . $page);
        echo view('Templates/footer', $data);
    }

    public function enregistrement()
    {
        if ($this->request->getMethod() === 'post') {
            // Récupération des données du formulaire
            $username = $this->request->getPost('username');
            $societe_u = $this->request->getPost('societe');
            $mail = $this->request->getPost('mail');
            $mdp = $this->request->getPost('mdp');
            
            // Vérification si la société existe déjà dans la base de données
            $societeModel = new SocieteModel();
            $usermodel = new UserModel();
            $societe_e = $societeModel->where('societe', $societe_u)->first();
            $username_verif =  $usermodel->where('username', $username)->first();
            


            // Vérification de l'existence du nom d'utilisateur
            if ($username_verif) {
                // Redirection avec un message d'erreur si le nom d'utilisateur n'existe pas
                return redirect()->to(base_url('Inscription'))->with('error', 'Le nom d\'utilisateur n\'existe pas. Veuillez choisir un autre nom d\'utilisateur.');
            }



            try {
                // Récupérer l'ID de la société existante
                $id_societe = $societe_e['id_societe'];

                // Insertion des données de l'utilisateur dans la table des utilisateurs
                $data = [
                    'username' => $username,
                    'societe' => $societe_u,
                    'email' => $mail,
                    'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
                    'id_user_societe' => (int)$id_societe
                ];

                // Insertion de l'utilisateur et initialisation de la session
                $id_utilisateur = SessionModel::insert_utilisateur($data);
                SessionModel::insert_client($id_utilisateur);
                SessionModel::start_session();
                SessionModel::init_session($id_utilisateur);

                // Redirection vers la page Compte/Article
                return redirect()->to(base_url('Compte/Article'));
                
            } catch (\Exception $e) {
                // En cas d'erreur, redirection vers la page Inscription avec un message d'erreur
                return redirect()->to(base_url('Inscription'))->with('error', 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.');
            }
        }
    }
}
?>
