<?php

function tratarMensagens($get) {
    $success = $get['success'] ?? false;
    $type    = $get['msg'] ?? false;
    $msg = '';
    switch ($type) {
        case 'insert':
            if($success) {
                $msg = 'INSERIDO COM SUCESSO';
            }else {
                $msg = 'ERRO AO INSERIR';
            }
            break;
        case 'delete':
            if($success) {
                $msg = 'DELETADO COM SUCESSO!';
            }else {
                $msg = 'ERRO AO DELETAR.';
            }
        default:
        $msg = '';
            break;
    }
    return $msg;
}