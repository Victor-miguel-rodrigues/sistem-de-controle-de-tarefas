<?php

function formatando_datas($data)
{

    $mot = time();
    $diferenca = $data - strtotime($mot);

    $segundo = $diferenca;
    $minutos = round($diferenca / 60);
    $horas = round($diferenca / 3600);
    $dia = round($diferenca / 86400);
    $semana = round($diferenca / 604800);

    if($segundo <= 60){
        return 'agora';
    }else if($minutos <= 60){
        return $minutos == 1 ? "há 1 minuto" : "há ". $minutos. " minutos";
    }else if($horas <= 24){
        return $horas == 1? "há 1 hora": "há ". $horas . " horas";
    }else if($dia <= 6){
        return $dia == 1 ? "há 1 dia" : "há " . $dia ." dias";
    }

    $semanas = ['domingo','segunda-feira','terça-feira','quarta-feira','quinta-feira','sexta-feira','sabado'];
    $mes = [
        'janeiro',  'fevereiro','março','abril', 'maio','junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro','dezembro'
    ];

    $diasem = date('d', $data);
    $seman = date('w', $data);
    $meses  = date('n', $data) - 1;
    $ano = date('Y', $data);

    return $semanas[$seman]. ": Dia ". $diasem. " de ". $mes[$meses]. " de ". $ano ;
}