<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Usuario;
use MF\Model\Container;

class AuthController extends Action{
    
    public function autenticar(){
        if(!empty($_POST['email']) and !empty($_POST['senha'])){
            
            $usuario = Container::getModel('Usuario');
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', md5($_POST['senha']));
                        
            $usuario->autenticar();
            if($usuario->__get('id') != ''){
                session_start();
                
                $_SESSION['id'] = $usuario->__get('id');
                $_SESSION['nome'] = $usuario->__get('nome');
                $_SESSION['email'] = $usuario->__get('email');
                $_SESSION['senha'] = $usuario->__get('senha');
                                
                header('Location: /timeline');
            }else{
                header('Location: /?login=erro');
            }
                  
        }else{
            header('Location: /?login=erro');
        }
    }
    
    public function sair(){
        session_start();
        session_destroy();
        header('Location: /');
    }
    
    
}