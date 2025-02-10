<?php
require_once "Router.php";
require_once 'UserController.php';

Router::get("/", function($request, $response) {
    $response->Setbody([]);
    $response->SetHtmlStatus(200);
    $response->Setmessage("success");
});

Router::post("/register", function($request, $response) {
    $result = UserController::registerUser($request);
    if ($result['status'] != 200) {
        $_SESSION['error_message'] = $result['message'];
        header("Location: /index.php");
        exit();
    }
});

Router::post("/login", function($request, $response) {
    UserController::loginUser($request);
});

$response = Router::handleRequest();