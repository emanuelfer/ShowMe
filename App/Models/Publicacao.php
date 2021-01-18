<?php

namespace App\Models;

use MF\Model\Model;

class Publicacao extends Model{
    private $id;
    private $id_usuario;
    private $titulo;
    private $autor;
    private $descricao_curta;
    private $resenha;
    private $categoria;
    private $imagem;
    
    public function __get($attr){
        return $this->$attr;
    }
    
    public function __set($attr, $value){
        $this->$attr = $value;
    }
    
    public function publicar(){
        $query = 'insert into publicacao (id_usuario, titulo, autor, descricao_curta, resenha, categoria, imagem) values(:id_usuario, :titulo, :autor, :descricao_curta, :resenha, :categoria, :imagem)';
            
        $stmt = $this->db->prepare($query);      
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':autor', $this->__get('autor'));
        $stmt->bindValue(':descricao_curta', $this->__get('descricao_curta'));
        $stmt->bindValue(':resenha', $this->__get('resenha'));
        $stmt->bindValue(':categoria', $this->__get('categoria'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        
        $stmt->execute();
    }
    
    public function getPosts(){
        $query = '
        select 
            p.id, p.id_usuario, p.titulo, p.autor, p.descricao_curta, p.resenha, p.categoria, p.imagem, u.imagem as user_image, u.nome as user_nome 
        from
            publicacao as p, usuario as u, usuario_seguidor as us
        where 
            us.id_seguidor = u.id and p.id_usuario = us.id_seguidor and us.id_usuario = :id_usuario
        order by 
            p.id DESC';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getPost($id_post){
        $query = '
        select 
            p.id, p.id_usuario, p.titulo, p.autor, p.descricao_curta, p.resenha, p.categoria, p.imagem, u.nome as user_nome, u.imagem as user_imagem 
        from 
            publicacao as p, usuario as u, usuario_seguidor as us 
        where
            (p.id = :id_post and u.id = :id_usuario and p.id_usuario = u.id) or (p.id = :id_post and us.id_usuario = :id_usuario and us.id_seguidor = u.id and u.id = p.id_usuario) group by p.id';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_post', $id_post);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getCategoria($categoria){
        $query = '
        select p.id, p.id_usuario, p.titulo, p.autor, p.descricao_curta, p.categoria, p.imagem, u.nome as user_nome, u.imagem as user_image from publicacao as p, usuario as u, usuario_seguidor as us where p.id_usuario = u.id and us.id_usuario = :id_usuario and us.id_seguidor = u.id and p.categoria = :categoria';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->bindValue(':categoria', $categoria);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getMyPosts(){
        $query = '
        select p.id, p.id_usuario ,p.titulo, p.autor, p.descricao_curta, p.resenha, p.categoria, p.imagem, u.nome as user_nome, u.imagem as user_image from publicacao as p, usuario as u where p.id_usuario = :id_usuario and u.id = p.id_usuario order by p.id DESC';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function updatePost(){
        $query = 'update publicacao set titulo = :titulo, autor = :autor, descricao_curta = :descricao_curta, resenha = :resenha, categoria = :categoria, imagem = :imagem where id = :id_post and id_usuario = :id_usuario';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':autor', $this->__get('autor'));
        $stmt->bindValue(':descricao_curta', $this->__get('descricao_curta'));
        $stmt->bindValue(':resenha', $this->__get('resenha'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        $stmt->bindValue(':categoria', $this->__get('categoria'));
        $stmt->bindValue(':id_post', $this->__get('id'));
        $stmt->bindValue(':id_usuario', $_SESSION['id']);

        $stmt->execute();
    }
    
    public function removePost(){
        $query = 'delete from publicacao where id = :id and id_usuario = :id_usuario';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        
        $stmt->execute();
    }   
}


?>