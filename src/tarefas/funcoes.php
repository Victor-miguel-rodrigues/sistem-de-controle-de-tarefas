<?php

include_once  '../dados/tarefas.php';


/**
 * Summary of tarefas
 * @param string $nomeTarefa
 * @param bool $statusTarefa
 * @param string $tipoTarefa
 * @param string $descricaoTarefa
 * @param string $dataCriacao
 * @param string $dataFinalizacao
 */
function tarefas(string $nomeTarefa,bool $statusTarefa, string $tipoTarefa,string $descricaoTarefa,string $dataCriacao, string $dataFinalizacao)  
{
    // pega o local do arquivo
    $localArquivo = '../dados/dados.json';
    // cria um array com os dados recebidos da função
    $arrayDeTarefas = [
        'nome' => $nomeTarefa,
        'status' => $statusTarefa,
        'categoria' => $tipoTarefa,
        'descricao' => $descricaoTarefa,
        'criado' => $dataCriacao,
        'data_de_finalizacao' => $dataFinalizacao  
    ];

    // interface para verificar se o arquivo existe
    if(file_exists($localArquivo))
    {
        //o file_get_contents faz a leitura do arquivo
        $vazio = file_get_contents($localArquivo);
        // se o arquivo não estiver vazio entra aqui
        if(!empty($vazio))
        {
            // recebe o valor lido
            $jsonArquivo = $vazio;

            // interface de decodificação de arquivo json para objeto
            $jsonArquivo = json_decode($jsonArquivo,true);

            // verifica se oq esta no arquivo json e diferente que esta no array agora
            if($jsonArquivo != $arrayDeTarefas){
                // faz a junção dos dois array
                $jsonArquivo = array_merge($jsonArquivo, [$arrayDeTarefas]);

                // por fim depois dos dados juntos escreve novamente no arquivo json
                file_put_contents($localArquivo, json_encode($jsonArquivo));
                header("Location: ../../index.php");
                sleep(1);
                exit;
            }
        }else {
            // se o arquivo existe e esta vazio ele escreve no arquivo 1 unica vez
            // json_encode ->  converte um array/string etc para um arquivo json
             file_put_contents($localArquivo, json_encode([$arrayDeTarefas]), FILE_APPEND);
        }
    }else
    {
        // se o arquivo nao existe ele cria e escreve no arquivo
       file_put_contents($localArquivo, json_encode([$arrayDeTarefas]), FILE_APPEND);
    }
}


/**
 * resumo of dados_post
 * Função para receber e tratar os dados do formulario
 * @return void
 */
function dados_post() 
{
    // trabalhando com variaveis globais pq a função não aceita apenas chamar
    // mudar para get,set futuramente
   global $nomeTarefa,$tipoTarefa,$descricaoTarefa,$dataCriacao,$dataFinalizacao;

   // verificando se o formulario foi enviado
   // isset -> existe e diferente de nulo
   if(isset($_POST['btn']))
   {
     // condição para verificar se os dados recebidos não sao nulos
     if(!empty($_POST['tipo_tarefa']) and !empty($_POST['descricao_tarefa']) and !empty($_POST['data_criacao']) and !empty($_POST['data_finalizacao_tarefa']) )
        {
            $nomeTarefa = strip_tags($_POST['nome_tarefa']);
            $tipoTarefa = strip_tags($_POST['tipo_tarefa']);
            $descricaoTarefa = strip_tags($_POST['descricao_tarefa']);
            $dataCriacao = strtotime($_POST['data_criacao']);
            $dataFinalizacao = strtotime($_POST['data_finalizacao_tarefa']);

            // data
            //$dataCriacao = $dataCriacao > $dataFinalizacao ? $dataFinalizacao : $dataCriacao;

            if($dataCriacao > $dataFinalizacao or $dataFinalizacao < $dataCriacao)
            {
                header("Location: ../../index.php?data=invalid");
                sleep(1);
                exit();
            }else
            {
                // função para trabalhar a tarefa
                tarefas($nomeTarefa,false,$tipoTarefa,$descricaoTarefa,$dataCriacao,$dataFinalizacao);
            }
        }else 
        {
         // caso os dados esteja vazios ou algum dado faltando vai retorna a tela inicial
         header("Location: ../../index.php?invalido=error");
         sleep(1);
         exit();
        }
   }else
   {
     // caso o formulario nao exista
     header("Location: ../../index.php?invalido=error");
     sleep(1);
     exit();
   }
}

function prioridade_tarefas()
{

}

dados_post();