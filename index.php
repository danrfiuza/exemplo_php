<?php
require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>
    <h3><?= date('d/m/Y H:i:s');?></h3>
    <h3><?= (  $msg ?? "");?></h3>
    <form action="controller.php" method="POST">
        
        <input type="hidden" name="id" id="id" value="<?php echo ($_POST['id'] ?? ''); ?>" />
        
        <input type="hidden" name="request" value="cadastrar" />
        
        <fieldset>
            <legend><?php echo (isset($_POST['id']) ? 'Alterar' : 'Cadastrar');?> Jogador</legend>
        <label for="nome">Nome do Jogador:</label>
        <input type="text" name="nome" id="nome" value="<?= $_POST['nome'] ?? ''; ?>"/>
        <button type="submit">
            Submit
        </button>
        </fieldset>
    </form>
    <fieldset>
        <legend>Lista de Jogadores</legend>
        <?php if($jogadores = listarJogadores()) : ?>

            <table style="width:100%">
                <tr>
                    <th>Ações</th>
                    <th>ID</th>
                    <th>Nome do Jogador</th>
                </tr>

                <?php foreach($jogadores as $jogador) { ?>
                    <tr>
                        <td>
                            <button onclick="alterarRegistro(<?= $jogador['id'];?>);">Alterar</button>
                            <button onclick="deletarRegistro(<?= $jogador['id'];?>);">Deletar</button>
                        </td>
                        <td><?= $jogador['id'];?></td>
                        <td><?= $jogador['nome'];?></td>
                    </tr>
                <?php } ?>

            </table>
        <?php else : ?>
            <h2>Não há registros!</h2>
        <?php endif; ?>
    </fieldset>
    </body>
</html>
<script src="index.js"></script>
