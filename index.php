<?php

require_once ("./layout/header.php");


if (isset($_GET['action']) && file_exists('./views/' . $_GET['action'] . '.php')) {
    require_once './views/' . $_GET['action'] . '.php';
}else {
    require_once ("./views/main.php");
}

require_once ("./layout/footer.php");
