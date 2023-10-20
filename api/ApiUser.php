<?php

require_once '../Controllers/UserController.php';

if (isset($_GET['action']) && $_GET['action'] === 'index') {
    $controller = new UserController();
    $result = $controller->index();
    echo $result;
}

if (isset($_GET['action']) && $_GET['action'] === 'store') {
    $controller = new UserController();
    $result = $controller->store();
    echo $result;
}

if (isset($_GET['action']) && $_GET['action'] === 'pdf') {
    $controller = new UserController();
    $result = $controller->generatePDF();
    echo $result;
}

if (isset($_GET['action']) && $_GET['action'] === 'show') {
    $controller = new UserController();
    $result = $controller->show();
    echo $result;
}

if (isset($_GET['action']) && $_GET['action'] === 'update') {
    $controller = new UserController();
    $result = $controller->update();
    echo $result;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $controller = new UserController();
    $result = $controller->delete();
    echo $result;
}
