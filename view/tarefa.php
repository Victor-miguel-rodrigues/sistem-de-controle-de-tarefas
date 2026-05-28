<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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

    
</body>
</html>