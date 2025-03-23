<?php 

class ModelBodyRequest {
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
}

?>