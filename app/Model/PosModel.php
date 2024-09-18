<?php

require_once __DIR__ . '/../../database.php';

class PosModel
{
  private PDO $pdo;

  function __construct()
  {
    $this->pdo = Database::getConnection();
  }
  function save($time)
  {
    $result = $this->pdo->prepare('INSERT INTO pos (start_end_time) VALUES (:time)');
    $result->bindValue(':time', $time);
    $result->execute();
  }
}
