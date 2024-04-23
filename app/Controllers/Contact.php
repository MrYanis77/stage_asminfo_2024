<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        return $this->contact('contact');
    }

    public function contact ($page = 'contact'){
    
        if(!is_file(APPPATH . 'Views/Pages/' .$page . '.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $titre ="NOUS CONTACTER";

        echo view('Templates/header_black', ['title' => $titre ]);
        echo view('Pages/' .$page);
        echo view('Templates/footer');
    }

}
