<?php

require_once 'Config.php';

class User{
    private $id;
    private $name;
    private $email;
    private $password;
    private $phonenumber;
    private $zipcode;
    private $city;

    public function __construct($id,  $name,  $email,  $password, $phonenumber, $zipcode, $city)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phonenumber = $phonenumber;
        $this->zipcode = $zipcode;
        $this->city = $city;
    }
    

    public function getId() {return $this->id;}

    public function getName() {return $this->name;}

    public function getEmail() {return $this->email;}

    public function getPassword() {return $this->password;}

    public function getPhoneNumber() {return $this->phonenumber;}

    public function getZipCode() {return $this->zipcode;}

    public function getCity() {return $this->city;}

    public function setId( $id): void {$this->id = $id;}

    public function setName( $name): void {$this->name = $name;}

    public function setEmail( $email): void {$this->email = $email;}

    public function setPassword( $password): void {$this->password = $password;}

    public function setPhoneNumber( $phonenumber): void {$this->phonenumber = $phonenumber;}
    
    public function setZipCode( $zipcode): void {$this->zipcode = $zipcode;}
    
    public function setCity( $id): void {$this->city = $city;}

    public static function registerUser(User $user){
        $config = new Config();
        $connection = $config->getConnection();

        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $phonenumber = $user->getPhoneNumber();
        $zipcode = $user->getZipCode();
        $city = $user->getCity();

        $sql = "INSERT INTO users (name,email,password,phonenumber,zipcode,city) VALUES ('$name','$email','$password','$phonenumber','$zipcode','$city');";

        return mysqli_query($connection,$sql);
    }
    public static function loginUser(string $email){
        $config = new Config();
        $connection = $config->getConnection();

        $sql = "SELECT password FROM users WHERE email = '$email';";

        return mysqli_query($connection,$sql);
    }
    
}