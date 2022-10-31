<?php
header("Content-Type: application/json");

require "db.php";
require "functions.php";
$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];

$params = explode('/', $q);

if ($params[0] === 'users') {
    switch ($method) {
        case 'GET':
            if (isset($params[1])) {
                getUser($conn, $params[1]);
            } else {
                getUsers($conn);
            }
            break;
        case 'POST':
            addUser($conn, $_POST);
            break;
        case 'PATCH':
            if (isset($params[1])) {
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                updateUser($conn, $params[1], $data);
            }
            break;
        case 'DELETE':
            if (isset($params[1])) {
                deleteUser($conn, $params[1]);
            }
            break;
    }
} else {
    http_response_code(404);

    echo json_encode(array(
        "status" => true,
        "message" => "this page does not exist"
    ));
}
