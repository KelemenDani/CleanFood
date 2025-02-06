<?php
require_once "User.php";

class UserService
{

    static function register(User $user)
    {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $phonenumber = $user->getPhonenumber();
        $zipcode = $user->getZipcode();
        $city = $user->getCity();

        if ($name && $email && $password) {
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
            $user->setPassword($hashedPassword);
            $modelResult = User::registerUser($user);


            if ($modelResult) {
                return [
                    'status' => 200,
                    'message' => 'User Registered',
                ];

            } else {
                return [
                    'status' => 500,
                    'message' => 'Registration failed',
                ];
            }

        } else {
            return [
                'status' => 417,
                'message' => 'Missing Credencials',
            ];
        }
    }

    static function login(User $user)
    {
        $email = $user->getEmail();
        $password = $user->getPassword();

        if ($email && $password) {
            $hashedPassword = User::loginUser($email);

            $isLoginSuccesful = password_verify($password,$hashedPassword);


            if ($isLoginSuccesful) {
                return [
                    'status' => 200,
                    'message' => 'User Registered',
                ];

            } else {
                return [
                    'status' => 500,
                    'message' => 'Registration failed',
                ];
            }

        } else {
            return [
                'status' => 417,
                'message' => 'Missing Credencials',
            ];
        }
    }
}