<?php

class DBconnection
{

private $user = "root";
private $pass = "123456";


   protected function dbCon(){

        try {
            $dbCon = new PDO('mysql:host=localhost;dbname=pyrosharedb;charset=utf8', $this->user, $this->pass);
            return $dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }}


}



