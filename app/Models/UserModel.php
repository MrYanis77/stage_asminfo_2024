<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'utilisateur';
    protected $primaryKey           = 'id_utilisateur';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['username','societe','email', 'mdp','id_user_societe','date_création'];
 
    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'date_création';
    protected $updatedField         = 'date_modification';
    protected $deletedField         = 'date_suppression';
 
    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
 
    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
}