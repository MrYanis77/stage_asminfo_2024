<?php

namespace App\Controllers;

class Services extends BaseController
{
    public function index()
    {
        return $this->services('services');
    }

    public function services ($page = 'services'){
    
        if(!is_file(APPPATH . 'Views/Pages/' .$page . '.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $titre ="NOS SERVICES";

        echo view('Templates/header_black', ['title' => $titre ]);
        echo view('Pages/' .$page);
        echo view('Templates/footer');
    }

}
