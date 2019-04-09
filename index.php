<?php
header('Content-Type: application/json');
require 'Controller.php';
require 'Connect.php';
require 'User.php';
require 'Cases.php';
require 'Messages.php';
require 'Auth.php';

$connection = new Connect('localhost', 'vk', 'root', '');
$user = new User($connection);
$case = new Cases($connection);
$message = new Messages($connection);
$auth = new Auth($connection);

switch ($_GET['query']) {
    case 'users':
        echo json_encode($user->all());
        break;

    case 'user':
        $id = $_GET['id'];
        echo json_encode($user->findById($id));
        break;

    case 'cases':
        echo json_encode($case->all());
        break;

    case 'case':
        $id = $_GET['id'];
        echo json_encode($case->findById($id));
        break;

    case 'messages':
        echo json_encode($message->all());
        break;

    case 'message':
        $id = $_GET['id'];
        echo json_encode($message->findById($id));
        break;

    case 'login':
        $username = $_GET['username'];
        $password = $_GET['password'];
        echo json_encode($auth->login($username, $password));
        break;
    default:
        return new Error("Page Not Found", 404);
}
