<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $imagem;
    
    public function __get($attr){
        return $this->$attr;
    }
    
    public function __set($attr, $value){
        $this->$attr = $value;
    }
    
    public function autenticar(){
        $query = "select * from usuario where email = :email and senha = :senha";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($usuario['id'] != '' and $usuario['nome'] != ''){
            $this->__set('id', $usuario['id']);
            $this->__set('nome', $usuario['nome']);
        }
    }
    
    public function addUser(){
        $query = 'insert into usuario(nome, email, senha, imagem) values(:nome, :email, :senha, :imagem)';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        
        $stmt->execute();
    }
    
    public function buscar($termo){
        $query = "select u.id, u.nome, u.email, u.imagem, id_usuario as seguindo  from usuario as u left join usuario_seguidor as us on(us.id_usuario = :id_usuario and us.id_seguidor = u.id) where nome like :termo";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':termo', '%'.$termo.'%');
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function seguir($id_seguidor){
        $query = 'insert into usuario_seguidor(id_usuario, id_seguidor) values(:id_usuario, :id_seguidor)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->bindValue(':id_seguidor', $id_seguidor);
        
        $stmt->execute();
    }
    
    public function deixarSeguir($id_seguidor){
        $query = 'delete from usuario_seguidor where id_usuario = :id_usuario and id_seguidor = :id_seguidor';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_seguidor', $id_seguidor);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        
        $stmt->execute();
    }
    
    public function getUsuario(){
        $query = 'select * from usuario where id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getSeguindo(){
        $query = 'select count(*) as seguindo from usuario_seguidor where id_usuario = :id_usuario';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
     public function getSeguidores(){
        $query = 'select count(*) as seguidores from usuario_seguidor where id_seguidor = :id_usuario';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getQtdPosts(){
        $query = 'select count(*) as qtdPosts from publicacao where id_usuario = :id_usuario';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    
}


?>