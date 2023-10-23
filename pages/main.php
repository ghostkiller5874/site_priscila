<?php
ob_start();
//include('../config.php');

if (Painel::logado() == false) {
    include('login.php');
} else {
    include('Perfil.php');
}
ob_end_flush();
