<?php

use App\FontGroupManager;
use App\FontUploader;
use App\Router;

require 'vendor/autoload.php';

$router = new Router();

$router->addRoute('GET', '/', function() {
    require 'index.php';
});

$router->addRoute('GET', '/fonts', function() {
    $uploader = new FontUploader();
    $fonts = $uploader->getUploadedFonts();
    echo json_encode($fonts);
});

$router->addRoute('POST', '/upload-font', function() {
    $uploader = new FontUploader();
    $response = $uploader->upload($_FILES['font']);
    echo $response->toJson();
});

$router->addRoute('POST', '/delete-font', function() {
    $uploader = new FontUploader();
    $response = $uploader->delete($_POST['fontUrl']);
    echo $response->toJson();
});

$router->addRoute('GET', '/groups', function() {
    $groupManager = new FontGroupManager();
    $groups = $groupManager->getGroups();
    echo json_encode($groups);
});

$router->addRoute('POST', '/create-group', function() {
    $groupManager = new FontGroupManager();
    $response = $groupManager->createGroup($_POST['groupName'], $_POST['fonts'], $_POST['name']);
    echo $response->toJson();
});

$router->addRoute('POST', '/edit-group', function() {
    $groupManager = new FontGroupManager();
    $response = $groupManager->editGroup($_POST['groupId']);
    echo json_encode($response);
});

$router->addRoute('POST', '/update-group', function() {
    $groupManager = new FontGroupManager();
    $response = $groupManager->updateGroup($_POST['groupId'], $_POST['groupName'], $_POST['fonts'], $_POST['name']);
    echo $response->toJson();
});

$router->addRoute('POST', '/delete-group', function() {
    $groupManager = new FontGroupManager();
    $response = $groupManager->deleteGroup($_POST['groupId']);
    echo $response->toJson();
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], PHP_URL_PATH);
