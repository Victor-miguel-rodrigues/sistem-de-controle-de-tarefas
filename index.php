<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        include_once 'config.php'; 
    ?>
    <h1><?php echo NOME_SITE ?></h1>

    <h2>Dados da tarefa</h2>
    <form action="./src/tarefas/funcoes.php" method="post" >
        
        <label for="nome_tarefa">Nome da tarefa</label>
        <input type="text" name="nome_tarefa" id="nome_tarefa"> <br>
        <label for="tipo_tarefa">categoria da tarefa</label>
        <input type="text" name="tipo_tarefa" id="tipo_tarefa"> <br>
        <label for="descricao_tarefa">Descrição</label>
        <input type="text" name="descricao_tarefa" id="descricao_tarefa"> <br>
        <label for="data_criacao">data de iniciação da tarefa</label>
        <input type="date" name="data_criacao" id="data_criacao"> <br>
        <label for="data_finalizacao_tarefa">Data de finalização da tarefa</label>
        <input type="date" name="data_finalizacao_tarefa" id="data_finalizacao_tarefa"> <br>
        <button name="btn" type="submit">Criar tarefa</button>
    </form>
    <?php
        if(isset($_GET['invalido']) and $_GET['invalido'] == 'error')
        {
            echo "<br><p>". "Error: Tentativa de envio de dados falhou dados nulo ou incorretos". "</p>";
        }else if(isset($_GET['data']) and $_GET['data'] == 'invalid')
        {
            echo "<br><p>". "Error: Data de criação não pode ser maior que data de finalização ou vice-versa". "</p>";
        }
    ?>

    <section>
        <h3>Tarefas criadas</h3>
          <?php
            require_once 'src/tarefas/data.php';


            $caminho = 'src/dados/dados.json';

            
            if(file_exists($caminho))
            {
                $verificar = file_get_contents($caminho);
                if(!empty($verificar))
                {
                    $arquviDecod = json_decode($verificar, true);
                    foreach($arquviDecod as $cabecalho)
                    {
                           echo "Nome da tarefa :". $cabecalho['nome'] . "<br>";
                           echo "Categoria :". $cabecalho['categoria'] . "<br>";
                           echo "Desc Tarefa :" . $cabecalho['descricao'] . "<br>";
                           echo "Criado :". formatando_datas($cabecalho['criado']). "<br>";
                           echo "Data Para Finalizar :". formatando_datas($cabecalho['data_de_finalizacao']). "<br>";
                           echo "<label for='status'>Status da tarefa : </label>" . ($cabecalho['status'] == false ? 'Tarefa Pendente' : "Tarefa concluida"). "<br><br>";
                    }
                }
            }else
            {
                echo 'entrei aqui';
            }
        ?>
    </section>
</body>
</html>