<?php

include_once '../../config.php';


function inserir_dados(string $nome_tarefa, string $categoria, string $descricao, string $dataCriacao, string $dataFinalizacao)  {

      global $connect;

      $sql = 'SELECT * FROM tarefas';

      try{
            if(criar_tabela($sql)){
                  enviar_dados($nome_tarefa,$categoria,$descricao,$dataCriacao,$dataFinalizacao);
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

function enviar_dados(string $nome_tarefa, string $categoria, string $descricao, string $dataCriacao, string $dataFinalizacao){

      global $connect; 

      if(!empty($nome_tarefa) and !empty($categoria) and !empty($descricao) and !empty($dataCriacao) and !empty($dataFinalizacao))
      {
          $sql  = "INSERT into tarefas (nome,categoria,descricao,data_criacao,data_finalizacao) values ('$nome_tarefa','$categoria', '$descricao','$dataCriacao','$dataFinalizacao')";
          if(mysqli_query($connect,$sql)){
               header("Location: ../../index.php");
               sleep(2);
          }else{
               header("Location: ../../index.php?incorret=failed");
               sleep(2);           
          }
      
      }
}