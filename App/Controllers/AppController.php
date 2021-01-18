<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Usuario;
use MF\Model\Container;

class AppController extends Action{
    
    public function timeline(){
        $this->is_authenticated();
        
        $publicacao = Container::getModel('Publicacao');
        $publicacao->__set('id_usuario', $_SESSION['id']);
        
        if(isset($_GET['categoria'])){
            $categoria = $_GET['categoria'];
            $this->view->posts = $publicacao->getCategoria($categoria);

        }else{
            $this->view->posts = $publicacao->getPosts();
        }
            
        $this->render('timeline', 'layout');
    }
    
    public function adicionar_publicacao(){
        $this->is_authenticated();
        
        $this->render('adicionar_publicacao', 'layout');
    }
    
    public function publicar(){
        $this->is_authenticated();
        
        if(empty($_POST['titulo']) ||               empty($_POST['autor']) || empty($_POST['descricao_curta']) || 
          empty($_POST['resenha']) || empty($_FILES['image']['name'])){
            header('Location: /adicionar_publicacao?publicar=erro');
        }
        
        $publicao = Container::getModel('Publicacao');
        $publicao->__set('id_usuario', $_SESSION['id']);
        $publicao->__set('titulo', $_POST['titulo']);
        $publicao->__set('autor', $_POST['autor']);
        $publicao->__set('descricao_curta', $_POST['descricao_curta']);
        $publicao->__set('resenha', $_POST['resenha']);
        $publicao->__set('categoria', $_POST['categoria']);
        
        $publicao->__set('imagem', AppController::salvar_imagem());
        
        $publicao->publicar();
        
        header('Location: /adicionar_publicacao?publicar=success');
        
    }
    
    public function signIn(){
        $this->render('sign_in', 'layout');
    }
    
    public function addUser(){   
        
        if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_FILES['image']['name'])){
            header('Location: /sign_in?cadastro=erro');
        }else{
            if($_POST['password'] != $_POST['password2']){
                header('Location: /sign_in?cadastro=erro');
            }else{
                $usuario = Container::getModel('Usuario');
                $usuario->__set('nome', $_POST['nome']);
                $usuario->__set('email', $_POST['email']);
                $usuario->__set('senha', md5($_POST['password']));

                $imagem = AppController::salvar_imagem();

                $usuario->__set('imagem', $imagem);

                $usuario->addUser();
                header('Location: /?cadastro=success');
            }
        }
        
        
        
    }
    
    public function buscar(){
        $this->is_authenticated();
        
        if(!empty($_GET['termo'])){
            $termo = $_GET['termo'];
            
            $usuario = Container::getModel('Usuario');
            
            $this->view->usuarios = $usuario->buscar($termo);
            
            $this->render('pessoas', 'layout');
        }
    }
    
    public function seguir(){
        $this->is_authenticated();
        
        if(empty($_GET['id_seguidor'])){
            header('Location: /timeline');
        }
        
        $usuario = Container::getModel('Usuario');
        $usuario->seguir($_GET['id_seguidor']);
        
        if(isset($_GET['termo'])){
            header('Location: /buscar?termo='.$_GET['termo']); 
        }        
    }
    
    public function deixarSeguir(){
        $this->is_authenticated();
        
        if(empty($_GET['id_seguidor'])){
            header('Location: /timeline');
        }
        
        $usuario = Container::getModel('Usuario');
        $usuario->deixarSeguir($_GET['id_seguidor']);
        
        if(isset($_GET['termo'])){
            header('Location: /buscar?termo='.$_GET['termo']); 
        }
        
    }
    
    public function post(){
        $this->is_authenticated();
        
        if(isset($_GET['id'])){
            $id_post = $_GET['id'];
            
            $publicacao = Container::getModel('Publicacao');
            $this->view->post = $publicacao->getPost($id_post);
            
            $this->render('post', 'layout');
        }
    }
    
    public function perfil(){
        $this->is_authenticated();
        
        $publicacao = Container::getModel('Publicacao');
        
        $usuario = Container::getModel('Usuario');
        
        $this->view->usuario = $usuario->getUsuario(); 
        $this->view->seguindo = $usuario->getSeguindo();
        $this->view->seguidores = $usuario->getSeguidores();
        $this->view->qtdPosts = $usuario->getQtdPosts();
        $this->view->posts = $publicacao->getMyPosts();

        $this->render('perfil', 'layout');
    }
    
    public function removePost(){
        $this->is_authenticated();
        
        if(isset($_GET['id'])){
            $publicacao = Container::getModel('Publicacao');
            $publicacao->__set('id', $_GET['id']);
            $publicacao->removePost();
            
            header('Location: /perfil');
        }
        header('Location: /perfil');
    }
    
    public function editarPost(){
        $this->is_authenticated();
        
        if(isset($_GET['id'])){
            $publicacao = Container::getModel('Publicacao');
            $post = $publicacao->getPost($_GET['id'])[0];
            $publicacao->__set('id', $_GET['id']);
            $publicacao->__set('titulo', $post['titulo']);
            $publicacao->__set('autor', $post['autor']);
            $publicacao->__set('descricao_curta', $post['descricao_curta']);
            $publicacao->__set('resenha', $post['resenha']);
            $publicacao->__set('imagem', $post['imagem']);
            
            $this->view->publicacao = $publicacao;
            $this->render('editar_post', 'layout');
        }
    }
    
    public function salvarPost(){
        $this->is_authenticated();
        
        if(empty($_POST['titulo']) ||               empty($_POST['autor']) || empty($_POST['descricao_curta']) || 
          empty($_POST['resenha'])){
            header('Location: /perfil');
        }else{
            $publicacao = Container::getModel('Publicacao');
            $post = $publicacao->getPost($_GET['id'])[0];

            $publicacao->__set('id', $_GET['id']);
            $publicacao->__set('titulo', $_POST['titulo']);
            $publicacao->__set('autor', $_POST['autor']);
            $publicacao->__set('descricao_curta', $_POST['descricao_curta']);
            $publicacao->__set('resenha', $_POST['resenha']);
            $publicacao->__set('categoria', $_POST['categoria']);
            
            if(isset($_FILES['image']['name'])){
                $imagem = AppController::salvar_imagem();
                $publicacao->__set('imagem', $imagem);
            }else{
                $publicacao->__set('imagem', $post['imagem']);

            }
            
            $publicacao->updatePost();
            
            header('Location: /perfil');
        }
    }
    
    public function is_authenticated(){
        session_start();
        if(!isset($_SESSION['id']) || !isset($_SESSION['nome']) || !isset($_SESSION['email']) || !isset($_SESSION['senha'])){
            session_destroy();
            header('Location: /');
        }else{
            return true;
        }
    }
    
    public static function salvar_imagem(){
        if(isset($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0){
            $arquivo_tmp  = $_FILES['image']['tmp_name'];
            $nome = $_FILES['image']['name'];
            
            $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            $extensao = strtolower($extensao);
            
            if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
                $novoNome = uniqid(time()) . '.' . $extensao;
                
                $destino = 'images/' .$novoNome;
                if(@move_uploaded_file($arquivo_tmp , $destino)){
                    echo 'Arquivo salvo com sucesso!';
                    return $destino;
                }else{
                    echo 'Erro ao salvar arquivo!';
                }
            }else{
                echo 'erro1';
            }
        }else{
            echo 'erro2';
        }
    }
    
    
}