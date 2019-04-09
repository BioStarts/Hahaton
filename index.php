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
        if (isset($id)) {
            switch ($_POST['action']) {
                case 'assign':
                    $assignerId = $_POST['assigner'];
                    $assigneeId = $_POST['assignee'];

                    $assigner = $user->findById($id);
                    if ($assigner && $assigner['level'] > 300) {
                        $case->assign($id, $assignerId, $assigneeId);
                    }
                    break;
                case 'status':
                    $newStatus = $_POST['status'];

                    if (in_array($newStatus, [0, 1 ,2])) {
                        $case->setStatus($id, $newStatus);
                    }
                    break;
                default:
                    echo json_encode($case->findById($id));
            }
        } else {
            switch ($_POST['action']) {
                case 'create':
                    $title = $_POST['title'];
                    $desc = $_POST['description'];
                    $contact = $_POST['contact'];

                    echo $case->create($title, $desc, $contact);
                    break;
                default:
            }
        }
        break;

    //создание кейса
    //назначение кейса (делаем проверку что эксперт level 100+)
    //изменение статуса кейса

    //сообщения по мессадж ид (добавить колонку msg_id)
    case 'messages':
        $chatId = $_GET['chat_id'];
        if (isset($chatId)) {
            echo json_encode($message->findByChatId($chatId));
        } else {
            echo json_encode($message->all());
        }
        break;

    case 'message':
        $id = $_GET['id'];
        if (isset($id)) {
            echo json_encode($message->findById($id));
        } else {
            $user   = $_POST['user'];
            $text   = $_POST['text'];
            $chatId = $_POST['chat_id'];

            echo $message->create($user, $text, $chatId);
        }
        break;

    case 'login':
        $username = $_GET['username'];
        $password = $_GET['password'];
        echo json_encode($auth->login($username, $password));
        break;
    default:
        return new Error("Page Not Found", 404);
}
