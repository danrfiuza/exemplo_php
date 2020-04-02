<?php
    require_once 'database.php';
    // require_once 'helpers.php';
    // $sucesso = null;
    // $msg = tratarMensagens($_GET);
    // print_r($msg);

    if(isset($_POST['request'])) {
        $request = $_POST['request'];
        switch ($request) {
            case 'cadastrar':
                $sucesso = inserirJogador($_POST);
                break;
            case 'deletar':
                break;
            case 'alterar':
                break;
            default:
                # code
                break;
        }
        header("Location: index.php");
    }

    if(isset($_GET['request'])) {
        $request = $_GET['request'];
        switch ($request) {
            case 'buscar':
                ob_clean();
                echo json_encode(buscarJogadorPorId($_GET['id']));
                die;
                break;
            case 'deletar':
                $sucesso = deletarJogador($_GET['id']);
                break;
            case 'alterar':
                break;
            default:
                # code...
                break;
        }
        header("Location: index.php");
    }