<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
 require SYSTEMPATH . 'Config/Routes.php';
}


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Accueil');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); 

//Accueil
$routes->get('Accueil', 'Accueil::index');
$routes->get('/', 'Accueil::index');

//Histoire
$routes->get('Histoire', 'Histoire::index');

//Services
$routes->get('Services', 'Services::index');

//Contact
$routes->get('Contact', 'Contact::index');

//Mentions légales
$routes->get('mentions_legales', 'mentions_legales::index');

//Tableau

$routes->get('Article', 'Article::index');


//authentification et inscription
$routes->match(['get','post'],'Authentification', 'Authentification::index');
$routes->get('Inscription', 'Inscription::index');


//Base de donnée

$routes->post('Inscription/enregistrement' , 'Inscription::enregistrement');
$routes->post('Inscription/enregistrement/connexion', 'Inscription::connexion');
$routes->post('Authentification/connexion' , 'Authentification::connexion');


//Compte
$routes->get('Compte', 'Compte::index');
$routes->get('Compte/Article', 'Compte::index');
$routes->get('Compte/deconnexion', 'Compte::deconnexion');
$routes->get('Compte/suppression', 'Compte::suppression');

//oublie mdp
$routes->match(['get','post'],'oublie_mot_de_passe', 'Compte::new_mdp_username');
$routes->match(['get','post'],'oublie_mot_de_passe/email', 'Compte::new_mdp_mail');

//Admin
//Page d'accueil
$routes->get('Compte/Admin', 'Admin::index');
//Tableau des utilisateurs
$routes->get('Compte/Admin/utilisateur', 'Admin::utilisateur');
//Création des utilisateur et envoie des mail
$routes->get('Compte/Admin/create_user', 'Admin::create_user');
//Téléchargement session
$routes->get('Compte/Admin/fichier_session','Admin::tel_session');
//Téléchargement log
$routes->get('Compte/Admin/fichier_log','Admin::tel_log');
//suppression utilisateur
$routes->post('Compte/Admin/suppression_utilisateur', 'Admin::suppression_user');
//affiche des données dans la page admin->profil utilisateur et modifie
$routes->match(['get','post'],'Compte/Admin/mise_a_jour_profil', 'Admin::update_user_admin');
//modification du mdp et username admin
$routes->match(['get','post'],'Compte/Admin/paramètre', 'Admin::parametre');
//Creation d'un admin
$routes->match(['get','post'],'Compte/Admin/creation_admin', 'Admin::ajout_admin');
//suppression d'un admin
$routes->post('Compte/Admin/suppression_admin', 'Admin::suppression_admin');
$routes->get('Compte/Admin/deconnexion', 'Admin::deconnexion');


//paramètre compte
$routes->match(['get','post'],'Compte/paramètre', 'Compte::parametre');

//Téléchargement
$routes->post('Compte/Article/téléchargement', 'Compte::telechargement');

//Mail
$routes->match(['get','post'],'email','Envoie_Email::index');