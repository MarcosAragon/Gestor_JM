<?php
class DB{
    public static function connect(){
        $host=getenv("DB_HOST");
        $db=getenv("DB_NAME");
        $user=getenv("DB_USER");
        $pass=getenv("DB_PASS");

        return new mysqli($host, $username, $password, $database);

    }
}

?>