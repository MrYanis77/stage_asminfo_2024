<?php

namespace App\Controllers;

class Histoire extends BaseController
{
    public function index()
    {
        return $this->histoire('histoire');
    }

    public function histoire ($page = 'histoire'){
    
        if(!is_file(APPPATH . 'Views/Pages/' .$page . '.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $titre ="NOTRE HISTOIRE";

        echo view('Templates/header_black', ['title' => $titre ]);
        echo view('Pages/' .$page);
        echo view('Templates/footer');
    }

}
