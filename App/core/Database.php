<?php

namespace Database;

class Database
{
private static $instance;
public  function connection()
{
    if(empty(self::$instance)){
        self::$instance=new PDO('mysql:host=localhost;port=')

    }
}
}