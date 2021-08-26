<?php
class Categorias {
    private $id;
    private $nomeCategoria;

    public function getId() {
        return $this->id;
    }

    public function setId($i) {
        $this->id = trim($i);
    }

    public function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    public function setNomeCategoria($n) {
        $this->nomeCategoria = $n;
    }

}

interface CategoriasDAO {
    public function getLista();
}