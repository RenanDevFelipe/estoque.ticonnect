<?php 

class functionAPIixc {
    public function getmaiorZero($phpGet, $id_filial) {
        // Verifica se as chaves necessárias existem no array
        if (!isset($phpGet['total'], $phpGet['registros']) || !is_array($phpGet['registros'])) {
            return ["total" => 0, "registros" => []]; // Retorna vazio se os dados não forem válidos
        }

        // Filtra os itens que possuem saldo maior que zero e pertencem à filial correta
        $response = array_filter($phpGet['registros'], function ($item) use ($id_filial) {
            return isset($item['saldo'], $item['id_filial']) &&
                   floatval($item['saldo']) > 0 &&
                   intval($item['id_filial']) === intval($id_filial);
        });

        // Retorna os resultados com um total atualizado
        return [
            "total" => count($response),
            "registros" => array_values($response) // Reindexa o array
        ];
    }
}

?>
