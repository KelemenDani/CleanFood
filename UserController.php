<?php

require_once 'UserService.php';
require_once 'Request.php';
require_once 'Response.php';

class UserController {

    static function registerUser(Request $request) {
        session_start();
        $userArray = $request->getBody();

        $user = new User(
            null, 
            $userArray['name'],
            $userArray['email'],
            $userArray['password'],
            $userArray['phonenumber'],
            $userArray['zipcode'],
            $userArray['city']
        );
        $response = UserService::register($user);

        if ($response['status'] == 200) {
            header("Location: /login.php");
            exit();
        } else {
            return $response;
        }
    }

    static function loginUser(Request $request) {
        session_start();
        $userArray = $request->getBody();
        $email = $userArray['email'];
        $password = $userArray['password'];

        $response = UserService::login($email, $password);

        if ($response['status'] == 200) {
            header("Location: /main.php");
            exit();
        } else {
            $_SESSION['login_error_message'] = $response['message'];
            header("Location: /login.php");
            exit();
        }
    }
}