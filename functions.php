<?php

function getUsers($conn)
{
    $users = mysqli_query($conn, "SELECT * FROM `crud`");

    $userList = [];
    while ($user = mysqli_fetch_assoc($users)) {
        $userList[] = $user;
    }
    echo json_encode($userList);
}
function getUser($conn, $id)
{
    $user = mysqli_query($conn, "SELECT * FROM `crud` WHERE `id` = '$id'");
    if (mysqli_num_rows($user) === 0) {
        http_response_code(404);
        echo json_encode(array(
            "status" => false,
            "message" => "User not found"
        ));
    } else {
        $user = mysqli_fetch_assoc($user);
        echo json_encode($user);
    }
}

function addUser($conn, $data)
{
    $login = $data['login'];
    $password = $data['password'];
    $email = $data['email'];
    $gender = $data['gender'];

    $passwordhash = md5($password);

    mysqli_query($conn, "INSERT INTO `crud`(`id`, `login`, `password`, `email`, `gender`) VALUES (NULL,'$login','$passwordhash','$email','$gender')");
    http_response_code(201);
    echo json_encode(array(
        "status" => true,
        "user_id" => mysqli_insert_id($conn)
    ));
}

function updateUser($conn, $id, $data)
{
    $login = $data['login'];
    $password = $data['password'];
    $email = $data['email'];
    $gender = $data['gender'];

    $passwordhash = md5($password);
    mysqli_query($conn, "UPDATE `crud` SET `login`='$login',`password`='$passwordhash',`email`='$email',`gender`='gender' WHERE `crud`.`id` = '$id'");
    http_response_code(200);
    echo json_encode(array(
        "status" => true,
        "message" => "User successfully update."
    ));
}

function deleteUser($conn, $id)
{
    mysqli_query($conn, "DELETE FROM `crud` WHERE `crud`.`id` = '$id'");
    http_response_code(200);

    echo json_encode(array(
        "status" => true,
        "message" => "user successfully deleted."
    ));
}
