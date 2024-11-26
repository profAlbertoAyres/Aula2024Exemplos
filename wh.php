<?php

function enviarWhatsApp($numero, $mensagem) {
    $url = 'https://api.whatsapp.com/send?phone=' . $numero . '&text=' . urlencode($mensagem);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resultado = curl_exec($ch);
    curl_close($ch);
    return $resultado;
}

$numero = "+5569984615331";
$mensagem = "Olá";

enviarWhatsApp ($numero, $mensagem);

