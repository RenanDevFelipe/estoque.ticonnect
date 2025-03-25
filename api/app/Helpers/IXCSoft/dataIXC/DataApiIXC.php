<?php 

require_once __DIR__ . "/../BodyRequest/BodyIXC.php";



class DataApiIXC {

    private $bodyRequest;

    public function __construct()
    {
        $this->bodyRequest = new ModelBodyRequest();
    }

    public function dataBodyListarOsClientAll(){
        return json_encode($this->bodyRequest->BodyRequest());
    }

    public function dataBodyListarOsClienteTecnico($qtype, $query, $oper, $sortname, $sortorder){
        return $this->bodyRequest->BodyRequestModelDinamic($qtype, $query, $oper, $sortname, $sortorder);
    }

    public function dataBodyAlmoxTec($query){
        return $this->bodyRequest->BodyAlmoxTecnico($query);
    }
}


