<?php

if (usuarioEstaLogado()) {
    $userlog = ucwords($_SESSION['usuario']['nome']);

    if ($_SESSION['usuario']['tipo'] == 'dono') {
        $mercName = $_SESSION['usuario']['id_usuario'];
        $mercado=$conn->prepare("SELECT * FROM mercado WHERE id_dono = :id_dono");
        $mercado->bindValue(':id_dono',$mercName,PDO::PARAM_INT);
        $mercado->execute();
        $infmercado = $mercado->fetch();

    }
}