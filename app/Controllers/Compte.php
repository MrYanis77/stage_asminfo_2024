<?php

namespace App\Controllers;
use App\Models\SessionModel;
use App\Models\commande_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Compte extends BaseController
{

    public function index()
    {
        SessionModel::startSession();
        if (!SessionModel::verifySession()) {
            return redirect()->to(base_url('Authentification'));
        }
        return $this->article();
    }

    
    public function article()
    {
        $titre ="VOS ARTICLES";
        echo view('Templates/header_compte', ['title' => $titre ]);
        echo view('Pages/tableau/tab_article');
        echo view('Templates/footer_emptyblack');
    }


    public function parametre()
{
    SessionModel::startSession();
    if (!SessionModel::verifySession()) {
        return redirect()->to(base_url('Authentification'));
    }

    
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
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'L\'adresse e-mail est requise.',
                    'valid_email' => 'Le format de l\'adresse e-mail est incorrect.'
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
        

        // Valider les données
        if (!$inputs) {
            $titre ="PROFIL";
            echo view('Templates/header_compte', ['title' => $titre ]);
            echo view('Pages/User/profil', ['validation' => $this->validator]);
            echo view('Templates/footer_emptyblack');
        } else {
            $username = $this->request->getPost('username_n');
            $mail = $this->request->getPost('mail');
            $nouveau_mdp = $this->request->getPost('n_mdp');
            $confirmation_mdp = $this->request->getPost('c_mdp');
            $id_utilisateur = SessionModel::getSessionData('id_client');
            $commande_model = new commande_model();
            $commande_model->update_username($id_utilisateur, $username);
            $commande_model->update_mail($id_utilisateur, $mail);
            $commande_model->update_mdp($id_utilisateur, $nouveau_mdp);
            return redirect()->to(base_url('Compte/Article'));

        }
    }

    public function new_mdp_username()
    {
    
        
        $inputs = $this->validate([
                'username' => [
                    'rules' => 'required|is_not_unique[utilisateur.username]',
                    'errors' => [
                        'required' => 'Le nom d\'utilisateur est requis.',
                        'is_not_unique' => 'Cette adresse email n\'existe pas.',
                    ]
                ]
            ]);
            if (!$inputs) {
                echo view('Templates/header_black');
                echo view('Pages/User/mdp_oublie_username', ['validation' => $this->validator]);
                echo view('Templates/footer');
            }else{
                $username = $this->request->getPost('username');
                $commande_model = new commande_model();
                try{
                    $id= $commande_model->get_id_utilisateur_connexion($username);
                    $id_utilisateur = $id->id_utilisateur;
                    $user_mail = $commande_model->get_utilisateur($id_utilisateur);
                    $commande_model->email_mdp($user_mail->id_utilisateur,$user_mail->email);
                    return redirect()->to(base_url('Authentification'));
                }catch(\Exception $e){
                    return redirect()->to(base_url('oublie_mot_de_passe'));
                }
               
            }
    }

    
    public function new_mdp_mail()
    {
        $inputs = $this->validate([
            'mail' => [
                'rules' => 'required|valid_email|is_not_unique[utilisateur.email]',
                'errors' => [
                    'required' => 'L\'adresse e-mail est requise.',
                    'valid_email' => 'Le format de l\'adresse e-mail est incorrect.',
                    'is_not_unique' => 'Cette adresse email n\'existe pas.'
                ]
            ]
        ]);
        if (!$inputs) {
            echo view('Templates/header_black');
            echo view('Pages/User/mdp_oublie_mail', ['validation' => $this->validator]);
            echo view('Templates/footer');
        }else{
            $mail= $this->request->getPost('mail');
            $commande_model = new commande_model();
            try{
                $id= $commande_model->get_id_utilisateur_mail($mail);
                $id_utilisateur = $id->id_utilisateur;
                $user_mail = $commande_model->get_utilisateur($id_utilisateur);
                $commande_model->email_username_mdp($user_mail->id_utilisateur,$user_mail->username,$user_mail->email);
                return redirect()->to(base_url('Authentification'));
            }catch(\Exception $e){
                return redirect()->to(base_url('oublie_mot_de_passe'));
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
    

    public function telechargement()
{
    SessionModel::startSession();
    // Récupérer les données du tableau depuis le modèle
    $id_utilisateur = SessionModel::getSessionData('id_client');
    $commandeModel = new commande_model();
    $commandes = $commandeModel->get_Allcommande($id_utilisateur);

    // Créer un nouvel objet Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Définir les en-têtes de colonnes
    $sheet->setCellValue('A1', 'Type de pièce');
    $sheet->setCellValue('B1', 'N° pièce');
    $sheet->setCellValue('C1', 'Ref. cde');
    $sheet->setCellValue('D1', 'Réception');
    $sheet->setCellValue('E1', 'Indice');
    $sheet->setCellValue('F1', 'Soldée');
    $sheet->setCellValue('G1', 'Article');
    $sheet->setCellValue('H1', 'Désignation courte');
    $sheet->setCellValue('I1', 'Description');
    $sheet->setCellValue('J1', 'Px Uni. HT rem.');
    $sheet->setCellValue('K1', 'Qté');
    $sheet->setCellValue('L1', 'Mt Tot HT');
    $sheet->setCellValue('M1', 'Observations');
    $sheet->setCellValue('N1', 'Famille');
    $sheet->setCellValue('O1', 'Qté par colis');
    $sheet->setCellValue('P1', 'Référence fournisseur');
    $sheet->setCellValue('Q1', 'Remarque');
    $sheet->setCellValue('R1', 'Réf');
    $sheet->setCellValue('S1', 'Représentant');
    $sheet->setCellValue('T1', 'Expédition');
    $sheet->setCellValue('U1', 'Type de pièce 2');
    $sheet->setCellValue('V1', 'N° pièce2');

    // Remplir les données dans le fichier Excel
    $row = 2;
    foreach ($commandes as $commande) {
        $sheet->setCellValue('A' . $row, $commande->Typedepiece);
        $sheet->setCellValue('B' . $row, $commande->Numpiece);
        $sheet->setCellValue('C' . $row, $commande->Refcde);
        $sheet->setCellValue('D' . $row, $commande->Date_piece);
        $sheet->setCellValue('E' . $row, $commande->Indice);
        $sheet->setCellValue('F' . $row, $commande->Soldee);
        $sheet->setCellValue('G' . $row, $commande->Article);
        $sheet->setCellValue('H' . $row, $commande->Designationcourte);
        $sheet->setCellValue('I' . $row, $commande->Description);
        $sheet->setCellValue('J' . $row, $commande->PrixUniHTrem);
        $sheet->setCellValue('K' . $row, $commande->Qte);
        $sheet->setCellValue('L' . $row, $commande->MtTotH);
        $sheet->setCellValue('M' . $row, $commande->Observations);
        $sheet->setCellValue('N' . $row, $commande->Famille);
        $sheet->setCellValue('O' . $row, $commande->Qteparcolis);
        $sheet->setCellValue('P' . $row, $commande->Referencefournisseur);
        $sheet->setCellValue('Q' . $row, $commande->Remarque);
        $sheet->setCellValue('R' . $row, $commande->Ref);
        $sheet->setCellValue('S' . $row, $commande->Representant);
        $sheet->setCellValue('T' . $row, $commande->Datepiece2);
        $sheet->setCellValue('U' . $row, $commande->Typedepiece2);
        $sheet->setCellValue('V' . $row, $commande->Numpiece2);
        $row++;
    }

        $writer = new Xlsx($spreadsheet);
        // Envoyer le fichier en tant que téléchargement
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="commandes.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
   
}




    public function deconnexion()
    {
        SessionModel::destructSession();
        return redirect()->to(base_url('Accueil'));
    }
}

