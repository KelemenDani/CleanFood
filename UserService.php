<?php
require_once "User.php";

class UserService {

    static function register(User $user) {
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $phonenumber = $user->getPhoneNumber();
        $zipcode = $user->getZipCode();
        $city = $user->getCity();

        if ($name && $email && $password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $user->setPassword($hashedPassword);
            $modelResult = User::registerUser($user);

            if ($modelResult) {
                return [
                    'status' => 200,
                    'message' => 'User Registered',
                ];
            } else {
                return [
                    'status' => 409,
                    'message' => 'Email already exists',
                ];
            }
        } else {
            return [
                'status' => 417,
                'message' => 'Missing Credentials',
            ];
        }
    }

    static function login($email, $password) {
        $config = new Config();
        $connection = $config->getConnection();

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['jelszo'])) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                return [
                    'status' => 200,
                    'message' => 'Login successful',
                ];
            } else {
                return [
                    'status' => 401,
                    'message' => 'Invalid password',
                ];
            }
        } else {
            return [
                'status' => 404,
                'message' => 'Email not found',
            ];
        }
    }
}