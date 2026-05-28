<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <section>
        <h3>Tarefas criadas</h3>

        <form action="" method="post">
          <?php
            require_once './src/tarefas/data.php';


            $caminho = './src/dados/dados.json';

            
            if(file_exists($caminho))
            {
                $verificar = file_get_contents($caminho);
                if(!empty($verificar))
                {
                    $arquviDecod = json_decode($verificar, true);
                    foreach($arquviDecod as $cabecalho)
                    {
                        if(prioridade_tarefas($cabecalho['criado'],$cabecalho['data_de_finalizacao'])  == 'Urgente 1' or prioridade_tarefas($cabecalho['criado'],$cabecalho['data_de_finalizacao']) == "Urgente"){
                               echo "Nome da tarefa :". $cabecalho['nome'] . "<br>";
                               echo "Categoria :". $cabecalho['categoria'] . "<br>";
                               echo "Prioridade :". prioridade_tarefas($cabecalho['criado'],$cabecalho['data_de_finalizacao']) . "<br>";
                               echo "Desc Tarefa :" . $cabecalho['descricao'] . "<br>";
                               echo "Criado :". formatando_datas($cabecalho['criado']). "<br>";
                               echo "Data Para Finalizar :". formatando_datas($cabecalho['data_de_finalizacao']). "<br>";
                               echo "<label for='status'>Status da tarefa : </label>" . ($cabecalho['status'] == false ? 'Tarefa Pendente' : "Tarefa concluida"). "<br><br>";
                        }
                        if(prioridade_tarefas($cabecalho['criado'],$cabecalho['data_de_finalizacao']) == 'medio'){
                               echo "Nome da tarefa :". $cabecalho['nome'] . "<br>";
                               echo "Categoria :". $cabecalho['categoria'] . "<br>";
                               echo "Prioridade :". prioridade_tarefas($cabecalho['criado'],$cabecalho['data_de_finalizacao']) . "<br>";
                               echo "Desc Tarefa :" . $cabecalho['descricao'] . "<br>";
                               echo "Criado :". formatando_datas($cabecalho['criado']). "<br>";
                               echo "Data Para Finalizar :". formatando_datas($cabecalho['data_de_finalizacao']). "<br>";
                               echo "<label for='status'>Status da tarefa : </label>" . ($cabecalho['status'] == false ? 'Tarefa Pendente' : "Tarefa concluida"). "<br><br>";
                        }
                        else{
                               echo "Nome da tarefa :". $cabecalho['nome'] . "<br>";
                               echo "Categoria :". $cabecalho['categoria'] . "<br>";
                               echo "Prioridade :". prioridade_tarefas($cabecalho['criado'],$cabecalho['data_de_finalizacao']) . "<br>";
                               echo "Desc Tarefa :" . $cabecalho['descricao'] . "<br>";
                               echo "Criado :". formatando_datas($cabecalho['criado']). "<br>";
                               echo "Data Para Finalizar :". formatando_datas($cabecalho['data_de_finalizacao']). "<br>";
                               echo "<label for='status'>Status da tarefa : </label>" . ($cabecalho['status'] == false ? 'Tarefa Pendente' : "Tarefa concluida"). "<br><br>";
                        }
                    }
                    
                }
            }else
            {
                echo 'entrei aqui';
            }
        ?>

        </form>
    </section>
</body>
</html>