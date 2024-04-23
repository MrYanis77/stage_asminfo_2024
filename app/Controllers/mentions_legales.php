<?php

namespace App\Controllers;

class mentions_legales extends BaseController
{
    public function index()
    {
        return $this->mention_l('mentions_l');
    }

    public function mention_l ($page = 'mentions_l'){
    
        if(!is_file(APPPATH . 'Views/Pages/' .$page . '.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        
        $titre ="MENTION LEGALES";

        echo view('Templates/header_black', ['title' => $titre ]);
        echo view('Pages/' .$page);
        echo view('Templates/footer');
    }

}
