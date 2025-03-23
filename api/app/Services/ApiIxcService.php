<?php 

require_once __DIR__ . '/../../config/ApiIXC.php';
require_once __DIR__ . '/../Helpers/DataApiIXC.php';
require_once __DIR__ . '/../Helpers/methodListApiIXC.php';

$method = $_SERVER["REQUEST_METHOD"];


class ApiIXC {
    private $baseURL;
    private $username;
    private $password;
    private $body;
    private $methodIXC;

    public function __construct()
    {
        $this->baseURL =  constant("URL");
        $this->username = constant("USERNAME");
        $this->password = constant("PASSWORD");
        $this->body = new DataApiIXC();
        $this->methodIXC = new ListMethod();
    }

    public function listarOSClienteAll(){
        $body = $this->body->dataBodyListarOsClientAll();
        $methodH = $this->methodIXC->listarIXC();
        return $this->request(
            "su_oss_chamado",
            "POST",
             $body,
             $methodH
        );
    }

    public function listarOsClienteTecnico($qtype, $query, $oper, $sortname, $sortorder){
        $body = $this->body->dataBodyListarOsClienteTecnico($qtype, $query, $oper, $sortname, $sortorder);
        $methodH = $this->methodIXC->listarIXC();

        return $this->request(
            "su_oss_chamado",
            "POST",
            $body,
            $methodH
        );

    }


    private function request($endpoint, $method = "GET", $data = [], $methodHeader) {
        $url = $this->baseURL . $endpoint;

        $ch = curl_init($url);

        //configurar Basic Auth
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);

        //configurar Cabeçalhos
        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            $methodHeader
        ];

        if ($method !== "GET") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //envia o json no corpo
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Executa requisiçao
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return json_encode([
                "erro" => "Erro ao conectar com a API do IXCSoft.",
                "status" => $httpCode
            ]);
        }

        return json_decode($response, true);
    }

}

?>