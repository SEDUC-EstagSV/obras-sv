<?php

function formatarAutoridade($user_Autoridade)
{

    if ($user_Autoridade == 1) {
        $user_Autoridade = 'Pendente';
    } else if ($user_Autoridade == 2) {
        $user_Autoridade = 'Subordinado';
    } else if ($user_Autoridade == 3) {
        $user_Autoridade = 'Supervisor';
    } else if ($user_Autoridade == 4) {
        $user_Autoridade = 'Secretária';
    } else if ($user_Autoridade == 10) {
        $user_Autoridade = 'Admin';
    } else
        $user_Autoridade = 'A definir';

    return $user_Autoridade;
}

function formatarRelatorioSit($situacao)
{

    if ($situacao == 1) {
        $situacao = 'Pendente';
    } else if ($situacao == 2) {
        $situacao = 'Recusado';
    } else if ($situacao == 3) {
        $situacao = 'Aprovado';
    } else
        $situacao = 'A definir';

    return $situacao;
}
