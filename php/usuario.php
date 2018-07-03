<?php

require_once 'php/database.php';

class Usuario {

    private $id = 1;
    private $nome;
    private $email;
    private $senha;
    private $end_avatar;
    private $login_diario;

     public function __construct() {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNome($nome){
        if(strlen($nome) <= 40) {
            $this->nome = $nome;
            return 1;
        }
        return 0;
    }

    public function setEmail($email) {
        $this->email = $email;
        return 1;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
        return 1;
    }

    public function setEnd_avatar($end_avatar){
        $this->end_avatar = $end_avatar;
        return 1;
    }    

    public function setLogin_diario($login_diario) {
        $this->login_diario = $login_diario;
        return 1;
    }

    public function edit(){
        $query = "UPDATE `usuario` SET `email` = :email, `senha` = :senha, `end_avatar` = :end_avatar WHERE `id` = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":end_avatar", $this->end_avatar);
        try { 
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }

    public function loginDiario(){
        $query = "UPDATE `usuario` SET `login_diario` = 0 WHERE `id` = :id ;
                  UPDATE `personagem` SET `experiencia` = `experiencia` + 35 WHERE `personagem`.`usuario_id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try { 
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }


    public function view() {
        $query = "SELECT * FROM `usuario` WHERE `id` = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function viewPersonagens() {
        $query = "SELECT `personagem`.`id`, `personagem`.`nome` AS `nome`, `raca`.`nome` AS `raca`, `hp`, `mana`, `nivel`, `experiencia`, `forca`, `inteligencia`, `constituicao`, `pontos_de_atributo`, `ativo`  FROM `personagem` JOIN `raca` ON `raca_id` = `raca`.`id` WHERE `usuario_id` = :id ORDER BY `personagem`.`ativo` DESC ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function viewAtivo() {
        $query = "SELECT `personagem`.`id`, `personagem`.`nome` AS `nome`, `raca`.`nome` AS `raca`, `hp`, `mana`, `nivel`, `experiencia`, `forca`, `inteligencia`, `constituicao`, `pontos_de_atributo`, `ativo`  FROM `personagem` JOIN `raca` ON `raca_id` = `raca`.`id` WHERE `usuario_id` = :id AND `ativo` = 1 ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function ativar($id){
        $query = "UPDATE `personagem` SET `ativo` = 0 WHERE `ativo` = 1; 
                  UPDATE `personagem` SET `ativo` = 1 WHERE `id` = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try { 
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }

    public function criarP($nome, $raca){
        $query = "UPDATE `personagem` SET `ativo` = 0 WHERE `ativo` = 1 AND `usuario_id` = :id;

        INSERT INTO personagem(usuario_id, raca_id, nome, ativo) VALUES 
                  (:id, :raca, :nome, 1) ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":raca", $raca);
        try { 
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }

    public function deletarP($id){
        $query = "DELETE FROM `personagem` WHERE `id` = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try { 
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }

    public function viewPersonagem($id) {
        $query = "SELECT * FROM `personagem` WHERE `id` = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function viewRacas() {
        $query = "SELECT * FROM `raca` ORDER BY `nome`;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function temPonto(){
        $query = "SELECT `pontos_de_atributo` AS pto FROM `personagem` WHERE `ativo` = 1 AND `usuario_id` = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try { 
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }

    public function atribui($atr){
        if($atr == 1)
            $query = "UPDATE `personagem` SET forca = forca + 1 WHERE `ativo` = 1 AND `usuario_id` = :id;
                  UPDATE `personagem` SET `pontos_de_atributo` = `pontos_de_atributo` - 1 WHERE `ativo` = 1 AND `usuario_id` = :id;";
        if($atr == 2)
            $query = "UPDATE `personagem` SET inteligencia = inteligencia + 1 WHERE `ativo` = 1 AND `usuario_id` = :id;
                  UPDATE `personagem` SET `pontos_de_atributo` = `pontos_de_atributo` - 1 WHERE `ativo` = 1 AND `usuario_id` = :id;";
        if($atr == 3)
            $query = "UPDATE `personagem` SET constituicao = constituicao + 1 WHERE `ativo` = 1 AND `usuario_id` = :id;
                  UPDATE `personagem` SET `pontos_de_atributo` = `pontos_de_atributo` - 1 WHERE `ativo` = 1 AND `usuario_id` = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try { 
            $stmt->execute();
            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }            
    }

    public function skills() {
        $query = "SELECT `habilidade`.id, `habilidade`.nome, custo, nivel_min, dano_base, dano_fisico, dano_magico, cura 
                  FROM `habilidade`, `personagem` 
                  WHERE `ativo` = 1 AND `usuario_id` = :id AND `nivel_min` <= `nivel` AND (`habilidade`.`raca_id` = `personagem`.`raca_id` OR `habilidade`.`raca_id` IS NULL)
                  ORDER BY `personagem`.`raca_id`, `nivel_min` DESC, dano_fisico DESC, dano_magico DESC;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public function skill($id) {
        $query = "SELECT *
                  FROM `habilidade`
                  WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public function morto($id) {
        $query = "SELECT * FROM personagem WHERE id = :id AND ativo = -1 ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            if(is_null($stmt->fetch(PDO::FETCH_OBJ))) {
                return 1;
            }
            return 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function combate($danoi, $mana, $dano, $inimigo, $id, $uid) {
        $query = "UPDATE personagem
                  SET hp = hp - :danoi 
                  WHERE id = :id;

                  UPDATE personagem
                  SET mana = mana - :mana 
                  WHERE id = :id;

                  UPDATE versus
                  SET hp_atual = hp_atual - :dano
                  WHERE inimigo_id = :inimigo AND usuario_id = :uid;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":danoi", $danoi);
        $stmt->bindParam(":mana", $mana);
        $stmt->bindParam(":dano", $dano);
        $stmt->bindParam(":inimigo", $inimigo);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":uid", $uid);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function cenarios() {
        $query = "SELECT * FROM cenario;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function viewCenario($c_id) {
        $query = "SELECT * FROM cenario WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $c_id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function viewInimigo($id) {
        $query = "SELECT * FROM inimigo WHERE id = :id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function inimigoEncontrado($cen) {
        $rand = rand(0, 100);
        $query = "SELECT inimigo_id FROM inimigo_em_cenario WHERE cenario_id = :cen AND probabilidade >= :rand ORDER BY probabilidade ASC;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cen", $cen);
        $stmt->bindParam(":rand", $rand);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->inimigo_id;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function vEvent($iid, $uid) {
        $query = "SELECT count(*) AS c FROM versus WHERE usuario_id = :uid AND inimigo_id = :iid ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $uid);
        $stmt->bindParam(":iid", $iid);
        try {
            $stmt->execute();
            if($stmt->fetch(PDO::FETCH_OBJ)->c <= 0) {
                $this->vInsert($uid, $iid);
            }
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function vEdit($uid, $iid) {
        $query = "UPDATE versus SET hp_atual = :hp WHERE usuario_id = :uid AND inimigo_id = :iid ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $uid);
        $stmt->bindParam(":iid", $iid);
        $stmt->bindParam(":hp", $hp);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function vInsert($uid, $iid) {
        $query = "INSERT INTO versus VALUES(:iid, :uid, (SELECT hp_maximo FROM inimigo WHERE id = :iid)) ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $uid);
        $stmt->bindParam(":iid", $iid);
        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function viewVersus($id, $uid) {
        $query = "SELECT * FROM inimigo, versus WHERE id = :id AND id = inimigo_id AND usuario_id = :uid;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":uid", $uid);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function ptosServer() {
        $query = "SELECT (sum(constituicao)+sum(inteligencia)+sum(forca) - 15*count(*)) AS soma FROM personagem;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->soma;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function mortosServer() {
        $query = "SELECT count(*) c FROM personagem WHERE ativo = -1 ;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->c;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function danoIServer() {
        $query = "SELECT avg(dano) a FROM inimigo;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->a;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function hpIServer() {
        $query = "SELECT avg(hp_maximo) a FROM inimigo;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->a;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function atrServer() {
        $query = "SELECT avg(nivel) nivel, avg(forca) forca, avg(inteligencia) inteligencia, avg(constituicao) constituicao FROM personagem;";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}