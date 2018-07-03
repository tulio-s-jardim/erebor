<?php

require_once 'php/database.php';

class Admin {

    public function __construct() {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    public function racaInsert($nome) {
        $query = "INSERT INTO raca(nome) VALUES (:nome);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function racaEdit($id, $nome) {
        $query = "UPDATE raca SET nome = :nome WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function racaDelete($id) {
        $query = "DELETE FROM raca WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function racaMax() {
        $query = "SELECT max(id) AS c FROM `raca`;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->c;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function racaView() {
        $query = "SELECT * FROM `raca`;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function cenarioInsert($nome, $dif) {
        $query = "INSERT INTO cenario(nome, dificuldade) VALUES (:nome, :dif);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":dif", $dif);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function cenarioEdit($id, $nome, $dif) {
        $query = "UPDATE cenario SET nome = :nome, dificuldade = :dif WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":dif", $dif);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function cenarioDelete($id) {
        $query = "DELETE FROM cenario WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function cenarioView() {
        $query = "SELECT * FROM `cenario`;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function iecInsert($idc, $idi, $prob) {
        $query = "INSERT INTO inimigo_em_cenario(cenario_id, inimigo_id, probabilidade) VALUES (:idc, :idi, :prob);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idc", $idc);
        $stmt->bindParam(":idi", $idi);
        $stmt->bindParam(":prob", $prob);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function iecEdit($idc, $idi, $prob) {
        $query = "UPDATE inimigo_em_cenario SET probabilidade = :prob WHERE cenario_id = :idc AND inimigo_id = :idi ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idc", $idc);
        $stmt->bindParam(":idi", $idi);
        $stmt->bindParam(":prob", $prob);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function iecDelete($idc, $idi) {
        $query = "DELETE FROM inimigo_em_cenario WHERE cenario_id = :idc AND inimigo_id = :idi ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idc", $idc);
        $stmt->bindParam(":idi", $idi);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function iecView($id) {
        $query = "SELECT * FROM `inimigo_em_cenario` JOIN `inimigo` ON inimigo_id = `inimigo`.`id` WHERE cenario_id = :id ORDER BY probabilidade ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public function hInsert($nome, $custo, $nivel_min, $dano_base, $dano_fisico, $dano_magico, $cura, $raca_id) {
        $query = "INSERT INTO habilidade(nome, custo, nivel_min, dano_base, dano_fisico, dano_magico, cura, raca_id) VALUES (:nome, :custo, :nivel_min, :dano_base, :dano_fisico, :dano_magico, :cura, :raca_id);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":custo", $custo);
        $stmt->bindParam(":nivel_min", $nivel_min);
        $stmt->bindParam(":dano_base", $dano_base);
        $stmt->bindParam(":dano_fisico", $dano_fisico);
        $stmt->bindParam(":dano_magico", $dano_magico);
        $stmt->bindParam(":cura", $cura);
        $stmt->bindParam(":raca_id", $raca_id);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }


    public function hInsertN($nome, $custo, $nivel_min, $dano_base, $dano_fisico, $dano_magico, $cura) {
        $query = "INSERT INTO habilidade(nome, custo, nivel_min, dano_base, dano_fisico, dano_magico, cura) VALUES (:nome, :custo, :nivel_min, :dano_base, :dano_fisico, :dano_magico, :cura);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":custo", $custo);
        $stmt->bindParam(":nivel_min", $nivel_min);
        $stmt->bindParam(":dano_base", $dano_base);
        $stmt->bindParam(":dano_fisico", $dano_fisico);
        $stmt->bindParam(":dano_magico", $dano_magico);
        $stmt->bindParam(":cura", $cura);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function hEdit($id, $nome, $custo, $nivel_min, $dano_base, $dano_fisico, $dano_magico, $cura, $raca_id) {
        $query = "UPDATE habilidade SET nome = :nome, custo = :custo, nivel_min = :nivel_min, dano_base = :dano_base, dano_fisico = :dano_fisico, dano_magico = :dano_magico, cura = :cura, raca_id = :raca_id WHERE id = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":custo", $custo);
        $stmt->bindParam(":nivel_min", $nivel_min);
        $stmt->bindParam(":dano_base", $dano_base);
        $stmt->bindParam(":dano_fisico", $dano_fisico);
        $stmt->bindParam(":dano_magico", $dano_magico);
        $stmt->bindParam(":cura", $cura);
        $stmt->bindParam(":raca_id", $raca_id);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function hEditN($id, $nome, $custo, $nivel_min, $dano_base, $dano_fisico, $dano_magico, $cura) {
        $query = "UPDATE habilidade SET nome = :nome, custo = :custo, nivel_min = :nivel_min, dano_base = :dano_base, dano_fisico = :dano_fisico, dano_magico = :dano_magico, cura = :cura, raca_id = NULL WHERE id = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":custo", $custo);
        $stmt->bindParam(":nivel_min", $nivel_min);
        $stmt->bindParam(":dano_base", $dano_base);
        $stmt->bindParam(":dano_fisico", $dano_fisico);
        $stmt->bindParam(":dano_magico", $dano_magico);
        $stmt->bindParam(":cura", $cura);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function hDelete($id) {
        $query = "DELETE FROM habilidade WHERE id = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function hView() {
        $query = "SELECT  DISTINCT `habilidade`.`id` AS hid, CASE WHEN `raca_id` IS NULL THEN 'Nenhuma' ELSE (SELECT `raca`.`nome` FROM raca WHERE raca.id = raca_id) END AS raca, `habilidade`.`nome` AS hnome, custo, nivel_min, dano_base, dano_fisico, dano_magico, cura, raca_id 
            FROM `habilidade`
            ORDER BY raca, hnome;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public function iInsert($nome, $hp, $dano, $mult_magico, $mult_fisico, $exp_concedida) {
        $query = "INSERT INTO inimigo(nome, hp_maximo, hp, dano, mult_magico, mult_fisico, exp_concedida) VALUES (:nome, :hp, :hp, :dano, :mult_magico, :mult_fisico, :exp_concedida);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":hp", $hp);
        $stmt->bindParam(":dano", $dano);
        $stmt->bindParam(":mult_magico", $mult_magico);
        $stmt->bindParam(":mult_fisico", $mult_fisico);
        $stmt->bindParam(":exp_concedida", $exp_concedida);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function iEdit($id, $nome, $hp, $dano, $mult_magico, $mult_fisico, $exp_concedida) {
        $query = "UPDATE inimigo SET id = :id, nome = :nome, hp_maximo = :hp, hp = :hp, dano = :dano, mult_magico = :mult_magico, mult_fisico = :mult_fisico, exp_concedida = :exp_concedida  WHERE id = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":hp", $hp);
        $stmt->bindParam(":dano", $dano);
        $stmt->bindParam(":mult_magico", $mult_magico);
        $stmt->bindParam(":mult_fisico", $mult_fisico);
        $stmt->bindParam(":exp_concedida", $exp_concedida);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function iDelete($id) {
        $query = "DELETE FROM inimigo WHERE id = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function inimigoView() {
        $query = "SELECT * FROM `inimigo`;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}