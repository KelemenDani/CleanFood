<?php
require_once "Router.php";
require_once 'UserController.php';

Router::get("/",function($request,$response){
    $response->Setbody([]);
    $response->SetHtmlStatus(200);
    $response->Setmessage("success");

});

Router::post("/register",function($request,$response){
    $result = UserController::registerUser($request);
    $response->SetHtmlStatus(200);
    $response->Setmessage("success");
});

$response = Router::handleRequest();