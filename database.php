<?php
class Database
{
  private static $pdo;

  static function getConnection(): PDO
  {
    if (self::$pdo == null) {

      $dsn = 'mysql:host=localhost;port=3306;dbname=biliard';
      $username = 'root';
      $password = '';

      self::$pdo = new PDO($dsn, $username, $password);
    }

    return self::$pdo;
  }
}
