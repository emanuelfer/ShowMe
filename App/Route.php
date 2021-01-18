<?php

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap {

    protected function initRoutes(){
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['sobre_nos'] = array(
            'route' => '/sobre_nos',
            'controller' => 'indexController',
            'action' => 'sobreNos'
        );
        
        $routes['autenticar'] = array(
            'route' => '/autenticar',
            'controller' => 'AuthController',
            'action' => 'autenticar'
        );
        
        $routes['sair'] = array(
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'sair'
        );
        
        $routes['timeline'] = array(
            'route' => '/timeline',
            'controller' => 'AppController',
            'action' => 'timeline'
        );
        
        $routes['adicionar_publicacao'] = array(
            'route' => '/adicionar_publicacao',
            'controller' => 'AppController',
            'action' => 'adicionar_publicacao'
        );
        
        $routes['publicar'] = array(
            'route' => '/publicar',
            'controller' => 'AppController',
            'action' => 'publicar'
        );
        
        $routes['sign_in'] = array(
            'route' => '/sign_in',
            'controller' => 'AppController',
            'action' => 'signIn'
        );
        
        $routes['add_user'] = array(
            'route' => '/add_user',
            'controller' => 'AppController',
            'action' => 'addUser'
        );
        
        $routes['buscar'] = array(
            'route' => '/buscar',
            'controller' => 'AppController',
            'action' => 'buscar'
        );
        
        $routes['seguir'] = array(
            'route' => '/seguir',
            'controller' => 'AppController',
            'action' => 'seguir'
        );
        
        $routes['deixar_seguir'] = array(
            'route' => '/deixar_seguir',
            'controller' => 'AppController',
            'action' => 'deixarSeguir'
        );
        
        $routes['post'] = array(
            'route' => '/post',
            'controller' => 'AppController',
            'action' => 'post'
        );
        
        $routes['perfil'] = array(
            'route' => '/perfil',
            'controller' => 'AppController',
            'action' => 'perfil'
        );
        
        $routes['remove_post'] = array(
            'route' => '/remove_post',
            'controller' => 'AppController',
            'action' => 'removePost'
        );
        
        $routes['editar_post'] = array(
            'route' => '/editar_post',
            'controller' => 'AppController',
            'action' => 'editarPost'
        );
        
        $routes['salvar_post'] = array(
            'route' => '/salvar_post',
            'controller' => 'AppController',
            'action' => 'salvarPost'
        );
            
        $this->setRoutes($routes);
    }
}

?>