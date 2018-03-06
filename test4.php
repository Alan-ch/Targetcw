<?php
// Challenge: make this terrible code safe
echo "<!doctype html>\n";
try{
      $username = (!empty($_GET['username'])) ? $_GET['username'] : '';
      $password = (!empty($_GET['password'])) ? $_GET['password'] : '';
      if($username == '' || $password == '' ){
        throw new Exception(" Please enter username && password !");
      }
       $password = password_hash($password, PASSWORD_DEFAULT);
       $pdo = new PDO('sqlite::memory:');
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $pdo->exec("DROP TABLE IF EXISTS users");
       $pdo->exec("CREATE TABLE users (username VARCHAR(255), password VARCHAR(255))");
       $rootPassword = password_hash("secret", PASSWORD_DEFAULT);
       $pdo->exec("INSERT INTO users (username, password) VALUES ('root', '$rootPassword');");
       $statement = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ? ");
       $statement->execute(array($username,$password));
       if (count($statement->fetchAll())) {
           echo "Access granted to $username!<br>\n";
       } else {
           echo "Access denied for $username!<br>\n";
       }
        $pdo = null;
      
 }catch(PDOException $e) {
    echo $e->getMessage();
  }
