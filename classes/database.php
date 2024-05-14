<?php 

class database{
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=phpoop_221','root','');
    }
    function check($username, $password){
        $con = $this->opencon();
        $query = "SELECT * from users WHERE user='".$username."'&&pass='".$password."'";
        return $con->query($query)->fetch();
    }
 
    function signup($firstname, $lastname, $birthday, $sex, $username, $password){
        $con = $this->opencon();
 
        $query = $con->prepare("SELECT user FROM users WHERE user = ?");
        $query->execute([$username]);
        $existingUser =  $query->fetch();
 
        if($existingUser){
            return false;
        }
 
        return $con->prepare("INSERT INTO users (firstname, lastname, birthday, sex, user, pass) VALUES (?,?,?,?,?,?)")
                ->execute([$firstname, $lastname, $birthday, $sex, $username, $password]);
    }
 
    function signupUser($firstname, $lastname, $birthday, $sex, $username, $password) {
        $con = $this->opencon();
       
        $query = $con->prepare("SELECT user FROM users WHERE user = ?");
        $query->execute([$username]);
        $existingUser =  $query->fetch();
 
        if($existingUser){
            return false;
        }
        $con->prepare("INSERT INTO users (firstname, lastname, birthday, sex, user, pass) VALUES (?,?,?,?,?,?)")
                ->execute([$firstname, $lastname, $birthday, $sex, $username, $password]);
        return $con->lastInsertId();
    }
   
    function insertAddress($user_id, $street, $barangay, $city, $province) {
        $con = $this->opencon();
       
        return $con->prepare("INSERT INTO user_address(user_id, user_street, user_barangay, user_city, user_province) VALUES (?, ?, ?, ?, ?)")->execute(array($user_id, $street, $barangay, $city, $province));
       
    }
    function view(){
        $con = $this->opencon();
 
        return $con->query("SELECT users.user_id,users.firstname,users.lastname,users.birthday,users.sex,users.user, CONCAT(user_address.user_street,' ', user_address.user_barangay,' ',user_address.user_city,' ',user_address.user_province) AS Address FROM users INNER JOIN user_address ON users.user_id = user_address.user_id")->fetchAll();
       
               
    }
    function delete($user_id){
        try{
            $con = $this->opencon();
            $con->beginTransaction();
 
            $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
            $query->execute([$user_id]);
 
            $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
            $query2->execute([$user_id]);
 
            $con->commit();
            return true;
 
        }catch(PDOException $e){
            $con->rollBack();
            return false;
        }
    }
    function viewdata($user_id){
        try{
        $con = $this->opencon();
        $query = $con->prepare("SELECT
        users.user_id,
        users.firstname,
        users.lastname,
        users.birthday,
        users.sex,
        users.user,
        users.pass,
        user_address.user_street,
        user_address.user_barangay,  
        user_address.user_city,
        user_address.user_province FROM user_address INNER JOIN users ON user_address.user_id = users.user_id WHERE users.user_id = ?");
        $query->execute([$user_id]);
        return $query->fetch();
    }
    catch(PDOException $e){
        return [];
    
    }
}
    function updateuser($user_id, $firstname, $lastname, $birthday, $sex, $username, $password){
        try{
            $con = $this->opencon();
            $query = $con->prepare("UPDATE users SET firstname=?, lastname=?, birthday=?, sex=?, user=?, pass=? WHERE user_id=?");
            return $query->execute([$firstname, $lastname, $birthday, $sex, $username, $password, $user_id]);
        } catch(PDOException $e) {
            return false;
        }
    }
    function updateuseradress($user_id, $street, $barangay, $city, $province){
        try{
            $con = $this->opencon();
            $query = $con->prepare("UPDATE user_address SET user_street=?, user_barangay=?, user_city=?, user_province=? WHERE user_id=?");
            return $query->execute([$street, $barangay, $city, $province, $user_id]);
        }catch(PDOException $e) {
            return false;
        }
    }
}
 