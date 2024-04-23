<?php

namespace App\Controllers;

use App\Models\commande_model;
use App\Models\SessionModel;

class Authentification extends BaseController
{

    public function index()
    {
        return $this->authentification();
    }


    public function authentification()
    {
        SessionModel::startSession();
        $inputs = $this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[12]',
                'errors' => [
                    'required' => 'Le nom d\'utilisateur est requis.',
                    'min_length' => 'Le nom d\'utilisateur doit comporter au moins 4 caractères.',
                    'max_length' => 'Le nom d\'utilisateur ne doit pas dépasser 12 caractères.'
                ]
            ],
            'mdp' => [
                'rules' => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required' => 'Le mot de passe est requis.',
                    'min_length' => 'Le champ nouveau mot de passe doit contenir au moins 8 caractères.',
                    'max_length' => 'Le mot de passe ne doit pas dépasser 12 caractères.'
                ]
            ]
        ]);

        if (!$inputs) {
            // Affichage des erreurs de validation

            
            $titre ="AUTHENTIFICATION";

            echo view('Templates/header_black', ['title' => $titre ]);
            echo view('Pages/Form/login', ['validation' => $this->validator]);
            echo view('Templates/footer');
            return; // Sortir de la méthode si la validation échoue
            
        } else {
            
            $username = $this->request->getPost('username');
            $mot_de_passe = $this->request->getPost('mdp');

            // Vérification de l'existence de l'administrateur avec le username
            $id_admin_data = commande_model::get_id_admin_connexion($username);
            if ($id_admin_data) {
                $id_admin = $id_admin_data->id_admin;
                $user_admin = commande_model::get_admin($id_admin);
                if ($user_admin==$user_admin) {
                    SessionModel::initAdminSession([
                        'id_admin' => $user_admin->id_admin,
                        'username' => $user_admin->username_admin,
                        'logged_in_admin' => true
                    ]);
                    session()->setFlashdata('success', 'Connexion réussie');
                    return redirect()->to(base_url('Compte/Admin'));
                } else {
                    session()->setFlashdata('error', 'Nom d\'utilisateur ou mot de passe incorrect');
                    return redirect()->to(base_url('Authentification'));
                }
            }

            // Vérification de l'existence de l'utilisateur avec le username
            $id_client_data = commande_model::get_id_utilisateur_connexion($username);
            if ($id_client_data) {
                $id_client = $id_client_data->id_utilisateur;
                $user_client = commande_model::get_utilisateur($id_client);
                if ($user_client && password_verify($mot_de_passe, $user_client->mdp) === true) {
                    $societe = $user_client->societe;
                    $id_client = $user_client->id_utilisateur;
                    SessionModel::initClientSession([
                        'id_client' => $user_client->id_utilisateur,
                        'username' => $user_client->username,
                        'societe' => $user_client->societe,
                        'email' => $user_client->email,
                        'logged_in_client' => true
                    ]);
                    commande_model::insert_article($id_client, $societe);
                    session()->setFlashdata('success', 'Connexion réussie');
                    return redirect()->to(base_url('Compte/Article'));
                } else {
                    session()->setFlashdata('error', 'Nom d\'utilisateur ou mot de passe incorrect');
                    return redirect()->to(base_url('Authentification'));
                }
            } else {
                session()->setFlashdata('error', 'Nom d\'utilisateur ou mot de passe incorrect');
                return redirect()->to(base_url('Authentification'));
            }
            }
        }
    }
?>

