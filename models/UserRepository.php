<?php
class UserRepository {
    public static function getIdByUsername($username) {
        $DB=DB::connect();
        $result=$DB->query("SELECT id FROM user WHERE username='$username'");
        $userId=[];
        while($row=$result->fetch_assoc()){
            $userId[]=$row['id'];
        }
        return $userId;
    }
}
?>