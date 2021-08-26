<?php
require_once 'models/Anuncio.php';

class AnunciosDaoMysql implements AnuncioDAO {
    
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function getTotalAnuncio() {
        $array = [];

        $sql = $this->pdo->query("SELECT COUNT(*) as c FROM anuncios");
        $row = $sql->fetch();

        return $row['c'];
    }

    public function getMeusAnuncios() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM anuncios");

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach($data as $item) {
                
                $a = new Anuncio();
                $a->setId($item['id']);
                $a->setIdCategoria($item['id_categoria']);
                $a->setTitulo($item['titulo']);
                $a->setValor($item['valor']);
                $a->setDescricao($item['descricao']);
                $a->setEstado($item['estado']);
                $a->setUrl($item['url_foto']);
                
                $array[] = $a;
            }
        }

        return $array;
    }

    public function  getUltimosAnuncios() {
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM anuncios ORDER BY id DESC LIMIT 5");

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach($data as $item) {
                
                $a = new Anuncio();
                $a->setId($item['id']);
                $a->setIdCategoria($item['id_categoria']);
                $a->setTitulo($item['titulo']);
                $a->setValor($item['valor']);
                $a->setDescricao($item['descricao']);
                $a->setEstado($item['estado']);
                $a->setUrl($item['url_foto']);
                
                $array[] = $a;
            }
        }

        return $array;
    }

    public function getFoto($id) {
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM anuncios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0 ) {
            $data = $sql->fetchAll();
            
            foreach($data as $item) { 
                $a = new Anuncio();
                $a->setId($item['id']);
                $a->setUrl($item['url_foto']);
                
                $array[] = $a;
            }
        }
        return $array;
    }


    public function findById($id) {
        $sql = $this->pdo->prepare("SELECT * FROM anuncios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new Anuncio();
            $u->setId($data['id']);
            $u->setIdCategoria($data['id_categoria']);
            $u->setTitulo($data['titulo']);
            $u->setValor($data['valor']);
            $u->setDescricao($data['descricao']);
            $u->setEstado($data['estado']);
            $u->setUrl($data['url_foto']);
            
            return $u;

        } else {
            return false;
        }
    }

    public function addAnuncio(Anuncio $a) {
        $fotos = $a->getUrl();

        if(count($fotos) > 0) {

            if(count($fotos) > 0) {
                for($q=0;$q<count($fotos['tmp_name']);$q++) {
                    $tipo = $fotos['type'][$q];
                    if(in_array($tipo, array('image/jpeg', 'image/png'))) {
                        $tmpname = md5(time().rand(0,9999)).'.jpg';
                        move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/'.$tmpname);
    
                        list($width_orig, $height_orig) = getimagesize('assets/images/'.$tmpname);
                        $ratio = $width_orig/$height_orig;
    
                        $width = 500;
                        $height = 500;
    
                        if($width/$height > $ratio) {
                            $width = $height*$ratio;
                        } else {
                            $height = $width/$ratio;
                        }
    
                        $img = imagecreatetruecolor($width, $height);
                        if($tipo == 'image/jpeg') {
                            $origi = imagecreatefromjpeg('assets/images/'.$tmpname);
                        } elseif($tipo == 'image/png') {
                            $origi = imagecreatefrompng('assets/images/'.$tmpname);
                        }
    
                        imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    
                        imagejpeg($img, 'assets/images/'.$tmpname, 80);
    
                    }
                }
            }
        }

        $sql = $this->pdo->prepare("INSERT INTO anuncios SET titulo = :titulo, id_categoria = :id_categoria,
        id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado = :estado, url_foto = :url_foto");

        $sql->bindValue(':titulo', $a->getTitulo());
        $sql->bindValue(':id_categoria', $a->getIdCategoria());
        $sql->bindValue(':id_usuario', $_SESSION['login']);
        $sql->bindValue(':descricao', $a->getDescricao());
        $sql->bindValue(':valor', $a->getValor());
        $sql->bindValue(':estado', $a->getEstado());
        $sql->bindValue(':url_foto', $tmpname);
        $sql->execute();

        return true;
        
    }

    public function updateAnuncio(Anuncio $a) {

        $fotos = $a->getUrl();

        if(count($fotos) > 0) {

            if(count($fotos) > 0) {
                for($q=0;$q<count($fotos['tmp_name']);$q++) {
                    $tipo = $fotos['type'][$q];
                    if(in_array($tipo, array('image/jpeg', 'image/png'))) {
                        $tmpname = md5(time().rand(0,9999)).'.jpg';
                        move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/'.$tmpname);
    
                        list($width_orig, $height_orig) = getimagesize('assets/images/'.$tmpname);
                        $ratio = $width_orig/$height_orig;
    
                        $width = 500;
                        $height = 500;
    
                        if($width/$height > $ratio) {
                            $width = $height*$ratio;
                        } else {
                            $height = $width/$ratio;
                        }
    
                        $img = imagecreatetruecolor($width, $height);
                        if($tipo == 'image/jpeg') {
                            $origi = imagecreatefromjpeg('assets/images/'.$tmpname);
                        } elseif($tipo == 'image/png') {
                            $origi = imagecreatefrompng('assets/images/'.$tmpname);
                        }
    
                        imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    
                        imagejpeg($img, 'assets/images/'.$tmpname, 80);
    
                    }
                }
            }
        }
        
        $sql = $this->pdo->prepare("UPDATE anuncios SET titulo = :titulo, id_categoria = :id_categoria,
        id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado = :estado, url_foto = :url_foto WHERE id = :id");

        $sql->bindValue(':titulo', $a->getTitulo());
        $sql->bindValue(':id_categoria', $a->getIdCategoria());
        $sql->bindValue(':id_usuario', $_SESSION['login']);
        $sql->bindValue(':descricao', $a->getDescricao());
        $sql->bindValue(':valor', $a->getValor());
        $sql->bindValue(':estado', $a->getEstado());
        $sql->bindValue(":url_foto", $tmpname);
        $sql->bindValue(':id', $a->getId());
        $sql->execute();

    }

    public function deleteAnuncio($id) {
        $sql = $this->pdo->prepare("DELETE FROM anuncios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }




  
}



