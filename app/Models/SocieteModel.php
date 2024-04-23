<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class SocieteModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'societe';
    protected $primaryKey           = 'id_societe';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['societe', 'numero','date_ajout'];
 
    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'date_ajout';
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