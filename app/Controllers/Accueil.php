<?php

namespace App\Controllers;


class Accueil extends BaseController
{
    public function index()
    {
        return $this->view('accueil');
    }

    public function view ($page = 'accueil'){
    
        if(!is_file(APPPATH . 'Views/Pages/' .$page . '.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $titre ="ACCUEIL";

        echo view('Templates/header', ['title' => $titre ]);
        echo view('Pages/' .$page);
        echo view('Templates/footer');
    }

}
