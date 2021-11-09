<?php
/*
Author: Lerie Taylor
Date: 2021
Filename: Db.class.php
Description: PDO wrapper
*/
class Db {
     private $host = '127.0.0.1';
     private $db = 'torrents';
     private $user = 'root';
     private $pass = '';
     private $charset = 'utf8mb4';
     public $pdo;
     private $dsn;

     ///
     function __construct()
     {
          $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

          $this->options = [
               PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
               PDO::ATTR_EMULATE_PREPARES => false,
          ];

          return $this->connect();
     }

     ///
     function connect()
     {
          try {
               $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
          } catch (\PDOException $e) {
               throw new \PDOException($e->getMessage(), (int)$e->getCode());
          }

          return $this->pdo;
     }

     /// check if an email exists
     function emailExists($email) {
          $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
          $stmt->execute([$email]);
          return ($stmt->fetchAll() == null ? false : true);
     }

     /// check for valid credentials
     function checkLogin($email, $pass) {
          $pass = password_hash($pass, PASSWORD_DEFAULT);
          $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? and password = ?');
          $stmt->execute([$email, $pass]);
          return ($stmt->fetchAll() == null ? "false" : "true");
     }

     ///
     function searchBy($tbl, $search_field) {
          $stmt = $this->pdo->prepare('SELECT * FROM '.$tbl.' WHERE '.$search_field.' = ?');
          $stmt->execute([$search_field]);
          return $stmt->fetchAll();
     }
     
     ///
     function query($tbl, $cols) {
          $ret = [];
          $selCols = "";
          
          foreach(explode(',',$cols) as $col)
          {
               $selCols .= $col.",";
          }

          $selCols = trim($selCols,",");

          $stmt = $this->pdo->query('SELECT '.$selCols.' FROM '.$tbl.' limit 10');
          return $stmt->fetchAll();
     }
}
?>