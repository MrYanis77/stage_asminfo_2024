<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Time;
class commande_model extends Model
{
    public static function get_utilisateur($id_utilisateur){
        $db = \Config\Database::connect();
        $builder = $db->table('utilisateur');
        $builder->select('*');
        $builder->where('id_utilisateur', $id_utilisateur);
        $query = $builder->get();
        
        return $query->getRow();
    }

    
    public static function get_id_utilisateur_connexion($username){
        $db = \Config\Database::connect();
        $builder = $db->table('utilisateur');
        $builder->select('id_utilisateur');
        $builder->where('username', $username);
        $query = $builder->get();
        
        return $query->getRow();
    }

    public static function get_id_utilisateur_mail($mail){
        $db = \Config\Database::connect();
        $builder = $db->table('utilisateur');
        $builder->select('id_utilisateur');
        $builder->where('email', $mail);
        $query = $builder->get();
        
        return $query->getRow();
    }

    public static function getAllutilisateur(){
        $db = \Config\Database::connect();
        $builder = $db->table('utilisateur');
        $builder->select('*');
        $query = $builder->get();
        
        return $query->getResult();
    }
    

    public static function get_admin($id_admin){
        $db = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->select('*');
        $builder->where('id_admin', $id_admin);
        $query = $builder->get();
        
        return $query->getRow();
    }

    public static function get_Alladmin()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->select('*');
        $query = $builder->get();
        
        return $query->getResult();
    }

    public static function get_id_admin_connexion($username){
        $db = \Config\Database::connect();
        $builder = $db->table('admin');
        $builder->select('id_admin');
        $builder->where('username_admin', $username);
        $query = $builder->get();
        
        return $query->getRow();
    }
    
    public function get_Allcommande($id_utilisateur){
        $db = \Config\Database::connect();
        $builder = $db->table('article');
        $builder->select('*');
        $builder->join('client', 'client.id_client = article.id_client');
        $builder->where('client.id_utilisateur', $id_utilisateur);
        $query = $builder->get();
        
        return $query->getResult(); // Retourner un tableau d'objets contenant les données des commandes
    }
    

    public static function getAllsociete()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('societe');
        $builder->select('id_societe,societe,mail');
        $query = $builder->get();
        
        return $query->getResult();
    }

    public static function get_id_client($id_utilisateur){
        $db = \Config\Database::connect();
        $builder = $db->table('client');
        $builder->select('*');
        $builder->where('id_client', $id_utilisateur);
        $query = $builder->get();
        
        return $query->getRow();
    }
  
     //Modification profil user
    public function  delete_user($id_utilisateur):void{
        $db = \Config\Database::connect();
    
        // Supprimer les articles associés au client de cet utilisateur
        $builder_article = $db->table('Article');
        $builder_article->where('id_client IN (SELECT id_client FROM Client WHERE id_utilisateur = ' . $id_utilisateur . ')', null, false);
        $builder_article->delete();
        
        // Supprimer les enregistrements dans la table Client liés à cet utilisateur
        $builder_client = $db->table('Client');
        $builder_client->where('id_utilisateur', $id_utilisateur);
        $builder_client->delete();
        
        // Supprimer l'utilisateur de la table Utilisateur
        $builder_utilisateur = $db->table('Utilisateur');
        $builder_utilisateur->where('id_utilisateur', $id_utilisateur);
        $builder_utilisateur->delete();
    }

    //Modification du profil client
    public static function delete_admin ($id_admin){
        $db = \Config\Database::connect();
        
        // Supprimer les enregistrements dans la table Client liés à cet utilisateur
        $builder = $db->table('admin');
        $builder->where('id_admin', $id_admin);
        $builder->delete();
        
    }

    public function update_mail($id_utilisateur,$mail){
        $db = \Config\Database::connect();
        $db->query('UPDATE utilisateur SET email = :mail: WHERE id_utilisateur = :id_utilisateur:;',['mail' => $mail, 'id_utilisateur'=>$id_utilisateur]);
    }
    
    public function update_username($id_utilisateur,$username){
        $db = \Config\Database::connect();
        $db->query('UPDATE utilisateur SET username = :username: WHERE id_utilisateur = :id_utilisateur:;',['username' => $username, 'id_utilisateur'=>$id_utilisateur]);
    }

    public function update_mdp($id_utilisateur,$mdp_c){
        $db = \Config\Database::connect();
        $db->query('UPDATE utilisateur SET mdp = :mdp_c: WHERE id_utilisateur = :id_utilisateur:;',['mdp_c' => password_hash($mdp_c, PASSWORD_BCRYPT,['cost'=>10]), 'id_utilisateur'=>$id_utilisateur]);
    }

    //Modification profil admin

    public function update_username_admin($id_admin,$username){
        $db = \Config\Database::connect();
        $db->query('UPDATE admin SET username_admin = :username: WHERE id_admin = :id_admin:;',['username' => $username, 'id_admin'=>$id_admin]);
    }

    public function update_mdp_admin($id_admin,$mdp_c){
        $db = \Config\Database::connect();
        $db->query('UPDATE admin SET mdp = :mdp_c: WHERE id_admin = :id_admin:;',['mdp_c' => password_hash($mdp_c, PASSWORD_BCRYPT,['cost'=>10]), 'id_admin'=>$id_admin]);
    }

    public function update_mail_societe($mail,$societe){
        $db = \Config\Database::connect();
        $db->query('UPDATE societe SET mail = :mail_u: WHERE societe = :societe_u:;',['mail_u' => $mail, 'societe_u'=>$societe]);
    }
    

    


    //creation admin

    public static function insert_admin($username_admin, $confirmation_mdp): void {
        $db = \Config\Database::connect();
        $data = [
            'username' => $username_admin,
            'mdp' => password_hash($confirmation_mdp, PASSWORD_BCRYPT,['cost'=>10])
        ];
        $db->query('INSERT INTO admin (username_admin, mdp) VALUES (:username:, :mdp:)', $data);
    }
    
    public static function verif_email($email){
        $db = \Config\Database::connect();
        $builder = $db->table('utilisateur');
        $builder->select('id_utilisateur,username,email,mdp');
        $builder->where('email', $email);
        $query = $builder->get();
        $query->getResult();

        return $query->getRow();
    }

    public static function verif_societe($societe_nom){
        $db = \Config\Database::connect();
        $builder = $db->table('societe');
        $builder->select('id_societe');
        $builder->where('societe', $societe_nom);
        $query = $builder->get();
        $query->getResult();

        return $query->getResult();
    }

    
    

    public static function count_admin (){
        $db = \Config\Database::connect();
        
        // Supprimer les enregistrements dans la table Client liés à cet utilisateur
        $builder = $db->table('admin');
        $builder->select('*');
        $query = $builder->get();

        return $query->getNumRows();
       
    }

    public function insert_utilisateur($data)
{
    $db = \Config\Database::connect();
    $query = "INSERT INTO utilisateur (username, email, societe, mdp, id_user_societe) VALUES (:username:, :email:, :societe:, :mdp:, :id_user_societe:)";
    $params = [
        'username' => $data['username'],
        'email' => $data['email'],
        'societe' => $data['societe'],
        'mdp' => $data['mdp'],
        'id_user_societe' => $data['id_user_societe']
    ];
    $db->query($query, $params);
}

public function insert_client($id_utilisateur)
{
    $db = \Config\Database::connect();
    $query = "INSERT INTO client (id_utilisateur) VALUES (:id_utilisateur:)";
    $params = [
        'id_utilisateur' => $id_utilisateur
    ];
    $db->query($query, $params);
}

public static function insert_article($id_utilisateur, $societe)
{
    $db = \Config\Database::connect();
    $id_client_obj = self::get_id_client($id_utilisateur);
    $id_client = $id_client_obj->id_client; // Supposons que 'id_client' est la propriété contenant l'ID client

    // Récupérer les données de la table Excel
    $builder_excel = $db->table('excel');
    $query_excel = $builder_excel->get();
    $excel_data = $query_excel->getResult();
    
    // Parcourir les données de la table Excel
    foreach ($excel_data as $row) {
        // Vérifier si la société correspond à celle passée en paramètre
        if ($societe == $row->Societe) {
            // Vérifier si l'article existe déjà dans la base de données
            $article_exists = $db->table('article')
                                ->where('Numpiece', $row->Numpiece)
                                ->countAllResults() > 0;

            // Si l'article n'existe pas encore, l'insérer
            if (!$article_exists) {
                // Insérer les données dans la table Article
                $result = $db->table('article')->insert([
                    'Typedepiece' => $row->Typedepiece,
                    'Numpiece' => $row->Numpiece,
                    'Client' => $row->Client,
                    'Refcde' => $row->Refcde,
                    'Date_piece' => $row->Date_piece,
                    'Indice' => $row->Indice,
                    'Soldee' => $row->Soldee,
                    'Article' => $row->Article,
                    'Designationcourte' => $row->Designationcourte,
                    'Description' => $row->Description,
                    'PrixUniHTrem' => $row->PrixUniHTrem,
                    'Qte' => $row->Qte,
                    'MtTotH' => $row->MtTotH,
                    'Observations' => $row->Observations,
                    'Famille' => $row->Famille,
                    'Qteparcolis' => $row->Qteparcolis,
                    'QteLivree' => $row->QteLivree,
                    'Referencefournisseur' => $row->Referencefournisseur,
                    'Remarque' => $row->Remarque,
                    'Ref' => $row->Ref,
                    'Representant' => $row->Representant,
                    'Societe' => $row->Societe,
                    'Datepiece2' => $row->Datepiece2,
                    'Typedepiece2' => $row->Typedepiece2,
                    'Numpiece2' => $row->Numpiece2,
                    'mail' => $row->mail,
                    'id_client' => $id_client // Utilisation directe de l'ID client sans conversion
                ]);

                // Vérification d'erreurs après l'insertion
                if (!$result) {
                    var_dump($db->error()); // Afficher les erreurs si elles existent
                    return redirect()->to(base_url('Compte/Article')); // Rediriger vers la page compte
                }
            }
        }
    }
}


    public function reset_mdp($id_utilisateur, $email){
        $db = \Config\Database::connect();

        // Supprimer l'ancien mot de passe de l'utilisateur
        $data = ['mdp' => '']; // Réinitialiser le mot de passe
        $builder = $db->table('utilisateur');
        $builder->where('id_utilisateur', $id_utilisateur);
        $builder->update($data);

        // Générer un nouveau mot de passe
        $nouveau_mdp = $this->generate_password();

        // Mettre à jour le nouveau mot de passe dans la base de données
        $data = [
            'mdp' => password_hash($nouveau_mdp, PASSWORD_BCRYPT, ['cost' => 10])
        ];
        $builder = $db->table('utilisateur');
        $builder->where('id_utilisateur', $id_utilisateur);
        $builder->update($data);

        // Envoyer le nouveau mot de passe par e-mail à l'utilisateur
        $this->email_new_mdp($email, $nouveau_mdp);
    }



    public function create_user()
{
    $db = \Config\Database::connect();
    $societes = $this->getAllsociete();
    $existe_utilisateur = commande_model::getAllutilisateur();
    
    try {
        foreach ($societes as $societe) {
            // Vérifier si l'utilisateur existe déjà pour cette société
            $existing_user = $this->verif_societe($societe->societe);

            // Vérifier si l'utilisateur existe déjà dans tous les utilisateurs
           
            
            // Si l'utilisateur n'existe pas encore, procéder à son insertion
            if ($existing_user && !$existe_utilisateur) {
                // Générer un nom d'utilisateur et un mot de passe aléatoires
                $username = $this->generate_username();
                $password = $this->generate_password();

                // Email de la société
                $email = $societe->mail;

                // Envoyer l'e-mail avec les identifiants
                $this->envoie_email($username, $email, $password);

                // Insérer l'utilisateur dans la table utilisateur
                $data = [
                    'username' => $username,
                    'societe' => $societe->societe,
                    'email' => $email,
                    'mdp' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]),
                    'id_user_societe' => $societe->id_societe
                ];
                // Appel de la fonction insert_utilisateur pour insérer l'utilisateur
                $this->insert_utilisateur($data);

                // Récupérer l'ID de l'utilisateur nouvellement inséré
                $new_user_id = $db->insertID();

                // Insérer le client associé à l'utilisateur
                $this->insert_client($new_user_id);
            }
        }
    } catch (\Exception $e) {
        $e->getMessage();
    }
}

   





    private function generate_password()
    {
        // Générer un mot de passe aléatoire de 8 caractères
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < 8; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    private function generate_username()
    {
        // Chaîne de caractères contenant les minuscules, les majuscules et les caractères spéciaux
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        // Mélanger la chaîne de caractères
        $shuffled_chars = str_shuffle($chars);

        // Extraire les 8 premiers caractères
        $username = substr($shuffled_chars, 0, 8);

        return $username;
    }

    private function envoie_email($utilisateur, $mail, $mdp)
    {
       

        $email = \Config\Services::email();

        $email->setFrom('site_stagiaire@asminfo.fr', 'ASMINFO');
        $email->setTo($mail);
        $email->setSubject('Suivi de réparation ASMINFO');

        $email->setMessage("
            Madame,Monsieur,<br><br>
            Nous vous remercions sincèrement pour l'intérêt que vous portez à notre entreprise. <br><br>
            Nous sommes heureux de vous informer que vos identifiants pour suivre la progression de votre réparation ont été créés. Veuillez trouver ci-dessous les détails de connexion : <br><br>
            Identifiant : $utilisateur <br>
            Mot de passe : $mdp <br>
            Vous pouvez accéder à votre compte en utilisant le lien suivant : <a href='https://www.asminfo.fr/Authentification'>https://www.asminfo.fr/Authentification</a> <br><br>
            Veuillez conserver précieusement ces informations pour accéder à votre compte en toute sécurité. <br><br>
            Si vous avez des questions ou besoin d'assistance supplémentaire, n'hésitez pas à nous contacter à contact@asminfo.fr ou par téléphone au 01.64.43.97.37 <br><br>
            Cordialement, <br><br>

            <img src='C:\Users\Yanis\xampp\htdocs\v4bis\assets\img\logo\logo.svg' alt='Logo de ASMINFO'> <br><br>
            
            Mr Thomas Le <br>
            Responsable de publication <br>
            ASMINFO <br>
            22, rue Denis PAPIN -77680 Roissy-en-Brie <br>
            ");

            if ($email->send()) {
                echo "Mail envoyé";
            } else {
                echo "Erreur lors de l'envoi de l'e-mail: " . $email->printDebugger();
            }
        }

    public function email_mdp($id_utilisateur,$mail)
    {
        $n_mdp = $this->generate_password();
        $this->update_mdp($id_utilisateur,$n_mdp);

        $email = \Config\Services::email();

        $email->setFrom('site_stagiaire@asminfo.fr', 'ASMINFO');
        $email->setTo($mail);
        $email->setSubject('Rénitialisation de votre mot de passe');

        $email->setMessage( "
        Madame, Monsieur,<br><br>

        Suite à votre demande de réinitialisation de mot de passe, nous vous envoyons votre nouveau mot de passe :<br><br>
        
        Nouveau mot de passe : $n_mdp <br><br>
        
        Veuillez utiliser ce nouveau mot de passe pour accéder à votre compte en utilisant le lien suivant : <a href='https://www.asminfo.fr/Authentification'>https://www.asminfo.fr/Authentification</a><br><br>
        
        Si vous n'avez pas demandé de réinitialisation de mot de passe, veuillez nous contacter immédiatement à contact@asminfo.fr ou par téléphone au 01.64.43.97.37<br><br>        
        Cordialement,<br><br>

        <img src='C:\Users\Yanis\xampp\htdocs\v4bis\assets\img\logo\logo.svg' alt='Logo de ASMINFO'> <br><br>

        
        Mr Thomas Le
        Responsable de publication
        ASMINFO
        22, rue Denis PAPIN - 77680 Roissy-en-Brie
        ");


        if ($email->send()) {
            echo "Mail envoyé";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail: " . $email->printDebugger();
        }
    }

    public function email_username_mdp($id_utilisateur,$username,$mail)
    {
       

        $n_mdp = $this->generate_password();
        $this->update_mdp($id_utilisateur,$n_mdp);

        $email = \Config\Services::email();

        $email->setFrom('site_stagiaire@asminfo.fr', 'ASMINFO');
        $email->setTo($mail);
        $email->setSubject('Rénitialisation de votre mot de passe');

        $email->setMessage( "
        Madame, Monsieur,<br><br>

        Suite à votre demande de réinitialisation de mot de passe, nous vous envoyons votre nouveau mot de passe :<br><br>
        
        Identifiant : $username <br>
        Nouveau mot de passe : $n_mdp <br><br>
        
        Veuillez utiliser ce nouveau mot de passe pour accéder à votre compte en utilisant le lien suivant : <a href='https://www.asminfo.fr/Authentification'>https://www.asminfo.fr/Authentification</a><br><br>
        
        Si vous n'avez pas demandé de réinitialisation de mot de passe, veuillez nous contacter immédiatement à contact@asminfo.fr ou par téléphone au 01.64.43.97.37<br><br>        
        Cordialement,<br><br>

        <img src='C:\Users\Yanis\xampp\htdocs\v4bis\assets\img\logo\logo.svg' alt='Logo de ASMINFO'> <br><br>

        
        Mr Thomas Le<br>
        Responsable de publication<br>
        ASMINFO<br>
        22, rue Denis PAPIN - 77680 Roissy-en-Brie
        ");


        if ($email->send()) {
            echo "Mail envoyé";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail: " . $email->printDebugger();
        }
    }
}

    
    
    






?>