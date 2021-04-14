<?php

class Usuario{

   private $pdo;

    public function __construct($host,$dbname,$user,$senha){

        $this->pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$user,$senha);
        try {
            $this->pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$user,$senha);

        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
            exit();
        } catch(Exception $ex){
            echo "Erro Genérico: ".$ex->getMessage();
        }
        
    }

    //PEGA OS DADOS E MOSTRA NO HORAS REGISTRADAS
    public function searchDb(){

        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM horatrabalhador");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function inserirHoras($dataAtual,$horaEntrada,$horaSaida,$Justificativa,$id_user){
        
        $cmd = $this->pdo->prepare("INSERT INTO horatrabalhador(dataAtual,horaEntrada,horaSaida,Justificativa,ID_user) VALUES (:dat,:Hr_ent,:Hr_sai,:Just,:id)");

        $cmd->bindValue(":dat",$dataAtual);
        $cmd->bindValue(":Hr_ent",$horaEntrada);
        $cmd->bindValue(":Hr_sai",$horaSaida);
        $cmd->bindValue(":Just",$Justificativa);
        $cmd->bindValue(":id",$id_user);
        $cmd->execute();
    }

    public function getTrab_id(){

        $varz = array();
        $cmd = $this->pdo->query("SELECT * FROM usuarios WHERE id_user = 1");
        $varz = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $varz;
    }

    public function getTrab_idwithLogin($login){

        $varz = array();
        $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :logi");
        $cmd->bindValue(":logi",$login);
        $cmd->execute();
        $varz = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $varz;
    }

    public function validation($login,$senha){

        $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :logi && senha = :pass ");

        $cmd->bindValue(":logi",$login);
        $cmd->bindValue(":pass",$senha);
        $cmd->execute();
        $result = $cmd->fetchAll(PDO::FETCH_ASSOC);

        if(is_null($result)){
            return null;
        }
        return $result;
    }

    public function setTipo($tipo){

        $cmd = $this->pdo->prepare("UPDATE usuarios SET Tipo = :tipe ");
        $cmd->bindValue(":tipe",$tipo);
        $cmd->execute();

        if($cmd->rowCount()>0){
            return true;
        }
        return false;
    }
    
    public function searchWithDate($dateEnt,$dateSai,$id_user,$Justificativa){
        $res = array();
        if($Justificativa == ''){
            $cmd = $this->pdo->prepare("SELECT * FROM horatrabalhador WHERE ID_user = :id AND dataAtual >= :datEnt && dataAtual < :datSai");
            $cmd->bindValue(":datEnt",$dateEnt);
            $cmd->bindValue(":datSai",$dateSai);
            $cmd->bindValue(":id",$id_user);
            $cmd->execute();
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }else{
            $cmd = $this->pdo->prepare("SELECT * FROM horatrabalhador WHERE ID_user = :id AND dataAtual >= :datEnt && dataAtual < :datSai AND Justificativa = :just");
            $cmd->bindValue(":datEnt",$dateEnt);
            $cmd->bindValue(":datSai",$dateSai);
            $cmd->bindValue(":id",$id_user);
            $cmd->bindValue(":just",$Justificativa);
            $cmd->execute();
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        
       
    }

    public function deleteFromTable($id_hora){
        $cmd = $this->pdo->prepare("DELETE FROM horatrabalhador WHERE ID_horaTrab = :id_hr");
        $cmd->bindValue(":id_hr",$id_hora);
        //$cmd->bindValue(":id_usr",$usuario1);
        $cmd->execute();
    }

    public function searchHrForID($id_hora){

        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM horatrabalhador WHERE ID_hora = :id");
        $cmd->bindValue(":id",$id_hora);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function attDados(){
        
    }
    
}

?>