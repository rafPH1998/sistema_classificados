<?php
require_once 'models/Categorias.php';

class CategoriasDaoMysql implements CategoriasDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getLista() {
        $lista = [];

        $sql = $this->pdo->query("SELECT * FROM categorias");

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach($data as $array) {
                $c = new Categorias();
                $c->setId($array['id']);
                $c->setNomeCategoria($array['nome']);

                $lista[] = $c;
            }

        }

        return $lista;
    }

    public function getCategoria() {
        $array = [];

        $sql = $this->pdo->query("SELECT nome FROM categorias");
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $c = new Categorias();
            $c->setNomeCategoria($data['nome']);

            return $c;
        }

        return $array;
    }

}


