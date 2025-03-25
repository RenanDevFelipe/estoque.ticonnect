<?php 

require_once __DIR__ . "/../MethodList/qtypeIXC.php";

class ModelBodyRequest {
    private $qtypeIXC;


    public function __construct()
    {
        $this->qtypeIXC = new QtypeRiquisicoesIXC();
    }

    public function BodyRequest(){
        $data = [
            "qtype" => "su_oss_chamado.tipo",
            "query" => "C",
            "oper" => "=",
            "page" => "1",
            "rp" => "1000",
            "sortname" => "su_oss_chamado.id",
            "sortorder" => "desc"

        ];

        return $data;
    }

    public function BodyRequestModelDinamic($qtype, $query, $oper, $sortname, $sortorder){
        $data = [

            "qtype" => $qtype,
            "query" => $query,
            "oper" => $oper,
            "page" => "1",
            "rp" => "10000",
            "sortname" => $sortname,
            "sortorder" => $sortorder

        ];

        return $data;
    }

    public function BodyRequestModelFinalTecnico($query){
        $data = [
            "qtype" => $this->qtypeIXC->su_chamado_os().".id_tecnico",
            "query" => $query,
            "oper" => "=",
            "page" => "1",
            "rp" => "1000",
            "sortname" => $this->qtypeIXC->su_chamado_os().".id",
            "sortorder" => "desc",
            "status" => "F"
        ];

        return $data;
    }

    public function BodyAlmoxTecnico($query){
        $data = [
            "qtype" => $this->qtypeIXC->estoque_produtos_almox_filial().".id_almox",
            "query" => $query,
            "oper" => "=",
            "page" => "1",
            "rp" => "1000",
            "sortname" => $this->qtypeIXC->estoque_produtos_almox_filial().".id",
            "sortorder" => "desc",
            "status" => "S",
        ];

        return $data;
    }
}

?>