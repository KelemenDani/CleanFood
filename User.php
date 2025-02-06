<?php

class Config {
    private $dbCon;

    public function __construct() {
        $this->dbCon = mysqli_connect('localhost', 'root', 'root', 'cleanfood');
    }

    public function getConnection() {
        return $this->dbCon;
    }

    public function close() {
        mysqli_close($this->dbCon);
        $this->dbCon = null;
    }
}

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
    
    public function setCity( $city): void {$this->city = $city;}

    public static function registerUser(User $user){
        $config = new Config();
        $connection = $config->getConnection();

        $email = $user->getEmail();


        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $checkEmailQuery);

        if (mysqli_num_rows($result) > 0) {
            return false; 
        }

        $name = $user->getName();
        $password = $user->getPassword();
        $phonenumber = $user->getPhoneNumber();
        $zipcode = $user->getZipCode();
        $city = $user->getCity();

        $sql = "INSERT INTO users (name, email, jelszo, phonenumber, zipcode, city) VALUES ('$name', '$email', '$password', '$phonenumber', '$zipcode', '$city');";

        return mysqli_query($connection, $sql);
    }
}