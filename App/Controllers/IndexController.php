<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Usuario;
use MF\Model\Container;

class IndexController extends Action{
    
    public function index(){
        
        $usuario = Container::getModel('Usuario');
        
        $this->render('index', 'layout');
    }
    
    public function sobreNos(){
        $this->render('sobreNos');
    }
    
}

?>