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


function  alterar_dados_json()
{
    $caminho = 'src/dados/dados.json';
    
    if(file_exists($caminho))
    {
       $nova_lista = [];
        $arquivo = file_get_contents($caminho);
        $json = json_decode($arquivo, true);
        if(!empty($json))
        {
           
            foreach($json as $dado)
            {  
                 $tarefa  = [

                         'id' => criar_id(),
                         'nome' => $dado['nome'],
                         'status' => $dado['status'],
                         'descricao' => $dado['descricao'],
                         'categoria' => $dado['categoria'],
                         'prioridade' => prioridade_tarefas($dado['criado'],$dado['data_de_finalizacao']),
                         'criado' => $dado['criado'],
                         'data_de_finalizacao' => $dado['data_de_finalizacao']
                  ];

                $nova_lista[] = $tarefa;
                file_put_contents($caminho, json_encode($nova_lista));
            }
              
        }else
        {
            header("Location ../../index.php");
        }
    }
}

function criar_id()
{
    static $id;
    $id += 1;
    return $id;
    
}

function prioridade_tarefas($d1,$d2)
{

    $tempoRestante = $d2 - $d1;

  $segundo = $tempoRestante;
    $minutos = round($tempoRestante / 60);
    $horas = round($tempoRestante / 3600);
    $dia = round($tempoRestante / 86400);
    $semana = round($tempoRestante / 604800);
    $mes = round($tempoRestante / 2629800);
    $ano = round($tempoRestante / 29030400);


    if($segundo <= 60)
    {
        return "Urgente 1";
    }else if($minutos <= 60)
    {
        return "Urgente 2";
    }else if($horas <= 24)
    {
         return "Urgente 3";
    }else if($dia <= 6)
    {
        return "medio";
    }else if($semana <= 4)
    {
        return "medio";
    }else if($mes < 12)
    {
        return "baixo ";
    }else if($ano > 1) 
    {
        return "baixo";
    }
}



/*

if(file_exists($caminho))
    {
        $arquivo = file_get_contents($caminho);
        $json = json_decode($arquivo, true);
        if(!empty($json))
        {
           
            foreach($json as $dado)
            {  
                   $nova_lista = [
                    
                     'id' => criar_id(),
                     'nome' => $dado['nome'],
                     'status' => $dado['status'],
                     'descricao' => $dado['descricao'],
                     'categoria' => $dado['categoria'],
                     'prioridade' => prioridade_tarefas($dado['criado'],$dado['data_de_finalizacao']),
                     'criado' => $dado['criado'],
                     'data_de_finalizacao' => $dado['data_de_finalizacao']
                    
                   ];
                 
                
            }
              
           # 
        }else
        {

        }
    }

    */