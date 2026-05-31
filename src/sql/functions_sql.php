<?php

include_once __DIR__ . '/../../config.php';

include_once __DIR__ . '/../tarefas/data.php';

function inserir_dados(string $nome_tarefa,$status = false, string $categoria,string $prioridade, string $descricao, string $dataCriacao, string $dataFinalizacao)  {

      global $connect;

      $sql = 'SELECT * FROM tarefas';

      try{
            if(criar_tabela($sql)){
                  enviar_dados( $nome_tarefa,$status = false, $categoria,$prioridade,  $descricao, $dataCriacao,  $dataFinalizacao);
            }else{
                  $sql = "CREATE TABLE tarefas (id int auto_increment, nome varchar(100) not null, categoria varchar(50) not null, descricao varchar(250) not null, data_criacao varchar(100) not null,
                  data_finalizacao varchar(100) not null, primary key(id))";

                  if(mysqli_query($connect,$sql)){
                        echo "Tabela criada";
                  }else{
                        echo "Tentativa de criar tabela falhou";
                  }
            }
      }catch(mysqli_error){
            echo $connect->mysqli_error;
      }
}


function criar_tabela($sql) : bool{

      global $connect;

      $resultado = mysqli_query($connect,$sql);

      if($resultado){
            return true;
      }else{
            return false;
      }
}

function enviar_dados(string $nome_tarefa,$status = false, string $categoria,string $prioridade, string $descricao, string $dataCriacao, string $dataFinalizacao){

      global $connect; 

      if(!empty($nome_tarefa) and !empty($categoria) and !empty($descricao) and !empty($prioridade) and !empty($dataCriacao) and !empty($dataFinalizacao))
      {
          $statusModificado = ($status == true) ? "Concluido" : "Pendente";

          $sql  = "INSERT into tarefas (nome,status,categoria,prioridade,descricao,data_criacao,data_finalizacao) VALUES ('$nome_tarefa','$statusModificado','$categoria','$prioridade', '$descricao','$dataCriacao','$dataFinalizacao')";
          if(mysqli_query($connect,$sql)){
               header("Location: ../../index.php");
               sleep(2);
          }else{
               header("Location: ../../index.php?incorret=failed");
               sleep(2);           
          }
      
      }
}


/**
 * Summary of save
 * @return void
 */
function save(){

      $caminho = "../dados/dados.json";
      global $connect;

      if(file_exists($caminho)){
            $arquivo = file_get_contents($caminho);
            $json = json_decode($arquivo, true);
            
            foreach($json as  $tarefa){
                  $nome = $tarefa['nome'];
                  $status = $tarefa['status'];
                  $descricao = $tarefa['descricao'];
                  $categoria = $tarefa['categoria'];
                  $prioridade = $tarefa['prioridade'];
                  $criado = $tarefa['criado'];
                  $finalizacao = $tarefa['data_de_finalizacao'];

                  $statusModificado = ($status == true) ? "COncluido" : "Pendente";
               
                  if(!empty($nome) and !empty($statusModificado) and !empty($descricao) and !empty($categoria) and !empty($prioridade) and !empty($criado) and !empty($finalizacao)){   
                         $sql = "INSERT INTO tarefas (nome,status,categoria,prioridade,descricao,data_criacao,data_finalizacao) VALUES ('$nome','$statusModificado','$categoria','$prioridade','$descricao','$criado','$finalizacao')";
                         //var_dump($sql)
                         if(mysqli_query($connect,$sql)){
                              header("Location: ../../index.php?save=sucesso");
                              sleep(0.5);
                         }else{
                              echo "Falha";
                         }

                  }else{
                        echo "Dados faltando";
                  }
                  //$sql = "INSERT INTO tarefas (nome,status,categoria,prioridade,descricao,data_criacao,data_finalizacao) values ('$nome','$status','$categoria', '$prioridade','$descricao','$criado','$finalizacao')";

            }
      }else {
            echo "Não existe";
      }
}



function exibir(){

      global $connect;

      $sql = "SELECT * from tarefas order by prioridade desc";
      if($resultado = mysqli_query($connect,$sql)) {            
            $dados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
            foreach($dados as $dado){
                  echo "Nome da tarefa :" . $dado['nome']. "<br>";
                  echo "Status da tarefa :". $dado['status']. "<br>";
                  echo "Categoria da tarefa :" . $dado["categoria"]   . "<br>"; 
                  echo "Prioridade" . $dado['prioridade']. "<br>";
                  echo "Descrição :" . $dado['descricao']. "<br>";
                  echo "Data de criação :" . formatando_datas($dado['data_criacao']) . "<br>";
                  echo "data de finalização :" . formatando_datas($dado['data_finalizacao']) . "<br>";
                  echo "<br><br>";
            }
      }
}