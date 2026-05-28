<?php
include_once 'config.php'; 
//include_once 'src/tarefas/data.php';

echo "<br>";
echo "". NOME_SITE. " ";
echo "<br>";

include_once 'view/tarefa.php';


if(isset($_GET['invalido']) and $_GET['invalido'] == 'error')
{
    echo "<br><p>". "Error: Tentativa de envio de dados falhou dados nulo ou incorretos". "</p>";
}else if(isset($_GET['data']) and $_GET['data'] == 'invalid')
{
    echo "<br><p>". "Error: Data de criação não pode ser maior que data de finalização ou vice-versa". "</p>";
}

include_once 'view/header.php';