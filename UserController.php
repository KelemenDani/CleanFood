<?php

require_once 'UserService.php';
require_once 'Request.php';
require_once 'Response.php';

class UserController{

    static function registerUser(Request $request) {

        $userArray = $request->getBody();

        $user = new User($userArray['name'], $userArray['email'], $userArray['password'], $userArray['phonenumber'], $userArray['zipcode'], $userArray['city'],);
        $response = UserService::register($user);

        return $response;
    }

}