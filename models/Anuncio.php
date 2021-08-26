<?php 
class Anuncio {
    private $id;
    private $id_usuario;
    private $id_categoria;
    private $titulo;
    private $descricao;
    private $valor;
    private $estado;
    private $url_foto;

    public function getId() {
        return $this->id;
    }

    public function setId($i) {
        $this->id = trim($i);
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($iu) {
        $this->id_usuario = $iu;
    }

    public function getIdCategoria() {
        return $this->id_categoria;
    }

    public function setIdCategoria($ic) {
        $this->id_categoria = $ic;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($t) {
        $this->titulo = ucfirst($t);
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($d) {
        $this->descricao = $d;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($v) {
        $this->valor = $v;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($e) {
        $this->estado = $e;
    }

    public function getUrl() {
        return $this->url_foto;
    }

    public function setUrl($u) {
        $this->url_foto = $u;
    }


}

interface AnuncioDAO {
    public function getMeusAnuncios();
    public function addAnuncio(Anuncio $a);
    public function updateAnuncio(Anuncio $a);
    public function deleteAnuncio($id);
    public function findById($id);
    public function getTotalAnuncio();
    public function getFoto($id);
}