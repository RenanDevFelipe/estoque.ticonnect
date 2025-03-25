<?php 


require_once __DIR__ . "/../app/Services/ApiIxcService.php";
require_once __DIR__ . "/../app/Helpers/IXCSoft/MethodList/functionsApi.php";

$ixcService = new ApiIXC();
$fuctionIXC = new functionAPIixc();

$uri = $_SERVER['REQUEST_URI'];

// Removendo o prefixo correto da URL
$prefix = '/controlzapi/api/public/';
if (strpos($uri, $prefix) === 0) {
    $uri = substr($uri, strlen($prefix));
}

// Removendo barras extras
$uri = trim(parse_url($uri, PHP_URL_PATH), "/");

// Verificando a rota
if ($uri == "oscliente/listAll" && $_SERVER['REQUEST_METHOD'] == "GET") {
    echo json_encode($ixcService->listarOSClienteAll());
} 

elseif ($uri == "osclienteTecnico/listAll" && $_SERVER['REQUEST_METHOD'] == "GET" ) {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($ixcService->listarOsClienteTecnico($data['qtype'], $data['query'], $data['oper'], $data['sortname'], $data['sortorder']));

}

elseif ($uri == "almoxTecnico/listTec" && $_SERVER['REQUEST_METHOD'] == "GET"){
    $data = json_decode(file_get_contents("php://input"), true);
    $response = $ixcService->listarAlmoxTecnico($data['query']);
    echo json_encode($fuctionIXC->getmaiorZero($response, $data['id_filial']));
}

else {
    echo json_encode([
        "erro" => "Rota não encontrada",
        "URI" => $uri
    ]);
}

?>