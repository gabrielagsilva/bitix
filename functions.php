<?php 

function jsonToArray() {
    /**
     * Lê o arquivo json/precos.json e retorna um array no formato:
     * 
     * Array (
     *      [registro] => Array (
     *                  [minimo_i] => Array (
     *                                  [faixa1] => valor_faixa_1
     *                                  [faixa2] => valor_faixa_2
     *                                  [faixa3] => valor_faixa_3
     *                                ),
     *                  [minimo_i] => Array (
     *                                  [faixa1] => valor_faixa_1
     *                                  [faixa2] => valor_faixa_2
     *                                  [faixa3] => valor_faixa_3
     *                                ), ...
     *               ),...
     * )
     */
    $json = file_get_contents('json/precos.json');
    $json = json_decode($json, true);
    $precos = array();
    foreach($json as $j) {
        $precos[$j['codigo']][$j["minimo_vidas"]]["faixa1"] = $j["faixa1"];
        $precos[$j['codigo']][$j["minimo_vidas"]]["faixa2"] = $j["faixa2"];
        $precos[$j['codigo']][$j["minimo_vidas"]]["faixa3"] = $j["faixa3"];
    }

    // ordenar para ficar por ordem de minimo de vidas
    foreach($precos as $key => $value)
        arsort($precos[$key]);

    return $precos;
}

function precos($registro, $n) {
    /** 
     * Retorna as faixas de preço de acordo com o codigo do plano de saude e 
     * a quantidade de beneficiarios.
     * 
     * Parametros:
     * $registro = número do registro
     * $n = quantidade de beneficiários
     * 
     * */
    
    $valores = null;
    $json_precos = jsonToArray(); 
    foreach($json_precos[$registro] as $minimo => $faixas) {
        if($n >= $minimo)
            $valores = $faixas;
    }
    
    return $valores;
}

function format_beneficiarios($input_beneficiarios) {
    /** 
     * Retorna um array com os beneficiarios no formato
     * Array (
     *         [0] => Array (
     *                         [nome] => nome
     *                         [idade] => idade
     *                ),
     *         [0] => Array (
     *                         [nome] => nome
     *                         [idade] => idade
     *                ), ...
     * 
     * Parametros:
     * $input_beneficiarios = input do formulario
     * 
     * */
    $beneficiarios = array();
    foreach (array_keys($input_beneficiarios) as $fieldKey) {
        foreach ($input_beneficiarios[$fieldKey] as $key=>$value) {
            $beneficiarios[$key][$fieldKey] = $value;
        }
    } 

    return $beneficiarios;
}

?>